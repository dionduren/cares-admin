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
                        <input type="text" class="form-control" name="id_tiket" id="id_tiket" readonly hidden>

                        <label for="jenis_tiket">Jenis Tiket</label>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control" name="jenis_tiket" id="jenis_tiket">
                                    <option value="0">Pilih Tipe Tiket</option>
                                    <option value="INCIDENT">INCIDENT</option>
                                    <option value="REQUEST">REQUEST</option>
                                    <option value="PROBLEM">PROBLEM</option>
                                </select>
                            </div>
                        </div>

                        <label for="tingkat_urgensi">Tingkat Urgensi</label>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control" name="tingkat_urgensi" id="tingkat_urgensi">
                                    <option value="0">Pilih Tingkat Urgensi</option>
                                    <option value="1">HIGH</option>
                                    <option value="2">MEDIUM</option>
                                    <option value="3">LOW</option>
                                </select>
                            </div>
                        </div>

                        <label for="tingkat_dampak">Tingkat Dampak</label>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control" name="tingkat_dampak" id="tingkat_dampak">
                                    <option value="0">Pilih Tingkat Dampak</option>
                                    <option value="1">HIGH</option>
                                    <option value="2">MEDIUM</option>
                                    <option value="3">LOW</option>
                                </select>
                            </div>
                        </div>

                        <label for="tingkat_prioritas">Tingkat Prioritas</label>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="tingkat_prioritas" id="tingkat_prioritas"
                                    readonly>
                            </div>
                        </div>

                        <label for="tipe_sla">Durasi SLA</label>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="tipe_sla" id="tipe_sla" readonly>
                            </div>
                        </div>


                        <label for="grup_teknisi">Pilihan Grup Teknisi</label>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control dropdownGrup" name="grup_teknisi" id="grup_teknisi">
                                </select>
                            </div>
                        </div>

                        {{-- <label for="leader_teknisi">Leader Grup Teknisi</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="leader_teknisi" id="leader_teknisi"
                                    readonly>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="assignGroupBtn">Assign</button>
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
        let daftarGrup = null;
        let detailTiket = null;

        $(document).ready(function() {
            getGrup();

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

                getTicketInfo(idTiket);
            });

            $('#tingkat_urgensi, #tingkat_dampak').change(calculatePriority);
            $('#tingkat_urgensi, #tingkat_dampak').change(getSLAtype);

            // $('#grup_teknisi').change(function() {
            //     // $leader = $this.data('data-leader');
            //     $leader = $(this).find(':selected').data('leader')
            //     if ($leader == null) {
            //         $('#leader_teknisi').val("Belum ada Leader");
            //     } else {
            //         $('#leader_teknisi').val($leader);
            //     }
            // });

            $('#assignGroupBtn').click(function() {
                $id_tiket = $('#id_tiket').val();
                $id_group = $('#grup_teknisi').find(':selected').val();
                $assigned_group = $('#grup_teknisi').find(':selected').text();

                $.ajax({
                    url: "/api/tiket-assign-group",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_tiket: $id_tiket,
                        id_group: $id_group,
                        assigned_group: $assigned_group,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // $('#tambah_kategori').empty();
                        // $('#createModal').modal('toggle');
                        // table1.ajax.reload();
                        console.log('ajax call success');
                        console.log(data);
                    }
                })
            });

            function getGrup() {
                if (daftarGrup === null) {
                    // If the list is not already fetched, make an API call
                    $.ajax({
                        url: "/api/technical-group-list",
                        method: "GET",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            daftarGrup = data;

                            populateDropdowns();
                        }
                    })
                } else {
                    // If the list is already fetched, populate the dropdowns
                    populateDropdowns();
                }
            }

            function getTicketInfo(id_tiket) {
                $.ajax({
                    url: "/api/helpdesk-tiket-detail/" + id_tiket,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#jenis_tiket').val(data.tipe_tiket);
                        $('#tingkat_urgensi').val(data.level_urgensi);
                        $('#tingkat_dampak').val(data.level_dampak);

                        calculatePriority();
                        getSLAtype();
                        // detailTiket = data;
                        // console.log('daftar data tiket = ');
                        // console.log(data);
                        // console.log(detailTiket);
                    }
                })
            }

            function populateDropdowns() {
                const dropdowns = $('.dropdownGrup');

                dropdowns.each(function() {
                    const dropdown = $(this);
                    daftarGrup.forEach(grupTeknis => {
                        const option = $('<option></option>').attr('value', grupTeknis.id).text(
                            grupTeknis.nama_group);
                        // const option = $('<option></option>').attr('value', grupTeknis.id).text(
                        //     grupTeknis.nama_group).attr('data-leader', grupTeknis
                        //     .nama_team_lead);
                        dropdown.append(option);
                    });
                });
            }

            function calculatePriority() {
                var urgency = $('#tingkat_urgensi option:selected').text();
                var impact = $('#tingkat_dampak option:selected').text();

                var priorityMatrix = {
                    'HIGH': {
                        'HIGH': 'Critical',
                        'MEDIUM': 'High',
                        'LOW': 'Medium'
                    },
                    'MEDIUM': {
                        'HIGH': 'High',
                        'MEDIUM': 'Medium',
                        'LOW': 'Low'
                    },
                    'LOW': {
                        'HIGH': 'Medium',
                        'MEDIUM': 'Low',
                        'LOW': 'Low'
                    }
                };

                // Determine the priority text based on the matrix
                var priorityText = priorityMatrix[urgency][impact];

                // Set the value in the readonly input field
                $('#tingkat_prioritas').val(priorityText);
            }

            function getSLAtype() {
                var tipe_tiket = $('#jenis_tiket').val();
                var tipe_sla = $('#tingkat_prioritas').val();

                $.ajax({
                    url: "/api/helpdesk-get-sla",
                    method: "GET",
                    dataType: "json",
                    data: {
                        tipe_tiket: tipe_tiket,
                        tipe_sla: tipe_sla,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#tipe_sla').val(data.nama_sla);
                    }
                })
            }
        });
    </script>
@endsection
