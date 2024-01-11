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
                        <table id="listTicket" class="table table-bordered nowrap">
                            <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                <tr align="middle" valign="middle">
                                    <th>No.Tiket</th>
                                    <th>Tipe Tiket</th>
                                    <th>User</th>
                                    <th>Company</th>
                                    <th width="10%">Unit Kerja</th>
                                    <th>Kategori Tiket</th>
                                    <th>Judul Tiket</th>
                                    <th>Durasi Max SLA Response</th>
                                    <th>Realisasi SLA Response</th>
                                    <th>Status Response</th>
                                    <th>Durasi Max SLA Resolve</th>
                                    <th>Realisasi SLA Response</th>
                                    <th>Status Resolve</th>
                                    <th>Grup Teknisi</th>
                                    <th>Teknisi</th>
                                    <th>Keterangan</th>
                                    <th>Nomor Solusi</th>
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
                        data: "sap_user_detail.komp_title", // Assuming 'nama' is the field you want to display
                    },
                    {
                        className: 'text-start',
                        data: "kategori_tiket"
                    },
                    // {
                    //     data: "item_kategori_tiket",
                    //     className: 'text-center',
                    //     render: function(data, type, row, meta) {
                    //         return type === 'display' && data == null ? "-" : data;
                    //     }
                    // },
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
                        defaultContent: " - "
                    },
                    {
                        data: "sla_response",
                        className: 'text-center',
                        defaultContent: "BELUM DIRESPON",
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
                            return "BELUM DIRESPON";
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
                        defaultContent: " - "
                    },
                    {
                        data: "sla_resolve.business_elapsed_time",
                        className: 'text-center',
                        defaultContent: " - "
                    },
                    // {
                    //     data: "sla_resolve.business_elapsed_time",
                    //     defaultContent: "BELUM SOLVED",
                    // },
                    {
                        data: "sla_resolve",
                        className: 'text-center',
                        defaultContent: "BELUM DIRESPON",
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
                            return "BELUM DIRESPON";
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
                        defaultContent: " - "
                    },
                    {
                        data: "assigned_technical",
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
                        defaultContent: " - "
                    },

                    // {
                    //     data: null,
                    //     orderable: false,
                    //     render: function(data, type, row) {
                    //         return `
                //                 <div class="dropdown">
                //                     <div class="flex-shrink-0 text-center">
                //                         <div class="dropdown align-self-start">
                //                             <a class="dropdown-toggle" href="#" role="button"
                //                             data-bs-toggle="dropdown" aria-haspopup="true"
                //                             aria-expanded="false">
                //                                 <i class="bx bx-dots-vertical-rounded font-size-24 text-dark"></i>
                //                             </a>
                //                             <div class="dropdown-menu">
                //                                 <a class="dropdown-item" href="/technical/ticket/detail/${row.id}">
                //                                     Detail
                //                                 </a>
                //                             </div>
                //                         </div>
                //                     </div>
                //                 </div>
                //             `;
                    //     }
                    // }
                ],
                lengthChange: true,
                scrollCollapse: true,
                scrollX: true,
                // ordering: true,
                // dom: 'Bfrtilp',
                dom: 'fBrt<"bottom"lp>',
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
