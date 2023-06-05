<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    
    public function publicagratis()
    {
        return view('landingPages.publicatusavisos');
    }
    public function ayudaysoporte()
    {
        return view('landingPages.ayudaysoporte');

    }
}
