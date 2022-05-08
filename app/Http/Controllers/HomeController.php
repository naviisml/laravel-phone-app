<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Return the home page view
     *
     * @return  Illuminate\Support\Facades\View
     */
    public function index()
    {
        return view('home');
    }
}
