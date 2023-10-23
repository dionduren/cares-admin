@extends('layouts.master')
@section('title')
    Super Admin - Activity History
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Super Admin Page
        @endslot
        @slot('title')
            Activity History
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-11 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <table id="activityHistory" class="table table-bordered w-100">
                            <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                                <tr align="middle" valign="middle">
                                    <th width="5%">No.</th>
                                    <th>Activity</th>
                                    <th>Object</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
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

            var table1 = $('#activityHistory').DataTable({
                "ajax": {
                    "url": "/api/activity-history",
                    "type": "GET",
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Display the row number
                        }
                    },
                    {
                        data: "activity"
                    },
                    {
                        data: "object"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "created_by"
                    },
                    {
                        data: 'created_at',
                        type: 'num',
                        render: function(data, type, row) {
                            if (type === 'display' && data) {
                                const date = new Date(data);
                                const formattedDate = date.toLocaleString('id-ID', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    hour12: false
                                });
                                return formattedDate.replace('pukul', '-') + ' WIB';
                            }
                            return data;
                        }
                    }


                ],
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#activityHistory_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
