<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonwloadFController extends Controller
{
    public function index()
    {

    }

    public function download()
    {
        $path=public_path('letterF/Format_Surat.doc');
        return response()->download($path);
    }
}
