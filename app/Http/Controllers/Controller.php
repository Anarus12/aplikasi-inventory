<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Utama',
            'users' => User::all(),
        ];

        return view('home.index', $data);
    }
}
