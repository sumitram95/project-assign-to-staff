<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    public function testFormData(Request $request)
    {

        dd($request->all());

    }
}
