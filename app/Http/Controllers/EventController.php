<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Income;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class EventController extends Controller
{
    public function index(){
        $path = 'kegiatan';
        return view('events.index', compact('path'));
    }

    public function indexAPI(){
        return response(Event::with('incomes.user')->orderBy('created_at', 'desc')->get());
    }

    public function create(){
        $path = 'kegiatan';
        $users = DB::table('users')->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->whereNull('model_has_roles.role_id')->orWhere('model_has_roles.role_id', '!=', '1')
        ->select('users.id','users.name')->get();
        $events = Event::orderBy('created_at', 'desc')->get();
        // $user = User::with('roles')->get();

        // dd($user);
        
        return view('events.create', compact('path', 'users', 'events'));
    }

    public function store(EventRequest $request){
        
        $array_store = array_merge($request->all(), [
            'date' => date_format(date_create_from_format("d/m/Y", $request->date), 'Y-m-d')
        ]);
        Income::create($array_store);
        return redirect('/event/index');
    }
}
