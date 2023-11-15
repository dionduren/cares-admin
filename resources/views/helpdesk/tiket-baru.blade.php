@extends('layouts.master')
@section('title')
    Helpdesk - Daftar Tiket
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
                                    <th width="10%">Tipe Tiket</th>
                                    <th width="10%">User</th>
                                    <th width="10%">GOLONGAN / JABATAN</th>
                                    <th class="text-center" width="13%">Kategori</th>
                                    <th class="text-center" width="13%">Sub Kategori</th>
                                    <th width="13%">Item Kategori</th>
                                    <th>Judul</th>
                                    <th width="5%">&nbsp;</th>
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
                    <h5 class="modal-title" id="assignModalLabel">Assign Tiket - (<span id="nomor_tiket"></span>)</h5>
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
        var nik_user = {!! json_encode($user) !!};
    </script>
    <script src="{{ URL::asset('/assets/js/module/helpdesk/tiket-baru.js') }}"></script>
@endsection
