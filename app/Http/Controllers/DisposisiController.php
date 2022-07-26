<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use App\Models\Incoming_letters;
use Yajra\DataTables\Facades\DataTables;


class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disposisiMix = Disposisi::with('incoming_letters');
        // dd($disposisi);

         if (request()->ajax()) {
            return Datatables::eloquent($disposisiMix)
                ->addColumn('incoming_letters', function (Disposisi $disposisi) {
                    return $disposisi->incoming_letters->letter_subject;
                })
                ->addColumn('letters_no', function (Disposisi $disposisi) {
                    return $disposisi->incoming_letters->letter_no;
                })
                ->addColumn('action', function ($item) {
                    return '

                       <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-info btn-xs" style="display: inline;" data-bs-toggle="modal" data-bs-target="#disposisiModal'.$item->id.'">
                            <i class="fas fa-external-link-square-alt"></i>
                        </a>&nbsp;

                        <form action="' . route('disposisi.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>

                    ';
                })
                // ->editColumn('post_status', function ($item) {
                //    return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                // })
                ->addIndexColumn()
                ->removeColumn('id')
                // ->rawColumns(['action','post_status'])
                ->make();
        }

        $disposisi = Disposisi::all();
        $incoming_letters = Incoming_letters::all();
        $user = User::all();


        return view('pages.admin.disposisi.index', [
            'disposisi' => $disposisi,
            'incoming_letters' => $incoming_letters,
            'users' => $user,
        ]);


    }

    // public function disposisi_administrator()
    // {
    //     //
    //     if (request()->ajax()) {
    //         $query = Disposisi::latest()->get();

    //         return Datatables::of($query)
    //             ->addColumn('action', function ($item) {
    //                 return '
    //                     <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
    //                         <i class="fas fa-edit"></i> &nbsp; Ubah
    //                     </a>
    //                     <form action="' . route('disposisi-surat.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
    //                         ' . method_field('delete') . csrf_field() . '
    //                         <button class="btn btn-danger btn-xs">
    //                             <i class="far fa-trash-alt"></i> &nbsp; Hapus
    //                         </button>
    //                     </form>
    //                 ';
    //             })
    //             ->addIndexColumn()
    //             ->removeColumn('id')
    //             ->rawColumns(['action'])
    //             ->make();
    //     }
    //     $disposisi = Disposisi::all();

    //     return view('pages.admin.disposisi.index',[
    //         'disposisi' => $disposisi
    //     ]);
    // }

    // public function disposisi_pegawai_unit()
    // {
    //     //
    //     if (request()->ajax()) {
    //         $query = Disposisi::latest()->get();

    //         return Datatables::of($query)
    //             ->addColumn('action', function ($item) {
    //                 return '
    //                     <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
    //                         <i class="fa fa-search-plus"></i> &nbsp ; Detail
    //                     </a>
    //                     <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
    //                         <i class="fas fa-edit"></i> &nbsp; Konfirmasi
    //                     </a>

    //                 ';
    //             })
    //             ->addIndexColumn()
    //             ->removeColumn('id')
    //             ->rawColumns(['action'])
    //             ->make();
    //     }
    //     $disposisi = Disposisi::all();

    //     return view('pages.admin.disposisi.index_pegawai_unit',[
    //         'disposisi' => $disposisi
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'sifat' => 'required',
            'perintah' => 'required',
            'isi' => 'required',
            'incoming_letters_id' => 'required',
        ]);

        Disposisi::create($validatedData);

        return redirect()
                    ->route('disposisi.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'sifat' => 'required',
            'perintah' => 'required',
            'isi' => 'required',
            'incoming_letters_id' => 'required'
        ]);

        Disposisi::where('id', $id)
                ->update($validatedData);

        return redirect()
                    ->route('disposisi.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Disposisi::findorFail($id);

        $item->delete();

        return redirect()
                    ->route('disposisi.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
