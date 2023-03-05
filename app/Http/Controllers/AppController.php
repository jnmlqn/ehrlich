<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function weather(Request $request)
    {
        $city = $request->get('city');

        return view('weather', compact('city'));
    }
}
