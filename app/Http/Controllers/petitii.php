<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class petitii extends Controller
{
    public function showPetitii()
    {
        return view('pages.petitii');
    }
}
