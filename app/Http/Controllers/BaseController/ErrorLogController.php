<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use App\Models\ErrorsInWebsite;
use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    protected function logError(\Throwable $th)
    {

        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        $checkSame = ErrorsInWebsite::where('error', $th->getMessage())
            ->where('controller_name', $this->getControllerName($trace))
            ->where('method', $this->getMethodName($trace))->first();

        $error = [
            'line_number' => $th->getLine(),
            'error' => $th->getMessage(),
            'controller_name' => $this->getControllerName($trace),
            'method' => $this->getMethodName($trace),
            'count_error' => 1
        ];
        if (!$checkSame) {
            ErrorsInWebsite::create($error);
        } else {
            $checkSame->count_error += 1;
            $checkSame->save();
        }
        return view('errors.code-error');
    }
    protected function getControllerName($trace)
    {
        return str_replace('Controller.php', '', class_basename($trace[1]['class']));
    }

    protected function getMethodName($trace)
    {
        return $trace[1]['function'];
    }
}
