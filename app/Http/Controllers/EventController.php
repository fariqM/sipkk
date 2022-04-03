<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Income;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class EventController extends Controller
{
    public function index()
    {
        $path = 'kegiatan';
        $incomes = Income::get();
        return view('events.index', compact('path', 'incomes'));
    }

    public function indexAPI()
    {
        return response(Event::with('incomes.user')->orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        $path = 'kegiatan';
        $users = Member::all();
        $events = Event::orderBy('created_at', 'desc')->get();
        // $user = User::with('roles')->get();

        // dd($user);

        return view('events.create', compact('path', 'users', 'events'));
    }

    public function store(EventRequest $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'date' => 'required',
            'event_id' => 'required',
            'balance' => 'required',
        ]);
        $data['member_id'] = $request->user_id;
        $array_store = array_merge($data, [
            'date' => date_format(date_create_from_format("d/m/Y", $request->date), 'Y-m-d')
        ]);
        Income::create($array_store);
        return redirect('/event/index');
    }

    public function addEventAPI(Request $request)
    {
        try {
            $store =  Event::create([
                'description' => $request->description
            ]);
            return response($store);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()],500);
        }
    }

    public function show(Income $income)
    {
        $path = 'kegiatan';
        $users = Member::all();
        $events = Event::orderBy('created_at', 'desc')->get();

        // dd($income);
        return view('events.update', compact('path', 'users', 'events', 'income'));
    }

    public function update(Event $event, Request $request)
    {
        try {
            $event->update([
                'description' => $request->description
            ]);
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    public function childUpdate(Income $income, EventRequest $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'date' => 'required',
            'event_id' => 'required',
            'balance' => 'required',
        ]);
        $data['member_id'] = $request->user_id;
        $array_store = array_merge($data, [
            'date' => date_format(date_create_from_format("d/m/Y", $request->date), 'Y-m-d')
        ]);
        $income->update($array_store);
        return redirect('/event/index')->with('success', 'Data berhasil diubah');
    }

    public function destroyParent(Event $event)
    {
        try {
            $child  = Income::where('event_id',  $event->id);
            $child->delete();
            $event->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()],500);
        }
    }

    public function destroyChild(Income $income)
    {
        try {
            $income->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()],500);
        }
    }
}
