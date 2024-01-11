@extends('layouts.master')
@section('title')
    Master Data - Daftar Tiket Helpdesk
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <style>
        /* Disable wrapping in all cells */
        table.dataTable td {
            white-space: nowrap;
        }

        .dataTables_length label {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .dataTables_length select {
            width: auto;
            margin-left: 0.5em;
            margin-right: 0.5em;
            /* Adjust as necessary */
            display: inline-block;
        }

        .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            /* Aligns pagination to the right */
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Admin Page
        @endslot
        @slot('title')
            Daftar Tiket Helpdesk
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-12 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">

                    <div class="row">
                        <table id="listTicket" class="table table-bordered"style="margin-bottom: 0px">
                            <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                <tr align="middle" valign="middle">
                                    <th class="text-center" rowspan="2">No.Tiket</th>
                                    <th class="text-center" rowspan="2">Tipe Tiket</th>
                                    <th class="text-center" colspan="3">Info Creator Tiket</th>
                                    <th class="text-center" rowspan="2">Kategori Tiket</th>
                                    <th class="text-center" rowspan="2">Judul Tiket</th>
                                    <th class="text-center" colspan="3">SLA Response</th>
                                    <th class="text-center" colspan="3">SLA Resolve</th>
                                    <th class="text-center" rowspan="2">Grup Teknisi</th>
                                    <th class="text-center" rowspan="2">Teknisi</th>
                                    <th class="text-center" rowspan="2">Keterangan</th>
                                    <th class="text-center" rowspan="2">Nomor Solusi</th>
                                    <th class="text-center" rowspan="2">Action</th>
                                </tr>
                                <tr align="middle" valign="middle">
                                    <th class="text-center">User</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Unit Kerja</th>
                                    <th class="text-center">Durasi Maksimal</th>
                                    <th class="text-center">Realisasi</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Durasi Maksimal</th>
                                    <th class="text-center">Realisasi</th>
                                    <th class="text-center">Status</th>
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
        var nik_user = {!! json_encode($user) !!};
    </script>
    <script>
        $(document).ready(function() {

            var table1 = $('#listTicket').DataTable({
                "ajax": {
                    "url": "/api/sla-list/",
                    "type": "GET",
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                order: [
                    [0, 'asc']
                ],

                columns: [{
                        data: "nomor_tiket",
                        className: "no-wrap"
                    },
                    {
                        className: 'text-center no-wrap',
                        data: "tipe_tiket"
                    },
                    {
                        data: "created_by"
                    },
                    {
                        data: "company_name"
                    },
                    {
                        data: "sap_user_detail.komp_title",
                    },
                    {
                        className: 'text-start',
                        data: "kategori_tiket"
                    },
                    {
                        data: "judul_tiket"
                    },
                    {
                        data: "sla_response.sla_hours_target",
                        className: 'text-center',
                    },
                    {
                        data: "sla_response.business_elapsed_time",
                        className: 'text-center',
                        defaultContent: " BELUM DIRESPON "
                    },
                    {
                        data: "sla_response",
                        className: 'text-center',
                        render: function(data, type, row) {
                            // Check if sla_response data exists and percentage is not null
                            if (data && data.business_time_percentage !== undefined && data
                                .business_time_percentage !== null) {
                                // Extract the percentage
                                var percentage = data.business_time_percentage;

                                // Determine the text and background color based on the percentage
                                var text = (percentage <= 100.00) ? "MET" : "MISS";
                                var backgroundColor = (percentage <= 100.00) ? "green" : "red";

                                return `<span style="background-color: ${backgroundColor}; color: white;">${text}</span>`;
                            }

                            // Default text if no data or percentage is null
                            return " - ";
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData && cellData.business_time_percentage !== undefined &&
                                cellData.business_time_percentage !== null) {
                                var percentage = cellData.business_time_percentage;
                                var backgroundColor = (percentage <= 100.00) ? "green" : "red";
                                $(td).css('background-color', backgroundColor).css('color',
                                    'white');
                            }
                        }
                    },
                    {
                        data: "sla_resolve.sla_hours_target",
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return type === 'display' && data == null ? " - " : data + ' Jam';
                        }
                    },
                    {
                        data: "sla_resolve.business_elapsed_time",
                        className: 'text-center',
                        defaultContent: " - "
                    },
                    {
                        data: "sla_resolve",
                        className: 'text-center',
                        render: function(data, type, row) {
                            // Check if sla data exists and percentage is not null
                            if (data && data.business_time_percentage !== undefined && data
                                .business_time_percentage !== null) {
                                // Extract the percentage
                                var percentage = data.business_time_percentage;

                                // Determine the text and background color based on the percentage
                                var text = (percentage <= 100.00) ? "MET" : "MISS";
                                var backgroundColor = (percentage <= 100.00) ? "green" : "red";

                                return `<span style="background-color: ${backgroundColor}; color: white;">${text}</span>`;
                            }

                            // Default text if no data or percentage is null
                            return " - ";
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData && cellData.business_time_percentage !== undefined &&
                                cellData.business_time_percentage !== null) {
                                var percentage = cellData.business_time_percentage;
                                var backgroundColor = (percentage <= 100.00) ? "green" : "red";
                                $(td).css('background-color', backgroundColor).css('color',
                                    'white');
                            }
                        }
                    },

                    {
                        data: "assigned_group",
                        className: 'text-center',
                        defaultContent: " - "
                    },
                    {
                        data: "assigned_technical",
                        className: 'text-center',
                        defaultContent: " - "
                    },
                    {
                        data: "detail_solusi",
                        className: 'text-center',
                        defaultContent: " - "
                    },
                    {
                        data: "id_solusi",
                        className: 'text-center',
                        defaultContent: " - ",
                        render: function(data, type, row, meta) {
                            return type === 'display' && data == 9999 ? "Solusi Baru" : data;
                        }
                    },

                    {
                        data: null,
                        orderable: false,
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
                                                <a class="dropdown-item" href="/ticket/detail/${row.id}">
                                                    Detail Tiket
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    }
                ],
                lengthChange: true,
                // scrollCollapse: true,
                scrollX: true,
                autoWidth: false,
                // ordering: true,
                // dom: 'Bfrtilp',
                // dom: 'fBrt<"bottom"lp>',
                dom: "<'row'<'col-sm-12 col-md-4'B><'col-sm-12 col-md-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" + // Table
                    "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 text-center'i><'col-sm-12 col-md-4'p>>", // Length, Info, Pagination
                lengthMenu: [5, 10, 15, 20, 25, 50, 100],
                buttons: ['excelHtml5', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }],
            });

            table1.buttons().container().appendTo('#listTicket_wrapper .col-md-3:eq(0)');
        });
    </script>
@endsection
