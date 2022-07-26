<?php

namespace App\Http\Controllers\Admin;

use App\Models\Letter;
use App\Models\Sender;

use App\Models\Department;
use App\Models\Out_letters;
use Illuminate\Http\Request;

use App\Models\Incoming_letters;
use App\Models\Attachment_letters;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LetterController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('pages.admin.letter.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'date_received' => 'required',
            'regarding' => 'required',
            'department_id' => 'required',
            'sender_id' => 'required',
            'letter_file' => 'required|mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        if($request->file('letter_file')){
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Letter::create($validatedData);

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_mail()
    {
        $query = Incoming_letters::get();
        // dd($query);

        if (request()->ajax()) {

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="'. route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>

                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        </br>
                        <form action="' . route('letter.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>

                        <a class="btn btn-info btn-xs" style="display: inline;" data-bs-toggle="modal" data-bs-target="#createModal'.$item->id.'">
                            <i class="fas fa-external-link-square-alt"></i> &nbsp; Disposisi
                        </a>
                    ';
                })
                // ->editColumn('post_status', function ($item) {
                //    return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                // })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }
        $items = Incoming_letters::get();

        return view('pages.admin.letter.incoming', ['items'=> $items]);
    }

    public function outgoing_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department','sender'])->where('letter_type', 'Surat Keluar')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }


        return view('pages.admin.letter.outgoing');
    }

    public function show($id)
    {
        $item = Incoming_letters::findOrFail($id);
        $files = Attachment_letters::where('incoming_letters_id', $id)->get();


        // foreach ($files as $file) {
        //     dump($file);
        // }
        // die;

        return view('pages.admin.letter.show',[
            'item' => $item,
            'files' => $files,
        ]);
    }

    public function edit($id)
    {
        // dd($id);
        $item = Incoming_letters::findOrFail($id);
        $files = Attachment_letters::where('incoming_letters_id', $id)->get();


        return view('pages.admin.letter.edit',[
            'item' => $item,
            'files' => $files,
        ]);
    }

    public function download_letter($id)
    {
        $item = Letter::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'letter_subject' => 'required',
            'letter_content' => 'required',
            'date_received' => 'required',
            'regarding' => 'required',
            'sender' => 'required',
        ]);

        $item = Incoming_letters::findOrFail($id);

        // dd($request->file('file')->getClientOriginalName());

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $saveFile = $file->move(public_path("/attachments/"), $fileName);

            $storeAttachments = Attachment_letters::create([
                'file_name' => $fileName,
                'incoming_letters_id' => $id
            ]);

        }

        // if ($validatedData['letter_type'] == 'Surat Masuk') {
        //     $redirect = 'surat-masuk';
        // } else {
        //     $redirect = 'surat-keluar';
        // }

        $item->update($validatedData);

        return redirect()
                    ->route('surat-masuk')
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function delete_file($id){
        $item = Attachment_letters::findorFail($id);
        // dd($item->file_name);
        $file_path = asset('attachments/'.$item->file_name);
        $id_surat = $item->incoming_letters_id;
        // dd($file_path);
        // dd(File::exists($file_path));

        $del_file = File::delete('attachments/'.$item->file_name);
        // dd($del_file);
        if($del_file){
            $item->delete();
            return redirect()
                    ->route('letter.edit', $id_surat)
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');

        }

        return redirect()
                    ->route('letter.edit', $id_surat)
                    ->with('errors', 'Gagal menghapus');


        // Attachment_letters::delete($filename);

    }

    public function destroy($id)
    {
        $item = Incoming_letters::findorFail($id);
        // $item = Incoming_letters::findorFail($id);

        $files = Attachment_letters::where('incoming_letters_id', $id)->get();
        // dd($files);
        foreach($files as $file){
            $del_file = File::delete('attachments/'.$file->file_name);
        }

        Attachment_letters::where('incoming_letters_id', $id)->delete();
        $item->delete();

        return redirect()
                    ->route('surat-masuk')
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function add(Request $request){
         $store = Incoming_letters::create($request->all());
        // dd($request->input('file'));
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $saveFile = $file->move(public_path("/attachments/"), $fileName);
            $storeAttachments = Attachment_letters::create([
                'file_name' => $fileName,
                'incoming_letters_id' => $store->id
            ]);
        }

        // dd($storeAttachments);
        return redirect()->route('surat-masuk')->with('success', 'Import surat successfully');

    }

    public function show_laporan(){
        return view('pages.admin.laporan.index');

    }

    public function get_laporan(Request $request){
        $date = $request->input('month');
        $dateExpl = explode('-', $date);
        // dd($dateExpl[1]);
        // dd($request->all());
        if ($request->input('letter_type') == "1"){
            $data  = Incoming_letters::whereMonth('letter_date', $dateExpl[1])->whereYear('letter_date', $dateExpl[0])->get();
            // dd($data);
        }else{
            $data  = Out_letters::whereMonth('letter_date', $dateExpl[1])->whereYear('letter_date', $dateExpl[0])->get();
        }

        if (request()->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->make();
        }

        return view('pages.admin.laporan.index', ['data' => $data]);



    }
}
