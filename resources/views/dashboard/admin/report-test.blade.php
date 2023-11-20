@extends('layouts.master')
@section('title')
    Reporting
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Admin page
        @endslot
        @slot('title')
            Reporting
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3">
                        <h3>
                            Pencapaian Tingkat Penyelesaian Layanan TI
                        </h3>
                    </div>
                    <table id="reportFinishingBulanan" class="table table-bordered w-100">
                        <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                            <tr align="middle" valign="middle">
                                <th rowspan="2">
                                    Periode</th>
                                <th colspan="4" class="border border-1">Jumlah Ticket By Status</th>
                                <th rowspan="2">Total Ticket</th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Closed</th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Outstanding
                                </th>
                            </tr>
                            <tr align="middle" valign="middle">
                                <th>Pending<br>Approval</th>
                                <th>On-Hold</th>
                                <th>In<br>Progress</th>
                                <th>Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="middle" valign="middle" class="fs-5">
                                <td>s.d. <?php setlocale(LC_ALL, 'IND');
                                echo \Carbon\Carbon::now()->formatLocalized('%d %B'); ?> </td>
                                <td>1</td>
                                <td>19</td>
                                <td>11</td>
                                <td>2937</td>
                                <td>2968</td>
                                <td>2937</td>
                                <td>31</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3">
                        <h3>
                            Penyelesaian Insiden dan Dukungan Operasional Sesuai SLA
                        </h3>
                    </div>
                    <table id="reportSLABulanan" class="table table-bordered w-100 mb-3">
                        <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                            <tr align="middle" valign="middle">
                                <th rowspan="2">
                                    Periode</th>
                                <th colspan="4" class="border border-1">Jumlah Ticket By Status</th>
                                <th rowspan="2">Total Ticket</th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Achieved
                                </th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Violated
                                </th>
                            </tr>
                            <tr align="middle" valign="middle">
                                <th>Pending<br>Approval</th>
                                <th>On-Hold</th>
                                <th>In<br>Progress</th>
                                <th>Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="middle" valign="middle" class="fs-5">
                                <td>s.d. <?php setlocale(LC_ALL, 'IND');
                                echo \Carbon\Carbon::now()->formatLocalized('%d %B'); ?> </td>
                                <td>1</td>
                                <td>19</td>
                                <td>11</td>
                                <td>2937</td>
                                <td>2968</td>
                                <td>2816</td>
                                <td>121</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3 mb-3 col-xl-4 col-md-4">
                        <h4>
                            Chart Insiden dan Dukungan Operasional Sesuai SLA
                        </h4>
                        <div id="chartSLA" data-colors='["#6BDD63","#AEFAA9"]' class="apex-charts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3">
                        <h3>
                            Penyelesaian Insiden dan Dukungan Operasional Sesuai OLA
                        </h3>
                    </div>
                    <table id="reportOLABulanan" class="table table-bordered w-100">
                        <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
                            <tr align="middle" valign="middle">
                                <th rowspan="2">
                                    Periode</th>
                                <th colspan="4" class="border border-1">Jumlah Ticket By Status</th>
                                <th rowspan="2">Total Ticket</th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Achieved
                                </th>
                                <th rowspan="2" class="text-dark" style="background-color: rgb(89, 194, 235)">Violated
                                </th>
                            </tr>
                            <tr align="middle" valign="middle">
                                <th>Pending<br>Approval</th>
                                <th>On-Hold</th>
                                <th>In<br>Progress</th>
                                <th>Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="middle" valign="middle" class="fs-5">
                                <td>s.d. <?php setlocale(LC_ALL, 'IND');
                                echo \Carbon\Carbon::now()->formatLocalized('%d %B'); ?> </td>
                                <td>1</td>
                                <td>20</td>
                                <td>11</td>
                                <td>3567</td>
                                <td>3599</td>
                                <td>3430</td>
                                <td>137</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="mt-3 mb-3 ms-auto col-xl-4 col-md-4">
                            <h4>
                                Chart OLA Response
                            </h4>
                            <div id="chartOLA1" data-colors='["#F79532","#FFE482"]' class="apex-charts">
                            </div>
                        </div>

                        <div class="mt-3 mb-3 me-auto col-xl-4 col-md-4">
                            <h4>
                                Chart OLA Resolution
                            </h4>
                            <div id="chartOLA2" data-colors='["#298EEF","#C7E2FC"]' class="apex-charts">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- End --}}
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

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

            // Table1
            var table1 = $('#reportFinishingBulanan').DataTable({
                lengthChange: false,
                ordering: false,
                paging: false,
                searching: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container()
                .appendTo('#reportFinishingBulanan_wrapper .col-md-6:eq(0)');

            // Table 2
            var table2 = $('#reportSLABulanan').DataTable({
                lengthChange: false,
                ordering: false,
                paging: false,
                searching: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table2.buttons().container()
                .appendTo('#reportSLABulanan_wrapper .col-md-6:eq(0)');

            // Table2 Chart
            var barchartColors = getChartColorsArray("#chartSLA");
            var options = {
                series: [2816, 121],
                labels: ['Achieved', 'Violated'],
                chart: {
                    type: 'donut',
                    height: 300,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: 0,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                            customIcons: []
                        },
                        export: {
                            csv: {
                                filename: undefined,
                                columnDelimiter: ',',
                                headerCategory: 'category',
                                headerValue: 'value',
                                dateFormatter(timestamp) {
                                    return new Date(timestamp).toDateString()
                                }
                            },
                            svg: {
                                filename: undefined,
                            },
                            png: {
                                filename: undefined,
                            }
                        },
                        autoSelected: 'zoom'
                    },
                },
                colors: barchartColors,
                legend: {
                    show: true,
                    position: 'bottom',

                },
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartSLA"), options);
            chart.render();

            // Table 3
            var table3 = $('#reportOLABulanan').DataTable({
                lengthChange: false,
                ordering: false,
                paging: false,
                searching: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table3.buttons().container()
                .appendTo('#reportOLABulanan_wrapper .col-md-6:eq(0)');

            // Table3 Chart1
            var barchartColors = getChartColorsArray("#chartOLA1");
            var options = {
                series: [93.58, 6.42],
                labels: ['Achieved', 'Violated'],
                chart: {
                    type: 'donut',
                    height: 300,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: 0,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                            customIcons: []
                        },
                        export: {
                            csv: {
                                filename: undefined,
                                columnDelimiter: ',',
                                headerCategory: 'category',
                                headerValue: 'value',
                                dateFormatter(timestamp) {
                                    return new Date(timestamp).toDateString()
                                }
                            },
                            svg: {
                                filename: undefined,
                            },
                            png: {
                                filename: undefined,
                            }
                        },
                        autoSelected: 'zoom'
                    },
                },
                colors: barchartColors,
                legend: {
                    show: true,
                    position: 'bottom',

                },
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartOLA1"), options);
            chart.render();

            // Table3 Chart2
            var barchartColors = getChartColorsArray("#chartOLA2");
            var options = {
                series: [95.9, 4.1],
                labels: ['Achieved', 'Violated'],
                chart: {
                    type: 'donut',
                    height: 300,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: 0,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                            customIcons: []
                        },
                        export: {
                            csv: {
                                filename: undefined,
                                columnDelimiter: ',',
                                headerCategory: 'category',
                                headerValue: 'value',
                                dateFormatter(timestamp) {
                                    return new Date(timestamp).toDateString()
                                }
                            },
                            svg: {
                                filename: undefined,
                            },
                            png: {
                                filename: undefined,
                            }
                        },
                        autoSelected: 'zoom'
                    },
                },
                colors: barchartColors,
                legend: {
                    show: true,
                    position: 'bottom',

                },
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartOLA2"), options);
            chart.render();



            function getChartColorsArray(chartId) {
                var colors = $(chartId).attr('data-colors');
                var colors = JSON.parse(colors);
                return colors.map(function(value) {
                    var newValue = value.replace(' ', '');

                    if (newValue.indexOf('--') != -1) {
                        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                        if (color) return color;
                    } else {
                        return newValue;
                    }
                });
            } //  MINI CHART

        })
    </script>
@endsection
