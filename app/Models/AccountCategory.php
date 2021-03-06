<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $fillable= ['account_id', 'level', 'code', 'title', 'balance'];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function finances(){
        return $this->hasMany(Finance::class, 'account_category_id', 'id');
    }
}
