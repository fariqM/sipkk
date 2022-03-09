<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function debitData()
    {
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->startOfMonth()->subSecond(1);
        $monthName = $dateE->format('F');
        $data = DB::table('finances')->whereNotNull('debit')
        ->whereBetween('date', [$dateS, $dateE])->orderBy('date', 'asc');

        $debit = $data->pluck('debit');
        $date = $data->pluck('date');
        $date_formated = [];
        for ($i=0; $i < $date->count(); $i++) { 
            // array_push($date_formated, 'asd');
            array_push($date_formated, date_format(date_create_from_format("Y-m-d", $date[$i]), 'd'));
        }

        return response([
            // 'dateStart' => $dateS, 
            'Month' => $monthName, 
            'totalData' => $debit->count(), 
            'debit' => $debit,
            'date' => $date_formated,
        ]);
    }

    public function creditData()
    {
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->startOfMonth()->subSecond(1);
        $monthName = $dateE->format('F');
        $data = DB::table('finances')->whereNotNull('credit')
        ->whereBetween('date', [$dateS, $dateE])->orderBy('date', 'asc');

        $debit = $data->pluck('credit');
        $date = $data->pluck('date');
        $date_formated = [];
        for ($i=0; $i < $date->count(); $i++) { 
            // array_push($date_formated, 'asd');
            array_push($date_formated, date_format(date_create_from_format("Y-m-d", $date[$i]), 'd'));
        }

        return response([
            // 'dateStart' => $dateS, 
            'Month' => $monthName, 
            'totalData' => $debit->count(), 
            'credit' => $debit,
            'date' => $date_formated,
        ]);
    }

    public function balanceData()
    {
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->startOfMonth()->subSecond(1);
        $monthName = $dateE->format('F');
        $data = DB::table('finances')->whereNotNull('balance')
        ->whereBetween('date', [$dateS, $dateE])->orderBy('date', 'asc');

        $debit = $data->pluck('balance');
        $date = $data->pluck('date');
        $date_formated = [];
        for ($i=0; $i < $date->count(); $i++) { 
            // array_push($date_formated, 'asd');
            array_push($date_formated, date_format(date_create_from_format("Y-m-d", $date[$i]), 'd'));
        }

        return response([
            // 'dateStart' => $dateS, 
            'Month' => $monthName, 
            'totalData' => $debit->count(), 
            'balance' => $debit,
            'date' => $date_formated,
        ]);
    }
}
