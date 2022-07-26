
@php
    $files = json_decode(base64_decode(Request::input('file')))
@endphp
{{-- {{ dd(request()->input('tanggal')) }} --}}

@extends('layouts.admin')

@section('title')
   Tambah Surat
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
                                Tambah Surat
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('store-surat') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gx-4">
                    <div class="col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header">Form Surat</div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">No. Surat</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                                        <input type="text" class="form-control @error('letter_no') is-invalid @enderror" value="{{ old('letter_no') }}" name="letter_no" placeholder="Nomor Surat" required>
                                    </div>
                                    @error('letter_no')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ request()->input('pengirim') }}" name="email" placeholder="Email" required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_content" class="col-sm-3 col-form-label">Isi Surat</label>
                                    <div class="col-sm-9">
                                        <textarea rows="8" class="form-control @error('letter_content') is-invalid @enderror" name="letter_content" placeholder="letter_content" required>{{ request()->input('isi') }}</textarea>
                                    </div>
                                    @error('letter_content')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_subject" class="col-sm-3 col-form-label">Subjek Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('letter_subject') is-invalid @enderror" value="{{ request()->input('subject') }}" name="letter_subject" placeholder="letter_subject" required>
                                    </div>
                                    @error('letter_subject')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="sender" class="col-sm-3 col-form-label">Pengirim</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('sender') is-invalid @enderror" value="{{ old('sender') }}" name="sender" placeholder="sender" required>
                                    </div>
                                    @error('sender')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('letter_date') is-invalid @enderror" value="{{ request()->input('tanggal') }}" name="letter_date" required>
                                    </div>
                                    @error('letter_date')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="date_received" class="col-sm-3 col-form-label">Tanggal Diterima</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('date_received') is-invalid @enderror" value="{{ old('date_received') }}" name="date_received" required>
                                    </div>
                                    @error('date_received')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('regarding') is-invalid @enderror" value="{{ old('regarding') }}" name="regarding" placeholder="Perihal" required>
                                    </div>
                                    @error('regarding')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_file" class="col-sm-3 col-form-label">File</label>
                                    <div class="col-sm-9">
                                        @if(request()->input('file_type') == 'pdf')
                                            @foreach ($files as $file )
                                                <li><a href="{{ asset('attachments/'.$file) }}">{{ $file }}</a></li>
                                                <input type="hidden" name="file[]" value="{{ $file }}">
                                            @endforeach
                                        @else
                                            @foreach ($files as $file )
                                                <a href="{{ asset('attachments/'.$file) }}"><img src="{{ asset('attachments/'.$file) }}" width="60" class="img img-responsive mb-2"></a>
                                                <input type="hidden" name="file[]" value="{{ $file }}">
                                            @endforeach
                                        @endif

                                        <input type="file" class="form-control @error('letter_file') is-invalid @enderror" value="{{ old('letter_file') }}" name="letter_file">


                                    </div>
                                    @error('letter_file')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".selectx").select2({
            theme: "bootstrap-5"
        });
    </script>
@endpush

