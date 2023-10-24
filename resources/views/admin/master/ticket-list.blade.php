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
                                    <th width="20%">No.Tiket</th>
                                    <th width="10%">Tipe Tiket</th>
                                    <th width="10%">User</th>
                                    <th>Company</th>
                                    <th width="10%">Unit Kerja</th>
                                    <th>Unit Layanan</th>
                                    <th width="10%">Kategori Layanan</th>
                                    <th>SLA Maksimal</th>
                                    <th>Realisasi SLA</th>
                                    <th width="10%">Grup Teknisi</th>
                                    <th>Teknisi</th>
                                    <th width="10%">Keterangan</th>
                                    <th width="10%">Nomor Solusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="middle" valign="middle">
                                    <td>INC-PIH-TI-00001</td>
                                    <td>Insiden</td>
                                    <td>Nama User 1</td>
                                    <td>PI</td>
                                    <td>SDM</td>
                                    <td>TI</td>
                                    <td>Internet</td>
                                    <td>16 Jam</td>
                                    <td>9 Jam</td>
                                    <td>Infrastruktur</td>
                                    <td>Teknisi 1</td>
                                    <td>Keterangan Solusi 1</td>
                                    <td>solusi internet #1</td>
                                </tr>
                                <tr align="middle" valign="middle">
                                    <td>PRB-LIT-24102023-00001</td>
                                    <td>Problem</td>
                                    <td>Nama User 2</td>
                                    <td>PIM</td>
                                    <td>Keuangan</td>
                                    <td>TI</td>
                                    <td>Aplikasi ERP SAP</td>
                                    <td>24 Jam</td>
                                    <td>15 Jam</td>
                                    <td>Operasional TI</td>
                                    <td>Teknisi 2</td>
                                    <td>Keterangan Solusi 2</td>
                                    <td>-</td>
                                </tr>
                                <tr align="middle" valign="middle">
                                    <td>REQ-PKT-TI-00013</td>
                                    <td>Request</td>
                                    <td>Nama User 3</td>
                                    <td>PKT</td>
                                    <td>SPI</td>
                                    <td>TI</td>
                                    <td>Komputer/Laptop</td>
                                    <td>8 Jam</td>
                                    <td>7 Jam</td>
                                    <td>Infrastruktur</td>
                                    <td>Teknisi 3</td>
                                    <td>Keterangan Solusi 3</td>
                                    <td>solusi komputer #2</td>
                                </tr>
                                <tr align="middle" valign="middle">
                                    <td>REQ-PIH-TI-00059</td>
                                    <td>Request</td>
                                    <td>Nama User 4</td>
                                    <td>PI</td>
                                    <td>Umum</td>
                                    <td>Keuangan</td>
                                    <td>Zoom</td>
                                    <td>8 Jam</td>
                                    <td>3 Jam</td>
                                    <td>Infrastruktur</td>
                                    <td>Teknisi 4</td>
                                    <td>Keterangan Solusi 4</td>
                                    <td>solusi zoom #1</td>
                                </tr>
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
        $(document).ready(function() {

            var table1 = $('#listTicket').DataTable({
                lengthChange: true,
                scrollX: true,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
