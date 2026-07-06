<?php

namespace App\Http\Controllers;

use App\Models\BodyTypes;
use Illuminate\Http\Request;

class NewCarController extends Controller
{
    public function index(){
        $types = BodyTypes::all();
        $data = [
            'body' => $types
        ];
        return view('pages.dashboard.add.page',$data);
    }
}
