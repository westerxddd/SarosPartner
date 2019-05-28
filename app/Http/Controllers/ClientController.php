<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show(Client $client){
        return view('clients.show', compact('client'));
    }

    public function index(){

    }
}
