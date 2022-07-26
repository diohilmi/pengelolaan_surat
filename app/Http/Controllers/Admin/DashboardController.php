<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Incoming_letters;
use App\Models\Out_letters;

class DashboardController extends Controller
{
    public function index()
    {
        $masuk = Incoming_letters::get()->count();
        $keluar = Out_letters::get()->count();

        return view('pages.admin.dashboard',[
            'masuk' => $masuk,
            'keluar' => $keluar
        ]);
    }
}
