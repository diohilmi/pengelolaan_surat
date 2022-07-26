{{-- {{ dd($file) }} --}}
@extends('layouts.admin')

@section('title')
   Detail Surat
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
                                Detail Surat Masuk
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Semua Surat Masuk
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
                        <div class="card-header">Detail Surat Masuk</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Nomor Surat</th>
                                            <td>{{ $item->letter_no }}</td>
                                        </tr>
                                         <tr>
                                            <th>Email</th>
                                            <td>{{ $item->email }}</td>
                                        </tr>
                                         <tr>
                                            <th>Subject Surat</th>
                                            <td>{{ $item->letter_subject }}</td>
                                        </tr>
                                         <tr>
                                            <th>Isi Surat</th>
                                            <td>{{ $item->letter_content }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Surat</th>
                                            <td>{{ $item->letter_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Diterima</th>
                                            <td>{{ $item->date_received }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perihal</th>
                                            <td>{{ $item->regarding }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengirim Surat</th>
                                            <td>{{ $item->sender }}</td>
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
                                    <embed src="{{ asset('attachments/'.$file->file_name) }}" width="100" height="150" type="application/pdf"></embed>
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

