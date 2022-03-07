<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $fillable= ['account_id', 'level', 'code', 'title'];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
