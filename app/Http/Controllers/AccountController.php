<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $path = 'rekening';
        return view('account.index', compact('path'));
    }

    public function index_data()
    {
        $rekening = Account::orderBy('created_at', 'desc')->get();
        return response($rekening);
    }
}
