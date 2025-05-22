<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT * FROM crud_barang");
        return view('about', ['data' => $data]);
    }
}
