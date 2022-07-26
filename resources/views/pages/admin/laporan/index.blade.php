@extends('layouts.admin')

@section('title')
    Data Laporan
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Data Laporan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            List Data Laporan
                            <!-- <a class="btn btn-sm btn-primary" href="{{ route('kode-surat.create') }}" data-bs-toggle="modal" data-bs-target="#createModal">
                                Tambah Data
                            </a> -->
                        </div>
                        <div class="card-body">
                            {{-- Alert --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
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
                            <form action="{{ route('get-laporan') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="month" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                            <div class="col-sm-12">
                                                <input type="month" class="form-control @error('date') is-invalid @enderror" name="month" required>
                                            </div>
                                            @error('month')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                            @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-12">
                                            <label for="letter_type">Pilih Surat</label>
                                                <select name="letter_type" class="form-select" required>
                                                    <option value="">Pilih..</option>
                                                    <option value="1">Surat Masuk</option>
                                                    <option value="2">Surat Keluar</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="reset" class="btn btn-danger" type="button" data-bs-dismiss="modal"></input>
                                    <button class="btn btn-success" type="submit">Tampilkan</button>
                                </div>
                            </form>
                            {{-- List Data --}}
                            @if(isset($data))
                            <table class="table table-striped table-hover table-sm" id="crudTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No. Surat</th>
                                        <th>Tgl. Surat</th>
                                        <th>Tgl. Diterima</th>
                                        <th>Pengirim</th>
                                        <th>Perihal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->letter_no }}</td>
                                        <td>{{ $item->letter_date }}</td>
                                        <td>{{ $item->date_received }}</td>
                                        <td>{{ $item->sender }}</td>
                                        <td>{{ $item->regarding }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('addon-script')
  {{-- <script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          type: 'POST',
          url: '{!! url()->current() !!}',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
          {
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          { data: 'letter_no', name: 'letter_no' },
          { data: 'letter_date', name: 'letter_date' },
          { data: 'date_received', name: 'date_received' },
          { data: 'sender', name: 'sender' },
          { data: 'sender', name: 'sender' },
          { data: 'regarding', name: 'regarding' },
        ]
    }); --}}
  </script>
@endpush
