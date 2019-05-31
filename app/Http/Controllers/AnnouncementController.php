<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnnouncementController extends Controller
{
    public function index(){
        if (!auth()->user()->isAdmin()){
            $announcements = Announcement::where('start_at','<=', now())
                ->where('end_at','>=', now())
                ->orderBy('end_at','desc')
                ->get();

            return view('user.announcements',compact('announcements'));
        }

        $announcements = Announcement::all();
        return view('announcements.index', compact('announcements'));
    }

    public function store(AnnouncementRequest $request){

        $announcement = new Announcement;
        $announcement->name = $request->name;
        $announcement->desc = $request->desc;
        $announcement->start_at = Carbon::createFromTimeString($request->start_at);
        $announcement->end_at = Carbon::createFromTimeString($request->end_at);

        if (isset($request->extra)){
            $announcement->extra = implode('%|%',$request->extra);
        }

        if (isset($request->image)){
            $file = $request->file('image');
            $announcement->image = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/img/announcements'), $announcement->image);
        }

        $announcement->save();

        return redirect()->back()->with('success','Ogłoszenie '.$announcement->name.' została dodana pomyślnie!');
    }
}
