<?php

namespace App\Http\Controllers;

use App\Models\Out_letters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class OutgoingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Out_letters::get();

        if (auth()->user()->positions_id != "1" && auth()->user()->positions_id != "3") {
            if (request()->ajax()) {
                return Datatables::of($query)
                            ->addColumn('action', function ($item) {
                                if ($item->status == "Accept") {
                                    return '
                                <a class="btn btn-success btn-xs" href="' .asset('attachments/'.$item->file) . '">
                                        <i class="fas fa-download"></i> &nbsp; Download
                                    </a>
                                ';
                                } else {
                                    return '
                                <a class="btn btn-success btn-xs" href="' .asset('attachments/'.$item->file) . '">
                                    <i class="fas fa-download"></i> &nbsp; Download
                                </a>
                                <a class="btn btn-primary btn-xs" href="' . route('outgoing.edit', $item->id) . '">
                                    <i class="fas fa-edit"></i> &nbsp; Ubah
                                </a> 
                                <form action="' . route('outgoing.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="btn btn-danger btn-xs">
                                        <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                    </button>
                                </form>
                            ';
                                }
                            })

                            ->addIndexColumn()
                            ->removeColumn('id')
                            // ->rawColumns(['action','post_status'])
                            ->make();
            }
        }

        if (auth()->user()->positions_id != "2" && auth()->user()->positions_id != "3") {
            if (request()->ajax()) {
                return Datatables::of($query)
                            ->addColumn('action', function ($item) {
                                return '
                                <a class="btn btn-success btn-xs" href="' .asset('attachments/'.$item->file) . '">
                                        <i class="fas fa-download"></i> &nbsp; Download
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="' . route('outgoing.edit', $item->id) . '">
                                        <i class="fas fa-edit"></i> &nbsp; Ubah
                                    </a>
                                    <form action="' . route('outgoing.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button class="btn btn-danger btn-xs">
                                            <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                        </button>
                                    </form>
                                ';
                            })
                            ->addIndexColumn()
                            ->removeColumn('id')
                            // ->rawColumns(['action','post_status'])
                            ->make();
            }
        }

        else {
            if (request()->ajax()) {
                return Datatables::of($query)
                            ->addColumn('action', function ($item) {
                                return '
                                <a class="btn btn-success btn-xs" href="' .asset('attachments/'.$item->file) . '">
                                        <i class="fas fa-download"></i> &nbsp; Download
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="' . route('outgoing.edit', $item->id) . '">
                                        <i class="fas fa-edit"></i> &nbsp; Ubah
                                    </a>
                                    <a class="btn btn-success btn-xs" href="' . route('outgoing-konfirmasi', $item->id) . '">
                                        <i class="fa fa-check-square"></i>&nbsp; Setejui
                                    </a>
                                    <form action="' . route('outgoing.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button class="btn btn-danger btn-xs">
                                            <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                        </button>
                                    </form>
                                ';
                            })
                            ->addIndexColumn()
                            ->removeColumn('id')
                            // ->rawColumns(['action','post_status'])
                            ->make();
            }
            
        }


        return view('pages.admin.outgoing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.outgoing.create');
    }

    public function konfirmasi($id)
    {
        // dd($validatedData);

        $item = Out_letters::findOrFail($id);
        if ($item->status == "Accept") {
            return redirect()
            ->route('outgoing.index')
            ->with('success', 'status sudah accept');
        } else {
            $item->status = 'Accept';
            $item->save();
            return redirect()
                        ->route('outgoing.index')
                        ->with('success', 'Sukses! 1 surat keluar terkonfirmasi');
        }

        
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $store = Out_letters::create($request->all());

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $store->file = $fileName;
            $store->save();
            // dd($fileName);
            $saveFile = $file->move(public_path("/attachments/"), $fileName);
        }

        return redirect()
                ->route('outgoing.index')
                ->with('success', 'Sukses! 1 Data Berhasil Diubah');


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
        $item = Out_letters::findOrFail($id);
        return view('pages.admin.outgoing.edit', ['item' => $item]);
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
        // dd($request->all());
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'tujuan' => 'required',
            'keterangan' => 'required',
            'regarding' => 'required',
            'status' => 'required',
            'file' => 'required'
        ]);

        // dd($validatedData);

        $item = Out_letters::findOrFail($id);

        // dd($request->file('file')->getClientOriginalName());

        if ($request->file('file')) {
            $del_file = File::delete('attachments/'.$item->file);
            $file = $request->file('file');
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $validatedData['file'] = $fileName;
            $saveFile = $file->move(public_path("/attachments/"), $fileName);
        }

        // if ($validatedData['letter_type'] == 'Surat Masuk') {
        //     $redirect = 'surat-masuk';
        // } else {
        //     $redirect = 'surat-keluar';
        // }

        $item->update($validatedData);

        return redirect()
                    ->route('outgoing.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Out_letters::findorFail($id);
        $del_file = File::delete('attachments/'.$item->file);
        $item->delete();

        return redirect()->route('outgoing.index')->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function delete_file($id)
    {
        $item = Out_letters::findorFail($id);
        // dd($item->file_name);
        $file_path = asset('attachments/'.$item->file_name);
        $id_surat = $item->incoming_letters_id;
        // dd($file_path);
        // dd(File::exists($file_path));

        $del_file = File::delete('attachments/'.$item->file);
        // dd($del_file);
        if ($del_file) {
            $item->delete();
            return redirect()
                    ->route('letter.edit', $id_surat)
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
        }
    }

    public function show_pdf($id)
    {
        $item = Attachment_letters::get()->where('id', $id)->first();
        // dd($item);
        $pathToFile = public_path('attachments/'.$item->file_name);

        // $disposisi_user = Disposisi_user::findOrFail($id);
        // $id_files = $disposisi_user->disposisi->incoming_letters->id;
        // return Response::make(file_get_contents($pathToFile), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="'.$item->file_name.'"'
        // ]);
        return response()->file($pathToFile);

        // return view('pages.admin.disposisi_user.show-pdf',[
        //     'file' => $item
        // ]);
    }
}
