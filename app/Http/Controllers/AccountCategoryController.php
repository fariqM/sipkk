<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function store(Request $request){

        $id = $request->category;
        $account = Account::findOrFail($id);
        // dd($request->all());

        $child_count = AccountCategory::where('account_id', $id)->count();
        $code = $account->idx.'.'.str_pad($child_count+1, 2, '0', STR_PAD_LEFT);
        // dd($code);
        AccountCategory::create([
            'level' => 2,
            'account_id' => $id,
            'code' => $code,
            'title' => $request->account,
        ]);
        return redirect('/account/index');
    }
}
