{{-- {{ dd($errors) }} --}}
@extends('layouts.admin')

@section('title')
   Ubah Surat
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
                                Ubah Surat
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Semua Surat
                            </button>
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
            <form action="{{ route('outgoing.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row gx-4">
                    <div class="col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header">Form Surat</div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">No. Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('letter_no') is-invalid @enderror" value="{{ $item->letter_no }}" name="letter_no" placeholder="Nomor Surat.." required>
                                    </div>
                                    @error('letter_no')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('letter_date') is-invalid @enderror" value="{{ $item->letter_date }}" name="letter_date" required>
                                    </div>
                                    @error('letter_date')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('regarding') is-invalid @enderror" value="{{ $item->regarding }}" name="regarding" placeholder="Perihal.." required>
                                    </div>
                                    @error('regarding')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control @error('tujuan') is-invalid @enderror" value="{{ $item->tujuan }}" name="tujuan" placeholder="Tujuan" required>
                                    </div>
                                    @error('tujuan')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="status" class="col-sm-3 col-form-label">status</label>
                                    <div class="col-sm-9">
                                        @if(auth()->user()->positions_id != "1" && auth()->user()->positions_id != "3")
                                        <select class="form-select" {{ ( $item->status == "Accept") ? 'disabled' : '' }} name="status" id="status">
                                            <option value="Accept" {{ ( $item->status == "Accept") ? 'selected' : '' }}>Accept</option>
                                            <option value="Request" {{ ( $item->status == "Request") ? 'selected' : '' }} >Request</option>
                                            <option value="Decline" {{ ( $item->status == "Decline") ? 'selected' : '' }}>Decline</option>
                                        </select>
                                        @else
                                            <select class="form-select" name="status" id="status">
                                            <option value="Accept" {{ ( $item->status == "Accept") ? 'selected' : '' }}>Accept</option>
                                            <option value="Request" {{ ( $item->status == "Request") ? 'selected' : '' }} >Request</option>
                                            <option value="Decline" {{ ( $item->status == "Decline") ? 'selected' : '' }}>Decline</option>
                                        </select>
                                        @endif
                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                       <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" value="{{ $item->keterangan }}" name="keterangan" placeholder="keterangan" required>{{ $item->keterangan }}</textarea>
                                    </div>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="file" class="col-sm-3 col-form-label">File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}" name="file">
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                    <div class="card mb-4">
                        {{-- @foreach ($files as $file) --}}
                            <div class="card-header">
                                Attachment Surat - {{ $item->file }} <br>
                                <a href="{{ asset('attachments/'.$item->file) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </a>
                                {{-- <a href="{{ route('delete-file', $item->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a> --}}
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    @if (pathinfo(asset('attachments/'.$item->file), PATHINFO_EXTENSION) == "pdf")
                                        <embed src="{{ asset('attachments/'.$item->file) }}" width="100" height="150" type="application/pdf"></embed>
                                    @else
                                        <img src="{{ asset('attachments/'.$item->file) }}" width="100" height="150"/>
                                    @endif

                                </div>
                            </div>
                        {{-- @endforeach --}}
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

