@extends('layouts.master')
@section('title')
    Helpdesk - Ongoing Tiket
@endsection
@section('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/date-1.5.1/fh-3.4.0/r-2.5.0/sb-1.6.0/sp-2.2.0/datatables.min.css"
        rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Helpdesk Page
        @endslot
        @slot('title')
            Daftar Tiket Ongoing
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-12 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">

                    <div class="row">
                        <div class="table-responsive mb-0 border-0" data-pattern="priority-columns">
                            <table id="listTicket" class="table table-bordered" style="width: 100%">
                                <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                    <tr align="middle" valign="middle">
                                        <th>No.Tiket</th>
                                        <th>Tipe Tiket</th>
                                        <th class="text-center">User</th>
                                        <th>GOLONGAN / JABATAN</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Sub Kategori</th>
                                        <th>Item Kategori</th>
                                        <th>Judul</th>
                                        <th>Status</th>
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
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/date-1.5.1/fh-3.4.0/r-2.5.0/sb-1.6.0/sp-2.2.0/datatables.min.js">
    </script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        var nik_user = {!! json_encode($user) !!};
    </script>
    <script>
        $(document).ready(function() {

            $('.table-responsive').responsiveTable({});

            $('#listTicket thead tr').clone(true).addClass('filters').appendTo('#listTicket thead');

            var table1 = $('#listTicket').DataTable({
                "ajax": {
                    "url": "/api/created-tiket-list/" + nik_user,
                    "type": "GET",
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: "nomor_tiket"
                    },
                    {
                        className: 'text-center',
                        data: "tipe_tiket"
                    },
                    {
                        data: "created_by",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                      <div class:text-center>
                          <p>--TO BE DETERMINED--</p>
                      </div>
                    `;
                        }
                    },
                    {
                        className: 'text-start',
                        data: "kategori_tiket"
                    },
                    {
                        className: 'text-start',
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
                        data: "status_tiket"
                    }
                ],
                lengthChange: true,
                orderCellsTop: true,
                fixedHeader: true,
                responsive: true,
                buttons: ['copy', 'excel', 'pdf', 'colvis'],
                // dom: 'Bfrtip',
                dom: 'Brti<"bottom"lp>',
                scrollCollapse: true,
                scrollX: true,
                initComplete: function() {
                    var api = this.api();
                    // For each column
                    api.columns().eq(0).each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
                        // On every keypress in this input
                        $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                            .off('keyup change')
                            .on('keyup change', function(e) {
                                e.stopPropagation();
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})';
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search((this.value != "") ? regexr.replace('{search}',
                                            '(((' + this.value + ')))') : "", this.value !=
                                        "", this.value == "")
                                    .draw();
                                $(this).focus()[0].setSelectionRange(cursorPosition,
                                    cursorPosition);
                            });
                    });
                }
            });


            table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
