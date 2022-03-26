<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $path = 'rekening';
        $accounts = Account::get();
        return view('account.index', compact('path', 'accounts'));
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
            $count = Account::orderBy('idx', 'asc')->get();
            $idx = null;
            $array = [];
            foreach ($count as $key => $value) {
                array_push($array, $key);
                if ($key + 1 !== $value->id) {
                    $dataExits = Account::where('idx', $key + 1)->first();
                    if (!$dataExits) {
                        $idx = $key + 1;
                        break;
                    }
                }
            }
            if ($idx == null) {
                $store =  Account::create([
                    'title' => $request->title,
                    'idx' => $count->count()+1,
                ]);
            } else {
                $store =  Account::create([
                    'title' => $request->title,
                    'idx' => $idx,
                ]);
            }
            return response($store);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

    public function parentShow(Account $account)
    {
        $path = 'rekening';
        return view('account.parent-update', compact('account', 'path'));
    }

    public function childShowAPI(Account $account)
    {
        $data = AccountCategory::where('account_id', $account->id)->get();
        return response(['success' => true, 'data' => $data]);
    }

    public function parentUpdate(Account $account, Request $request)
    {
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

    public function childShow($id)
    {
        $path = 'rekening';
        $child = AccountCategory::findOrFail($id);
        return view('account.child-update', compact('path', 'child'));
    }

    public function childUpdate($id, Request $request)
    {
        $child = AccountCategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $child->update([
            'title' => $request->title
        ]);

        return redirect('/account/index');
    }

    public function index_data()
    {
        $rekening = Account::with('categories')->orderBy('created_at', 'desc')->get();
        return response($rekening);
    }

    public function destroyParent(Request $request)
    {
        try {
            $parent = Account::findOrFail($request->id);
            $child  = AccountCategory::where('account_id',  $parent->id);

            $child->delete();
            $parent->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }
    public function destroyChild(Request $request)
    {
        try {
            $child  = AccountCategory::findOrFail($request->id);
            $child->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }
}
