<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientArticles;
use App\Deal;
use App\Http\Requests\ImportCSVRequest;
use App\Import;
use App\Imports\ArticlesForClientsImport;
use App\Imports\ClientsImport;
use App\Point;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public function import(){
        if (!auth()->user()->isAdmin()){
            return redirect()->route('dashboard')->with('error','Brak wymaganych uprawnień!');
        }

        $imports = Import::orderBy('created_at','DESC')->get();
        return view('import.page', compact('imports'));
    }

    public function store(ImportCSVRequest $request){
        if ($request->file('csv_file')->getClientOriginalExtension()!='csv'){
            return redirect()->back()->with('error','Załączony plik nie jest plikiem CSV!');
        }

        $path = $request->file('csv_file')->getRealPath();

        switch ($request->type){
            case 'clients':
                /*
                 * TODO: ustalić jak ma wyglądać ostateczny plik CSV z klientami do importu!
                 */
                $count = Client::all()->count();
                //dd(Excel::import(new ClientsImport, $request->file('csv_file'), 'csv'));
                $count = Client::all()->count() - $count;

                return redirect()->back()->with('success','Import został zakończony pomyślnie! Zaimportowano '.$count.' nowych kontrahentów!');
                break;

            case 'articles':
                if ((new HeadingRowImport)->toArray($request->file('csv_file'))[0][0]!= ['kontrahent','prefiks','wartosc_netto']){
                    return redirect()->back()->with('error','Niepoprawny plik CSV!');
                }

                $clientCount = Client::all()->count();
                $articleCount = ClientArticles::all()->count();
                $deals =  Deal::where('start_at','<=', now())
                    ->where('end_at','>=', now())
                    ->orderBy('end_at','desc')
                    ->get();

                Excel::import(new ArticlesForClientsImport($request->extra), $request->file('csv_file'), 'csv');
                $articleCount = ClientArticles::all()->count() - $articleCount;
                $clientCount = $count = Client::all()->count() - $clientCount;

                return redirect()->back()->with('success','Import został zakończony pomyślnie! Zaimportowano '.$articleCount.' nowych artykułów'.
                    ($clientCount>0 ? ' oraz dodano '.$clientCount.' nowych kontrahentów':'').'!');
                break;
            default:
                return redirect()->back()->with('error','Nieprawidłowe żądanie!');
        }
    }

    public function undo(Import $import){
        $clients = Client::where('import_id',$import->id)->get();
        $articles = ClientArticles::where('import_id',$import->id)->get();
        $countArticles = 0;
        $countClients = 0;

        if (count($articles)>0){
            foreach ($articles as $article){
                $points = $article->netto * -1;
                $article->client->addPoints($points);
                $article->delete();
                $countArticles++;
            }
        }

        if (count($clients)>0){
            foreach ($clients as $client){
                if (!isset($client->user)){
                    $client->points->delete();
                    $client->delete();
                    $countClients++;
                }
            }
        }

        if (!count($import->clients)>0 || !count($import->articles())>0){
            $import->delete();
            return redirect()->back()->with('success','Import został wycofany:  -'.$countArticles.' artykułów, -'.$countClients.' kontrahentów ]');
        }

        if ($countArticles<1 || $countClients<1){
            return redirect()->back()->with('error','Nie można usunąć importu! Niektóre elementy z tego importu są powiązane z innymi elementami, np. kontrahent już posiada konto użytkownika!');
        }

        return redirect()->back()->with('success','Nie udało się w całkowicie cofnąć importu:  -'.$countArticles.' artykułów, -'.$countClients.' kontrahentów ]');
    }
}
