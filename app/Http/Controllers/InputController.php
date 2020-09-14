<?php

namespace App\Http\Controllers;

use App\Contracts\FileParserInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InputController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('index');
    }

    public function fileUpload(Request $request, FileParserInterface $fileParser){
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $transactions = $fileParser->parse($file);

            return app()->call('App\Http\Controllers\OutputController@calculate', ['transactions' => $transactions]);
        }
    }

    //
}
