<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'students' => \App\model\Student::count(),
            'books' => \App\model\Book::count(),
            'transactions' => \App\model\Transaction::count(),
        ];

        return view('dashboard', ['data' => $data]);
    }
}
