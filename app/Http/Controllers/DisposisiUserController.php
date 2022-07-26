<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Disposisi;
use Response;
use Illuminate\Http\Request;

use App\Models\Disposisi_user;
use App\Models\Incoming_letters;
use App\Models\Attachment_letters;
use Yajra\DataTables\Facades\DataTables;

class DisposisiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index_pegawai_unit()
    {
        $disposisiMix = Disposisi_user::all();

        // $disposisiUser = Disposisi_user::where("id_user")
        $data = [];
        foreach ($disposisiMix as $item) {
            if ($item->user->positions_id == 2) {
                array_push($data, $item);
            }
        }
         if (request()->ajax()) {
             return Datatables::of($data)
                ->addColumn('letter_no', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_no;
                })
                ->addColumn('sifat', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->sifat;
                })
                ->addColumn('letter_date', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_date;
                })
                ->addColumn('date_received', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->date_received;
                })
                ->addColumn('sender', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->sender;
                })
                ->addColumn('regarding', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->regarding;
                })
                ->addColumn('action', function ($item) {
                    return '
                         <a class="btn btn-success btn-xs" href="' . route('disposisi-user.show', $item->id) . '">
                            <i class="fa fa-search-plus"></i>
                        </a>
                       <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
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

        $disposisi_user = Disposisi_user::all();
        $disposisi = Disposisi::all();
        $positions = Position::all();
        $users = User::all();

        // dd($user);

        return view('pages.admin.disposisi_user.index', [
            'disposisi' => $disposisi,
            'disposisi_users' => $disposisi_user,
            'users' => $users,
            'positions' => $positions,
        ]);

    }

    public function index_direktur()
    {
        $disposisiMix = Disposisi_user::all();

        // $disposisiUser = Disposisi_user::where("id_user")
        $data = [];
        foreach ($disposisiMix as $item) {
            if($item->user->positions_id == 3){
                array_push($data, $item);
            }
        }
         if (request()->ajax()) {
             return Datatables::of($data)
                ->addColumn('letter_no', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_no;
                })
                ->addColumn('sifat', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->sifat;
                })
                ->addColumn('letter_date', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_date;
                })
                ->addColumn('date_received', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->date_received;
                })
                ->addColumn('sender', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->sender;
                })
                ->addColumn('regarding', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->regarding;
                })
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('disposisi-user.show', $item->id) . '">
                            <i class="fa fa-search-plus"></i>
                        </a>
                       <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
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

        $disposisi_user = Disposisi_user::all();
        $disposisi = Disposisi::all();
        $positions = Position::all();
        $users = User::all();

        // dd($user);

        return view('pages.admin.disposisi_user.index', [
            'disposisi' => $disposisi,
            'disposisi_users' => $disposisi_user,
            'users' => $users,
            'positions' => $positions,
        ]);

    }

    public function index()
    {
        $disposisiMix = Disposisi_user::with('disposisi', 'user');
        // dd($disposisiMix);

         if (request()->ajax()) {
             return Datatables::eloquent($disposisiMix)
                ->addColumn('letter_no', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_no;
                })
                ->addColumn('sifat', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->sifat;
                })
                ->addColumn('letter_date', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->letter_date;
                })
                ->addColumn('date_received', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->date_received;
                })
                ->addColumn('sender', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->sender;
                })
                ->addColumn('regarding', function (Disposisi_user $disposisi_user) {
                    return $disposisi_user->disposisi->incoming_letters->regarding;
                })
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('disposisi-user.show', $item->id) . '">
                            <i class="fa fa-search-plus"></i>
                        </a>

                       <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal'.$item->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('disposisi-user.destroy', $item->id) . '" style="display: inline;" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
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

        $disposisi_user = Disposisi_user::all();
        $disposisi = Disposisi::all();
        $positions = Position::all();
        $users = User::all();

        // dd($user);

        return view('pages.admin.disposisi_user.index', [
            'disposisi' => $disposisi,
            'disposisi_users' => $disposisi_user,
            'users' => $users,
            'positions' => $positions,
        ]);

    }

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
        Disposisi_user::create($request->all());
        return redirect()
                    ->route('disposisi-user.index')
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
        $disposisi_user = Disposisi_user::findOrFail($id);
        $id_files = $disposisi_user->disposisi->incoming_letters->id;

        $files = Attachment_letters::where('incoming_letters_id', $id_files)->get();
        // dd($id_files);


        // dd($disposisi_user);
        // $disposisi = Disposisi::all();
        // $positions = Position::all();
        // $users = User::all();

        return view('pages.admin.disposisi_user.show', [
            // 'disposisi' => $disposisi,
            'item' => $disposisi_user,
            'files' => $files,
            // 'users' => $users,
            // 'positions' => $positions,
        ]);

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
    // public function update_pegawai_unit(Request $request, $id)
    // {
    //     // dd($request->all());
    //      $validatedData = $request->validate([
    //         'disposisi_id' => 'required',
    //         'users_id' => 'required',
    //         'status' => 'required',
    //     ]);

    //     Disposisi_user::where('id', $id)
    //             ->update($validatedData);


    //     return redirect()
    //                 ->route('disposisi-user.index')
    //                 ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');

    // }

    // public function update_direktur(Request $request, $id)
    // {
    //     // dd($request->all());
    //      $validatedData = $request->validate([
    //         'disposisi_id' => 'required',
    //         'users_id' => 'required',
    //         'status' => 'required',
    //     ]);

    //     Disposisi_user::where('id', $id)
    //             ->update($validatedData);


    //     return redirect()
    //                 ->route('disposisi-user.index')
    //                 ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');

    // }

    public function update(Request $request, $id)
    {
        // dd($request->all());
         $validatedData = $request->validate([
            'disposisi_id' => 'required',
            'users_id' => 'required',
            'status' => 'required',
        ]);

        Disposisi_user::where('id', $id)
                ->update($validatedData);


        if(auth()->user()->positions_id == 2){
            return redirect()
            ->route('disposisi-user-pegawai_unit')
            ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');
        } if(auth()->user()->positions_id == 3){
            return redirect()
            ->route('disposisi-user-direktur')
            ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');
        } else{
            return redirect()
            ->route('disposisi-user.index')
            ->with('success', 'Sukses! 1 Data Berhasil Diperbarui');
        }
        

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item = Disposisi_user::findorFail($id);

        $item->delete();

        return redirect()
                    ->route('disposisi-user.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
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
