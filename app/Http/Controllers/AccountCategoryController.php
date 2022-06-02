<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        $data['balance'] = 0;
        $data['level'] = substr($data['code'], 0, 1);
        AccountCategory::create($data);
        return redirect('/account/index');
    }
}
