<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function store(Request $request){

        $id = $request->category;
        // $account = Account::findOrFail($id);
        // dd($account);

        $child_count = AccountCategory::where('account_id', $id)->count();

        AccountCategory::create([
            'level' => 2,
            'account_id' => $id,
            'code' => $id.'.'.str_pad($child_count+1, 2, '0', STR_PAD_LEFT),
            'title' => $request->account,
        ]);
        return redirect('/account/index');
    }
}
