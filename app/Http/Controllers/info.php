<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class info extends Controller
{
    public function showInfo()
    {
        return view('pages.info');
    }
}
