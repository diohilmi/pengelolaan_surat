@extends('layouts.admin')

@section('title')
    Disposisi Surat
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
                                Disposisi Surat
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
                            List Disposisi Surat
                            <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                Tambah Data
                            </a>
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
                            {{-- List Data --}}
                            <table class="table table-striped table-hover table-sm" id="crudTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No. Surat</th>
                                        <th>Sifat</th>
                                        <th>Perintah</th>
                                        <th>Isi</th>
                                        <th>Subject Surat</th>
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

    @foreach ($disposisi as $item)
        @php
            $id = $item["id"];
            $tujuan = $item["tujuan"];
            $sifat = $item["sifat"];
            $perintah = $item["perintah"];
            $isi = $item["isi"];
            $letter_id = $item["incoming_letters_id"];
            // dump($letter_id);

        @endphp
        <div class="modal fade" id="disposisiModal{{ $id }}" role="dialog" aria-labelledby="disposisiModal" aria-hidden="true" style="overflow:hidden;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disposisiModal{{ $id }}">Tambah Disposisi User</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('disposisi-user.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="tujuan">Disposisi Surat</label>
                                    <input type="text" name="disposisi_id" disabled class="form-control" placeholder="Masukan nomor surat" value="{{ $id }}" required>
                                    <input type="hidden" name="disposisi_id" class="form-control" placeholder="Masukan nomor surat" value="{{ $id }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="users_id">User</label>
                                    <select name="users_id" class="form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name. ' - ' . $user->position->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="">Pilih..</option>
                                        <option value="Diajukan">Diajukan</option>
                                        <option value="Diterima">Diterima</option>
                                    </select>
                                </div>
                                <!-- <div class="col-sm-12">

                                </div> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-success" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

<div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow:hidden;">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createModal">Tambah Data</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('disposisi.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="tujuan">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" placeholder="Masukan tujuan.." required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="sifat">Sifat</label>
                        <input type="text" name="sifat" class="form-control" placeholder="Masukan sifat.." required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="perintah">Perintah</label>
                        <input type="text" name="perintah" class="form-control" placeholder="Masukan perintah.." required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="isi">Isi</label>
                        <input type="text" name="isi" class="form-control" placeholder="Masukan isi.." required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="letter_id">Pilih Surat</label>
                        <select name="incoming_letters_id" class="form-select">
                            <option selected>Pilih Subject Surat</option>
                            @foreach ($incoming_letters as $incoming_letter)
                                <option value="{{ $incoming_letter->id }}">{{ $incoming_letter->letter_subject }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="letter_id" value="{{ $letter_id; }}" class="form-control" placeholder="Masukan isi.." required> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
</div>

{{-- Modal Update --}}
    @foreach ($disposisi as $item)
        @php
            $id = $item["id"];
            $sifat = $item["sifat"];
            $perintah = $item["perintah"];
            $isi = $item["isi"];
            $letter_id = $item["incoming_letters_id"];
            // dump($letter_id);

        @endphp
        <div class="modal fade" id="updateModal{{ $id }}" role="dialog" aria-labelledby="updateModal" aria-hidden="true" style="overflow:hidden;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModal{{ $id }}">Ubah Data</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('disposisi.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="sifat">Sifat</label>
                                    <!-- <input type="text" name="sifat" class="form-control" value="{{ $sifat; }}" placeholder="Masukan sifat.." required> -->
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
                                    <input type="text" name="perintah" value="{{ $perintah; }}" class="form-control" placeholder="Masukan perintah.." required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="isi">Isi</label>
                                    <input type="text" name="isi" value="{{ $isi; }}" class="form-control" placeholder="Masukan isi.." required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="letter_id">Pilih Surat</label>
                                    <select name="incoming_letters_id" class="form-select">
                                        @foreach ($incoming_letters as $incoming_letter)
                                            <option value="{{ $incoming_letter->id }}" {{ ( $incoming_letter->id == $letter_id) ? 'selected' : '' }}>{{ $incoming_letter->letter_subject }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="letter_id" value="{{ $letter_id; }}" class="form-control" placeholder="Masukan isi.." required> --}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Ubah</button>
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
          { data: 'letters_no', name: 'incoming_letters.letter_no' },
          { data: 'sifat', name: 'sifat' },
          { data: 'perintah', name: 'perintah' },
          { data: 'isi', name: 'isi' },
          { data: 'incoming_letters', name: 'incoming_letters.letter_subject' },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searcable: false,
            width: '15%'
          },
        ]
    });
  </script>
@endpush


