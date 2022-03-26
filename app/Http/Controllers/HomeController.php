<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $incomes = Income::all();
        $finance = Finance::with('account')->orderBy('created_at', 'desc')->get();
        $path = 'dasbor';
        return view('dashboard', compact('path', 'finance', 'incomes'));
    }
}
