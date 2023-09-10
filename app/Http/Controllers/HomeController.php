<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = File::paginate(5);
        return view('welcome', compact('files'));
    }
}
