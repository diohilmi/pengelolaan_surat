<?php

namespace App\Http\Controllers\Admin;
use App\Models\Letter;

use App\Models\Sender;
use Illuminate\Http\Request;
use App\Models\Incoming_letters;

use App\Models\Attachment_letters;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ImportController extends Controller
{
    public function index(){
        set_time_limit(300);


        $oClient = \Webklex\IMAP\Facades\Client::account('default');
        // // dd($oClient);


        // //Connect to the IMAP Server
        $oClient->connect();

        // //Get all Mailboxes
        // /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders("INBOX");
        // // dd($aFolder);
        $dataku = array();

        foreach($aFolder as $oFolder){
            
            $aMessage = $oFolder->query()->since(now()->subDays(30))->get();
            foreach($aMessage as $oMessage){

                $subject = $oMessage->getSubject().'';
                $isi = $oMessage->getTextBody().'';

                $aAttachments = $oMessage->getAttachments();
                $loop_file = array();
                // $loop_type = array();

                // dump($aAttachments);
                if($aAttachments->count() > 0){
                    foreach ($aAttachments as $aAttachment) {
                        $file_temp = $aAttachment->id.'-'.str_replace(' ','',$aAttachment->name);
                        // $file_type = explode("/", $aAttachment->content_type);
                        // $file_type = $file_type[0];
                        // dump($file_type);
                        array_push($loop_file, $file_temp);
                        // array_push($loop_type, $file_type);


                        if(!file_exists(public_path("/attachments/".$file_temp))){
                            $aAttachment->save(public_path("/attachments/"), $file_temp);
                        }
                    }
                }

                $pengirim = $oMessage->getFrom()[0]->mail;
                $date_letter = \Carbon\Carbon::parse($oMessage->date->toDate())->format('Y-m-d');

                // dd( $pengirim = $oMessage->getFrom());
                // $file_type = explode("/", $aAttachment->content_type);
                $file_type = '';
                // dump($loop_file);
                if (count($loop_file) > 0) {
                    $file_type = explode(".", $loop_file[0]);
                    $file_type = $file_type[1];
                }
                $lop_email = array(
                    "attach"=> $oMessage->getAttachments()->count(),
                    "subject"=> $subject,
                    "isi"=> $isi,
                    "pengirim" => $pengirim,
                    "file" => $loop_file,
                    'tanggal' => $date_letter,
                    "file_type" => $file_type
                );

                // echo $oMessage->getSubject();
                array_push($dataku,$lop_email);
            }
        }
        // dd($dataku);
        if (request()->ajax()) {
            return Datatables::of($dataku)

                ->addIndexColumn()
                // ->removeColumn('id')
                ->addColumn('action', function ($item) {

                    return '
                        <form action="'.route("simpan-surat").'" method="POST" enctype="multipart/form-data">
                            ' . method_field('post') . csrf_field() . '
                            <input type="hidden" name="pengirim" value="'.$item['pengirim'].'">
                            <input type="hidden" name="subject" value="'.$item['subject'].'">
                            <input type="hidden" name="isi" value="'.$item['isi'].'">
                            <input type="hidden" name="file_type" value="'.$item['file_type'].'">
                            <input type="hidden" name="tanggal" value="'.$item['tanggal'].'">
                            <input type="hidden" name="file" value="'.base64_encode(json_encode($item['file'])).'">
                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> &nbsp; Simpan Surat
                            </button>
                        </form>
                    ';
                })
                ->make();
        }

        return view('pages.admin.letter.import');

    }

    public function create(){
        return view('pages.admin.letter.create');
    }

    public function store(Request $request){
        $store = Incoming_letters::create($request->all());
        // dd($request->input('file'));
        if($request->has('file')){
            foreach ($request->input('file') as $file) {
                $storeAttachments = Attachment_letters::create([
                    'file_name' => $file,
                    'incoming_letters_id' => $store->id
                ]);
            }
        }

        // dd($storeAttachments);
        return redirect()->route('surat-masuk')->with('success', 'Import surat successfully');

    }
}
