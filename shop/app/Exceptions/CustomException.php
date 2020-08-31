<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CustomException extends Exception
{
    //custom ERROR page
    public function render(Request $request){
        return view('product.error', ['msg' => $this->getMessage()]);
    }
}
