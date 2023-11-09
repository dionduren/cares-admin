@extends('layouts.master')
@section('title')
    Master Data - Daftar Tiket Helpdesk
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Helpdesk Page
        @endslot
        @slot('title')
            Daftar Tiket Baru
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-12 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">

                    <div class="row">
                        <table id="listTicket" class="table table-bordered nowrap">
                            <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                <tr align="middle" valign="middle">
                                    <th width="13%">No.Tiket</th>
                                    <th width="13%">Tipe Tiket</th>
                                    <th>User</th>
                                    <th width="13%">Kategori</th>
                                    <th width="13%">Sub Kategori</th>
                                    <th width="13%">Item Kategori</th>
                                    <th>Judul</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Assign Modal --}}
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignModalLabel">Assign Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mx-auto">
                        <label for="leader_teknisi">ID TIKET</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="id_tiket" id="id_tiket" readonly>
                            </div>
                        </div>

                        <label for="grup_teknisi">Pilihan Grup Teknisi</label>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control dropdownKategori" name="grup_teknisi" id="grup_teknisi">
                                </select>
                            </div>
                        </div>

                        <label for="leader_teknisi">Leader Grup Teknisi</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="leader_teknisi" id="leader_teknisi"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="hapusKategoriBtn">Assign</button>
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

            var table1 = $('#listTicket').DataTable({
                "ajax": {
                    "url": "/api/helpdesk-tiket-submitted",
                    "type": "GET",
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                columns: [{
                        data: "nomor_tiket"
                    },
                    {
                        className: 'text-center',
                        data: "tipe_tiket"
                    },
                    {
                        data: "created_by"
                    },
                    {
                        className: 'text-center',
                        data: "kategori_tiket"
                    },
                    {
                        className: 'text-center',
                        data: "subkategori_tiket"
                    },
                    {
                        data: "item_kategori_tiket",
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return type === 'display' && data == null ? "-" : data;
                        }
                    },
                    {
                        data: "judul_tiket"
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
                                        <button type="button" id="assignModalBtn" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#assignModal"
                                            data-id="${row.id}">
                                            Assign
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                        }
                    }
                ],
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');


            $('#assignModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var idTiket = button.data('id');

                $('#id_tiket').attr('value', idTiket);
            });
        });
    </script>
@endsection
