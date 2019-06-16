<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientArticles;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show(Client $client){
        return view('clients.show', compact('client'));
    }

    public function countPoints(Client $client, Request $request){
        if (!is_numeric($request->points)){
            return redirect()->back()->with('error','Wprowadzona wartość nie jest liczbowa!');
        }

        $points = $request->points;

        $client->addPoints($points);

        $article = new ClientArticles;
        $article->prefix = 'Ręczna zmiana punktów';
        $article->client_id = $client->id;
        $article->netto = $points;
        $article->save();
        $client->save();

        return redirect()->back()->with('success', 'Liczba pktów została zmieniona o '.number_format($points,2,'.',' '));
    }
}
