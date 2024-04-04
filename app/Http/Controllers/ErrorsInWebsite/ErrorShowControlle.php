<?php

namespace App\Http\Controllers\ErrorsInWebsite;

use App\Http\Controllers\Controller;
use App\Models\ErrorsInWebsite;
use Illuminate\Http\Request;


class ErrorShowControlle extends Controller
{
    public function errorIndex()
    {
        $data['errors'] = ErrorsInWebsite::get();
        return view('backend.pages.websiteerror.show-error', $data);
    }
    public function errorViewCode($id)
    {
        $data['error'] = ErrorsInWebsite::find($id);
        if (!$data['error']) {
            return redirect()->route('errors.website.index')->with('error', 'Not found !');
        }
        return view('backend.pages.websiteerror.error-code-view', $data);
    }
    public function dateChanger(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        $day = $request->get('day');
        $day1 = $day + 17;
        if ($day1 > 30) {
            $month1 = $month + 1 + 8;
            if ($month1 > 12) {
                $month2 = $month1 - 12;
                echo 'month = ' . $month2 . '<br> day = ' . $day1 - 30;
                echo '<br> year = ' . $year + 57 + 1;
            } else {
                // $month2 = $month1 + 8;
                echo 'month = ' . $month1 . '<br> day = ' . $day1 - 30;
                echo '<br> year = ' . $year + 57;
            }
        } else {
            echo 'less than 30 = ' . $day1;
        }
    }
}
