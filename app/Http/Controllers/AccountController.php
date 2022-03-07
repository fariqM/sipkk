<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $path = 'rekening';
        return view('account.index', compact('path'));
    }

    public function create()
    {
        $data = Account::get();
        $path = 'rekening';
        return view('account.create', compact('path', 'data'));
    }

    public function store(Request $request)
    {
        try {
            $store =  Account::create([
                'title' => $request->title
            ]);
            return response($store);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    public function parentShow(Account $account){
        $path = 'rekening';
        return view('account.parent-update', compact('account', 'path'));
    }

    public function parentUpdate(Account $account, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $account->update([
            'title' => $request->title
        ]);

        return redirect('/account/index');
    }

    public function index_data()
    {
        $rekening = Account::with('categories')->orderBy('created_at', 'desc')->get();
        return response($rekening);
    }
}
