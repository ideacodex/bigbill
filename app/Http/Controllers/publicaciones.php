<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class publicaciones extends Controller
{
    // Publicaciones - vista ususario
    public function Publications()
    {
        return view('Publications.index');
    }

    // Publicaciones - vista administrador
    public function viewPublications()
    {
        return view('Publications.preview');
    }
}
