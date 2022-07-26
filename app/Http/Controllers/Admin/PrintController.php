<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disposisi_user;

use App\Models\Letter;

class PrintController extends Controller
{
    public function index()
    {
        $item = Letter::with(['department','sender'])->where('letter_type', 'Surat Masuk')->latest()->get();

        return view('pages.admin.letter.print-incoming',[
            'item' => $item
        ]);
    }

    public function outgoing()
    {
        $item = Letter::with(['department','sender'])->where('letter_type', 'Surat Keluar')->latest()->get();

        return view('pages.admin.letter.print-outgoing',[
            'item' => $item
        ]);
    }

    public function disposisi($id)
    {
        // $item = Letter::with(['department','sender'])->where('letter_type', 'Surat Masuk')->latest()->get();

        $disposisi_user = Disposisi_user::findOrFail($id);
        // $id_files = $disposisi_user->disposisi->incoming_letters->id;

        return view('pages.admin.disposisi_user.print-disposisiuser',[
            'item' => $disposisi_user
        ]);
    }
}
