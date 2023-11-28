@extends('layouts.master')
@section('title')
    Dashboard
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
            Dashboard
        @endslot
        @slot('title')
            Main Page
        @endslot
    @endcomponent

    <div class="row">

        <div class="row mb-3">
            <div class="col-xl-10 col-md-10 mx-auto">
                <a href="/create-ticket" class="btn btn-lg btn-warning fs-4 fw-bold text-dark" style="width: 100%">Buat
                    Tiket
                    Baru</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-10 col-md-10 mx-auto">
                <div class="card card-h-100">
                    <div class="card-body">

                        @if (Auth::user()->role_id == 2)
                            <h3 class="text-muted mb-4 lh-1 d-block text-truncate">
                            Helpdesk - Waiting List Tiket
                            </h3>
                        @else
                            <h3 class="text-muted mb-4 lh-1 d-block text-truncate">
                                Daftar Tiket Aktif Anda
                            </h3>
                        @endif

                        @if (Auth::user()->role_id == 2)
                            @include('dashboard.helpdesk.home')
                        @else
                            @include('dashboard.user.home')
                        @endif

                        {{-- Table end --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- End --}}
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
    @endsection
