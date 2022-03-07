<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function store(Request $request){
        // dd($request->all());

        $id = $request->category;
        $account = Account::findOrFail($id);
        AccountCategory::create([
            'level' => 2,
            'account_id' => $id,
            'code' => $id.'.'.str_pad($id, 2, '0', STR_PAD_LEFT),
            'title' => $request->account,
        ]);
        return redirect('/account/index');
    }
}
