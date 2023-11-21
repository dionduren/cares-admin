@extends('layouts.master')
@section('title')
    Technical - Detail TIket
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Technical
        @endslot
        @slot('title')
            Detail Tiket
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-11 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row mb-3">
                        <label>Nomor Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $tiket->nomor_tiket }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label>Kategori Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $tiket->kategori_tiket }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label>Sub Kategori Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $tiket->subkategori_tiket }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label>Item Kategori Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control"
                                value="{{ $tiket->item_kategori_tiket == null ? '-' : $tiket->item_kategori_tiket }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label>Tanggal Pembuatan Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control"
                                value="{{ $tiket->created_at->format('d M Y - H:i:s') }} WIB" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="judul">Judul Tiket</label>
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $tiket->judul_tiket }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="detail_tiket">Detail Tiket</label>
                        <div class="col">
                            <textarea type="text" class="form-control" rows="5" readonly>{{ $tiket->detail_tiket }}</textarea>
                        </div>
                    </div>

                    <div class="row pb-3 mx-auto text-center">
                        <button type="button" class="btn btn-lg btn-success" style="width: 100%" data-bs-toggle="modal"
                            data-bs-target="#solveTicketModal">
                            Solve Tikcet
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="solveTicketModal" tabindex="-1" aria-labelledby="solveTicketModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="solveTicketModalLabel">Solve Tiket</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row mb-3">
                                        <label for="detail_tiket">Solusi tiket yang digunakan</label>
                                        <div class="col">
                                            <select class="form-control dropdownGrup" name="solusi_tiket" id="solusi_tiket">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="solution_div">
                                        <label for="detail_tiket">Jelaskan solusi baru yang digunakan</label>
                                        <div class="col">
                                            <textarea class="form-control" name="detail_solusi" id="detail_solusi" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="resolveTicketButton" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $user_id = "{{ $user }}";
        $id_tiket = {{ $tiket->id }};
        let daftarSolusi = null;

        $(document).ready(function() {

            $('#solveTicketModal').on('show.bs.modal', function(event) {
                $('#solution_div').hide();

                $('#solusi_tiket').find('option').remove().end().append(
                    '<option value="0">Pilihan Solusi dari Knowledge Management</option>');

                $.ajax({
                    url: "/api/solution-list/" + $id_tiket,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        daftarSolusi = data;

                        populateDropdowns();
                    }
                })

            });

            $("#solusi_tiket").change(function() {
                if ($(this).val() == 9999) {
                    $('#solution_div').show();
                } else {
                    $('#solution_div').hide();
                }
            });

            $('#resolveTicketButton').click(function() {
                console.log('submit');
            });

            function populateDropdowns() {
                const dropdowns = $('.dropdownGrup');

                dropdowns.each(function() {
                    const dropdown = $(this);
                    daftarSolusi.forEach(solusiTiket => {
                        const option = $('<option></option>').attr('value', solusiTiket
                            .id).text(
                            solusiTiket.judul_solusi);
                        dropdown.append(option);
                    });
                    const option = $('<option></option>').attr('value', 9999).text(
                        "Solusi Baru / Tidak ada di Knowledge Management");
                    dropdown.append(option);
                });
            }
        });
    </script>
@endsection
