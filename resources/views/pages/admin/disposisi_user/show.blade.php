@extends('layouts.admin')

@section('title')
   Detail Dispisi Surat Masuk
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Detail Disposisi User
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Disposisi User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="row gx-4">
                <div class="col-lg-7">
                    <div class="card mb-4">
                            
                        <div class="card-header">Detail Disposisi User 
                            <a class="btn btn-sm btn-primary" href="{{ route('print-disposisi-surat', $item->id) }}" target="_blank">
                                <i data-feather="printer"></i> &nbsp;
                                Cetak Disposisi
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>No Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengirim Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->sender }}</td>
                                        </tr>
                                         <tr>
                                            <th>Subject Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Isi Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_content }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tgl Surat</th>
                                            <td>{{ $item->disposisi->incoming_letters->letter_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tgl Diterima</th>
                                            <td>{{ $item->disposisi->incoming_letters->date_received }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perihal</th>
                                            <td>{{ $item->disposisi->incoming_letters->regarding }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perintah</th>
                                            <td>{{ $item->disposisi->perintah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sifat</th>
                                            <td>{{ $item->disposisi->sifat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $item->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td>{{ $item->user->position->position }}</td>
                                        </tr>
                                         <tr>
                                            <th>Email</th>
                                            <td>{{ $item->user->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card mb-4">
                         @foreach ($files as $file)
                        <div class="card-header">
                            File Surat - <a href="{{ route('show-pdf', $file->id) }}" target="_blank" >{{ $file->file_name }}</a>
                            <a href="{{ asset('attachments/'.$file->file_name) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                @if (pathinfo(asset('attachments/'.$file->file_name), PATHINFO_EXTENSION) == "pdf")
                                    <iframe src="{{ asset('attachments/'.$file->file_name) }}" width="100" height="150" type="application/pdf"></iframe>
                                @else
                                    <img src="{{ asset('attachments/'.$file->file_name) }}" width="100" height="150"/>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

