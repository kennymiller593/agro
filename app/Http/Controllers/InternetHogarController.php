<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternetHogarController extends Controller
{
    //
    public function index()
    {
        return view('internethogar');
    }
    public function negocio()
    {
        return view('internetnegocio');
    }
}
