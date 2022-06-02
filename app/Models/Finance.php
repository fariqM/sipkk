<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable= [
        'account_category_id',
        'description',
        'debit',
        'credit',
        'balance',
        'date'
    ];

    public function accountCategory(){
        return $this->belongsTo(AccountCategory::class, 'account_category_id', 'id');
    }
}
