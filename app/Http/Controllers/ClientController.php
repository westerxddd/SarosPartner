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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'points' => 'required|numeric',
        ]);

        $points = $request->points;

        $client->addPoints($points);

        $article = new ClientArticles;
        $article->prefix = $request->title;//'Ręczna zmiana punktów';
        $article->client_id = $client->id;
        $article->netto = $points;
        $article->save();
        $client->save();

        return redirect()->back()->with('success', 'Liczba pktów została zmieniona o '.number_format($points,2,'.',' '));
    }
}
