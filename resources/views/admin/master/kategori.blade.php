@extends('layouts.master')
@section('title')
    Buat Tiket Baru
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tiket
        @endslot
        @slot('title')
            Buat Tiket Baru
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-11 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <form id="create-tiket-form">

                        <div class="row mb-3">
                            <label for="kategori_tiket">Kategori Tiket</label>
                            <div class="col">
                                <select class="form-control" name="kategori_tiket" id="kategori_tiket">
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkategori_tiket">Subkategori Tiket</label>
                            <div class="col">
                                <select class="form-control" name="subkategori_tiket" id="subkategori_tiket">
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div id="item-category-container">
                                <!-- Item category dropdown will be inserted here -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
