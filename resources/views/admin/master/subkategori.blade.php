@extends('layouts.master')
@section('title')
    Master Data - Sub Kategori
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Admin Page
        @endslot
        @slot('title')
            Master Data - Sub Kategori
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-11 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-3 col-md-3">
                            <button type="button" class="btn btn-lg btn-success waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#createModal">
                                Tambah Sub Kategori
                            </button>
                        </div>
                    </div>


                    <div class="row">
                        <table id="listKategori" class="table table-bordered w-100">
                            <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                <tr align="middle" valign="middle">
                                    <th width="5%">No.</th>
                                    <th>Daftar Kategori</th>
                                    <th>Daftar Subkategori</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Create -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="judul">Pilihan Kategori</label>
                        <div class="col">
                            {{-- Masukkan Dropdown kategori --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="judul">Nama Subkategori</label>
                        <div class="col">
                            {{-- GANTI NAME & ID --}}
                            <input type="text" class="form-control" name="tambah_kategori" id="tambah_kategori">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="tambahKategoriBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Ubah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="judul">Pilihan Kategori</label>
                        <div class="col">
                            {{-- Masukkan Dropdown kategori --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="judul">Nama Sub Kategori</label>
                        <div class="col">
                            {{-- GANTI NAME & ID --}}
                            <input type="text" class="form-control" name="id_ubah_kategori" id="id_ubah_kategori" hidden>
                            <input type="text" class="form-control" name="ubah_kategori" id="ubah_kategori">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="ubahKategoriBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus kategori ini?
                    {{-- GANTI NAME & ID --}}
                    <input type="text" class="form-control" name="id_delete_kategori" id="id_delete_kategori" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" id="hapusKategoriBtn">Yakin</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- datatables-->
    <script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}">
    </script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var table1 = $('#listKategori').DataTable({
                "ajax": {
                    "url": "/api/subkategori-list-all",
                    "type": "GET",
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Display the row number
                        }
                    },
                    {
                        data: "nama_kategori"
                    },
                    {
                        data: "nama_subkategori"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                        <div class="dropdown">
                            <div class="flex-shrink-0 text-center">
                                <div class="dropdown align-self-start">
                                    <a class="dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded font-size-24 text-dark"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <button type="button" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="${row.id}"
                                            data-nama="${row.nama_subkategori}">
                                            Ubah
                                        </button>
                                        <button type="button" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-id="${row.id}">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                        }
                    }
                ],
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#listKategori_wrapper .col-md-6:eq(0)');

            // MODAL FUNCTIONS

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_kategori = button.data('id');
                var nama_kategori = button.data('nama');

                $('#id_ubah_kategori').attr('value', id_kategori);
                $('#ubah_kategori').attr('value', nama_kategori);

            });


            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_kategori = button.data('id');

                $('#id_delete_kategori').attr('value', id_kategori);
            });

            // ACTION FUNCTIONS


            $('#tambahKategoriBtn').click(function() {
                $tambahKategori = $('#tambah_kategori').val();

                $.ajax({
                    url: "/submit-sub-kategori",
                    method: "POST",
                    dataType: "json",
                    data: {
                        nama_kategori: $tambahKategori,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#tambah_kategori').empty();
                        $('#createModal').modal('toggle');
                        table1.ajax.reload();
                    }
                })
            });

            $('#ubahKategoriBtn').click(function() {
                $id_kategori = $('#id_ubah_kategori').val();
                $nama_kategori = $('#ubah_kategori').val();

                $.ajax({
                    url: "/edit-sub-kategori",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_kategori: $id_kategori,
                        nama_kategori: $nama_kategori,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#editModal').modal('toggle');
                        table1.ajax.reload();
                    }
                })
            })

            $('#hapusKategoriBtn').click(function() {
                $id_kategori = $('#id_delete_kategori').val();

                $.ajax({
                    url: "/delete-sub-kategori",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_kategori: $id_kategori,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#deleteModal').modal('toggle');
                        table1.ajax.reload();
                    }
                })
            });

        });
    </script>
@endsection
