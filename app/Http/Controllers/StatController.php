<?php

namespace App\Http\Controllers;

use App\Models\CarHistory;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function getStat(){
        $histories = CarHistory::where('user_id', auth()->id())->get();

        $data = [
            'allPay' => 0,
            'fuel' => 0,
            'service' => 0,
            'buy' => 0
        ];

        foreach ($histories as $item) {
            $data['allPay'] += $item->price;
            switch ($item->type) {
                case 'repair':
                    $data['service'] += $item->price;
                    break;
                case 'fuel':
                    $data['fuel'] += $item->price;
                    break;
                case 'buy':
                    $data['buy'] += $item->price;
                    break;
            }
        }
        return $data;
    }
}
