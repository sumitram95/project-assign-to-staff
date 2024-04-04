<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InactiveController extends Controller
{
    public function inactive()
    {
        if (auth()->user()->userInfo->status == 'inactive') {
            return view('backend.pages.inactive.inactive');
        }
        return redirect()->route('dashboard.index');
    }
}
