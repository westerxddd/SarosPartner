<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Http\Requests\DealRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;

class DealController extends Controller
{
    public function index(){
        if (!auth()->user()->isAdmin()){
            $deals = Deal::where('start_at','<=', now())
                ->where('end_at','>=', now())
                ->orderBy('end_at','desc')
                ->get();

            return view('user.deals',compact('deals'));
        }

        $deals = Deal::all();
        return view('deals.index', compact('deals'));
    }

    public function store(DealRequest $request){

        $deal = new Deal;
        $deal->name = $request->name;
        $deal->desc = $request->desc;
        $deal->start_at = Carbon::createFromTimeString($request->start_at);
        $deal->end_at = Carbon::createFromTimeString($request->end_at);

        if (isset($request->extra)){
            $deal->extra = strtoupper(implode('%|%', $request->extra));
        }

        if (isset($request->image)){
            $file = $request->file('image');
            $deal->image = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/img/deals'), $deal->image);
        }

        $deal->save();

        return redirect()->back()->with('success','Promocja '.$deal->name.' została dodana pomyślnie!');
    }
}
