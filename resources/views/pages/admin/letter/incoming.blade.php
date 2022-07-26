@extends('layouts.admin')

@section('title')
    Surat Masuk
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
                                Surat Masuk
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
                            <a class="btn btn-sm btn-success" href="{{ route('letter.create') }}">
                                <i class="fas fa-plus"></i> &nbsp;
                                Tambah Data
                            </a>
                            <!-- <a class="btn btn-sm btn-primary" href="{{ route('print-surat-masuk') }}" target="_blank">
                                <i data-feather="printer"></i> &nbsp;
                                Cetak Laporan
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
                                        {{-- @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach --}}
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- List Data --}}
                            <table class="table table-striped table-hover table-sm" id="crudTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No. Surat</th>
                                        <th>Email</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Perihal</th>
                                        <th>Pengirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

{{-- Modal Create --}}
    @foreach ($items as $item)
        @php
            $id = $item["id"];
        @endphp
        <div class="modal fade" id="createModal{{ $id }}" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow:hidden;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModal{{ $id }}">Tambah Data Disposisi</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('disposisi.store', $item->id) }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="sifat">Sifat</label>
                                    <!-- <input type="text" name="sifat" class="form-control" placeholder="Masukan Sifat.." required> -->
                                    <select name="sifat" class="form-select">
                                        <option value="biasa">Biasa</option>
                                        <option value="segera">Segera</option>
                                        <option value="sangat segera">Sangat Segera</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="perintah">Perintah</label>
                                    <input type="text" name="perintah" class="form-control" placeholder="Masukan Perintah.." required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="isi">Isi</label>
                                    <input type="text" name="isi" class="form-control" placeholder="Masukan Isi.." required>
                                </div>
                            </div>

                            <div class="mb-3">
                            <div class="col-md-12">
                                <label for="letter_id">Pilih Surat</label>
                                <input type="hidden" name="incoming_letters_id" id="incoming_letters_id" value="{{ $item->id }}">
                                <select name="incoming_letters_id" disabled class="form-select">
                                    <option selected>No. Surat</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" {{ ( $item->id == $id) ? 'selected' : '' }}>{{ $item->letter_no }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="letter_id" value="{{ $letter_id; }}" class="form-control" placeholder="Masukan isi.." required> --}}
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@push('addon-script')
  <script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{!! url()->current() !!}',
        },
        columns: [
          {
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          { data: 'letter_no', name: 'letter_no' },
          { data: 'email', name: 'email' },
          { data: 'date_received', name: 'date_received' },
          { data: 'regarding', name: 'regarding' },
          { data: 'sender', name: 'sender' },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searcable: false,
            width: '19%'
          },
        ]
    });
  </script>
@endpush


