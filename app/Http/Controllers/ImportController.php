<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientArticles;
use App\Http\Requests\ImportCSVRequest;
use App\Imports\ArticlesForClientsImport;
use App\Imports\ClientsImport;
use App\Point;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public function import(){
        return view('import.page');
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
                dd(Excel::import(new ClientsImport, $request->file('csv_file'), 'csv'));
                $count = Client::all()->count() - $count;

                return redirect()->back()->with('success','Import został zakończony pomyślnie! Zaimportowano '.$count.' nowych kontrahentów!');
                break;

            case 'articles':
                if ((new HeadingRowImport)->toArray($request->file('csv_file'))[0][0]!= ['kontrahent','prefiks','wartosc_netto']){
                    return redirect()->back()->with('error','Niepoprawny plik CSV!');
                }

                $clientCount = Client::all()->count();
                $articleCount = ClientArticles::all()->count();
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
}
