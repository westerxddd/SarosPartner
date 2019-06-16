<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientArticles;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function clients(Request $request){
        $clients = Client::query()->leftJoin('points','clients.id','=','points.client_id');

        if (isset($request->name)){
            $clients->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if (isset($request->nip)){
            $clients->where('nip', 'LIKE', '%'.$request->nip.'%');
        }

        if (isset($request->minpts)){
            $clients->where('points.amount', '>=', $request->minpts);
        }

        if (isset($request->maxpts)){
            $clients->where('points.amount', '<=', $request->maxpts);
        }

        if (isset($request->activation) && $request->activation==1){
            $clients->where('points.amount','>=',isset($request->minpts) ? $request->minpts : 4000)
                ->doesntHave('user');
        }

        $clients->select(['clients.id','clients.name','clients.nip','points.amount']);

        return \Yajra\DataTables\Facades\DataTables::eloquent($clients)
            ->addIndexColumn()
            ->addColumn('action', function($client){
                return '
                    <a href="'.route('clients.show',$client->id).'">
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </a>';
            })
            ->editColumn('amount', function($client){
                return floor($client->getPoints());
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function clientArticles(Request $request){
        $client_id = auth()->user()->isAdmin() ? $request->clientId : auth()->user()->client->id;
        $articles = ClientArticles::query()->where('client_id',$client_id);

        if (isset($request->prefix)){
            $articles->where('prefix', 'LIKE', '%'.$request->prefix.'%');
        }

        if (isset($request->minnetto)){
            $minnetto = str_replace(',','.',$request->minnetto);
            $articles->where('netto', '>=', $minnetto);
        }

        if (isset($request->maxnetto)){
            $maxnetto = str_replace(',','.',$request->maxnetto);
            $articles->where('netto', '<=', $maxnetto);
        }

        $articles->orderBy('created_at','DESC');

        return \Yajra\DataTables\Facades\DataTables::eloquent($articles)
            ->addIndexColumn()
            ->editColumn('netto',function($article){
                return number_format($article->netto,2,'.',' ');
            })
            ->editColumn('multiple',function($article){
                if ($article->multiple){
                    return '<i class="fa fa-star extra-points" aria-hidden="true"></i>';
                }

                return '';
            })
            ->editColumn('created_at', function($article){
                return $article->created_at->format('d.m.Y H:i');
            })
            ->rawColumns(['multiple', 'DT_RowIndex'])
            ->toJson();
    }

    public function prefixes(Request $request){
        $prefixes = ClientArticles::select('prefix')
            ->where('prefix','LIKE', '%'.$request->prefix.'%')
            ->distinct()
            ->get();

        return response()->json($prefixes);

    }
}
