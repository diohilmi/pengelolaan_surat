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
                                Disposisi User
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
                            List Disposisi User
                            {{-- <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                Tambah Data
                            </a> --}}
                             
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
                                        <th>Tgl. Surat</th>
                                        <th>Tgl. Diterima</th>
                                        <th>Dari</th>
                                        <th>Perihal</th>
                                        <th>Status</th>
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

{{-- Modal Update --}}
    @foreach ($disposisi_users as $item)
        @php
            $id = $item->id;
            $id_disposisi = $item->disposisi_id;
            $id_user = $item->users_id;
            $id_position = $item->user->positions_id;
            $status = $item->status;
        @endphp
        <div class="modal fade" id="updateModal{{ $id }}" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow:hidden;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModal{{ $id }}">Konfrimasi Disposisi User</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('disposisi-user.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="disposisi_id">Disposisi Surat</label>
                                    <input type="hidden"  name="disposisi_id" value="{{ $id_disposisi }}">
                                    <select name="disposisi_id" disabled class="form-select">
                                        @foreach ($disposisi as $data)
                                            <option value="{{ $data->id }}" {{ ( $id_disposisi == $data->id) ? 'selected' : '' }}>{{ $data->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (auth()->user()->positions_id != "3" && auth()->user()->positions_id != "2")
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="users_id">User</label>
                                    <select name="users_id" class="form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ ( $user->id == $id) ? 'selected' : '' }}>{{ $user->name. ' - ' . $user->position->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="users_id" value="{{ $id_user }}">
                            @endif
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Pilih..</option>
                                            <option value="Diajukan" {{ ($status == 'Diajukan') ? 'selected':''; }}>Diajukan</option>
                                            <option value="Diterima" {{ ($status == 'Diterima') ? 'selected':''; }}>Diterima</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Konfirmasi</button>
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
          { data: 'sifat', name: 'sifat' },
          { data: 'letter_date', name: 'letter_date' },
          { data: 'date_received', name: 'date_received' },
          { data: 'sender', name: 'sender' },
          { data: 'regarding', name: 'regarding' },
          { data: 'status', name: 'status' },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searcable: false,
            width: '11%'
          },
        ]
    });
  </script>
@endpush


