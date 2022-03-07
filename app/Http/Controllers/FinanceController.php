<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinanceRequest;
use App\Models\AccountCategory;
use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $data = Finance::with('account')->orderBy('created_at', 'desc')->get();
        $path = 'keuangan';
        return view('finance.index', compact('path', 'data'));
    }

    public function indexAPI()
    {
        $data = Finance::with('account')->orderBy('created_at', 'desc')->get();
        return response($data);
    }

    public function create()
    {
        $path = 'keuangan';
        $data = AccountCategory::get();
        return view('finance.create', compact('path', 'data'));
    }

    public function store(FinanceRequest $request)
    {
        //    $store_array = array_merge($request->all(), ['balance' =>  $request->debit-$request->credit]);
        //    dd($request->all());

        Finance::create($request->all());

        return redirect('/finance/index');
    }

    public function show(Finance $finance){
        $path = 'keuangan';
        $data = AccountCategory::get();

        return view('finance.update', compact('path', 'data', 'finance'));
    }

    public function update(Finance $finance, FinanceRequest $request){
        $finance->update($request->all());
        return redirect('/finance/index');
    }

    public function destroy(Finance $finance)
    {
        try {
            $finance->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()]);
        }
    }
}
