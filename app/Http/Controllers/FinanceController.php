<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinanceRequest;
use App\Models\Account;
use App\Models\AccountCategory;
use App\Models\Finance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FinanceController extends Controller
{

    public function main()
    {
        $accounts = Account::all();
        $path = 'keuangan';
        return view('finance.main', compact('accounts','path'));
    }

    public function index($slug)
    {
        $title = ucwords(str_replace('-', ' ', $slug));
        $id = Account::where('title', $title)->first()->id;
        $data = Finance::join('account_categories','account_categories.id','=','finances.account_category_id')
                ->join('accounts','accounts.id','=','account_categories.account_id')
                ->where('account_categories.account_id',$id)
                ->select('finances.*')
                ->get();
        $path = 'keuangan';
        return view('finance.index', compact('path', 'data','title'));
    }

    public function indexAPI()
    {
        $data = Finance::with('account')->orderBy('created_at', 'desc')->get();
        return response($data);
    }

    public function create($slug)
    {
        $title = ucwords(str_replace('-', ' ', $slug));
        $account = Account::where('title', $title)->first();
        $path = 'keuangan';
        $data = AccountCategory::where('account_id',$account->id)->get();
        return view('finance.create', compact('path', 'data', 'account'));
    }

    public function store(FinanceRequest $request)
    {
        $data = $request->all();
        $account_category = AccountCategory::where('id',$data['account_category_id'])->first();
        $balance = $account_category->balance;
        $data['date'] = date_format(date_create_from_format("d/m/Y", $request->date), 'Y-m-d');
        //    $store_array = array_merge($request->all(), ['balance' =>  $request->debit-$request->credit]);
        $account = Account::find($request->account_id);
        if($data['debit'] != null){
            $data['balance'] = $balance + $data['debit'];
        }else{
            $data['balance'] = $balance - $data['credit'];
        }
        AccountCategory::find($account_category->id)->update(['balance' => $data['balance']]);
        Finance::create($data);
        return redirect('/finance/index/'.Str::slug($account->title))->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Finance $finance)
    {
        $path = 'keuangan';
        $data = AccountCategory::get();

        return view('finance.update', compact('path', 'data', 'finance'));
    }

    public function update(Finance $finance, FinanceRequest $request)
    {
        $array_store = array_merge($request->all(), [
            'date' => date_format(date_create_from_format("d/m/Y", $request->date), 'Y-m-d')
        ]);

        $finance->update($array_store);
        return redirect('/finance/index');
    }

    public function destroy(Finance $finance)
    {
        try {
            $finance->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()],500);
        }
    }
}
