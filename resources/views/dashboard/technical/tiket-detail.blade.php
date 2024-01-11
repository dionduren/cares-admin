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

                    <hr>

                    <div class="row mb-3">
                        <label for="attachment_list">Daftar Lampiran / Attachments</label>
                        <div class="col-auto"></div>
                        <div class="col-11">
                            <ul class="fs-4" id="attachment_list"></ul>
                        </div>
                    </div>

                    <hr>

                    <div class="row pb-3 px-auto justify-content-center">
                        <div class="col-5">
                            <button type="button" class="btn btn-lg btn-danger" style="width: 100%" data-bs-toggle="modal"
                                data-bs-target="#holdTicketModal">
                                Hold Tiket
                            </button>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-5">
                            <button type="button" class="btn btn-lg btn-primary" style="width: 100%" data-bs-toggle="modal"
                                data-bs-target="#solveTicketModal">
                                Solve Tiket
                            </button>
                        </div>
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
                                    {{-- 
                                    <div class="row mb-3">
                                        <label for="detail_tiket">Kondisi Problem pada tiket</label>
                                        <div class="col">
                                            <select class="form-control" name="kondisi_problem" id="kondisi_problem">
                                                <option value="1">Dapat diselesaikan in-house</option>
                                                <option value="2">Perlu eskalasi ke pihak ketiga</option>
                                                <option value="3">Perlu ditunda menunggu keputusan stakeholder</option>
                                                <option value="4">Lainnya</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="row mb-3">
                                        <label for="detail_tiket">Judul solusi baru yang digunakan</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="judul_solusi_problem"
                                                id="judul_solusi">
                                        </div>
                                    </div> --}}

                                    {{-- <div class="row mb-3">
                                        <label for="detail_tiket">Jelaskan solusi baru yang digunakan</label>
                                        <div class="col">
                                            <textarea class="form-control" name="detail_solusi_problem" id="detail_solusi" rows="5"></textarea>
                                        </div>
                                    </div> --}}

                                    <div class="row mb-3">
                                        <label for="detail_tiket">Solusi tiket yang digunakan</label>
                                        <div class="col">
                                            <select class="form-control dropdownGrup" name="solusi_tiket" id="solusi_tiket">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="solution_div_judul">
                                        <label for="detail_tiket">Judul solusi baru yang digunakan</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="judul_solusi"
                                                id="judul_solusi">
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="solution_div_detail">
                                        <label for="detail_tiket">Jelaskan solusi baru yang digunakan</label>
                                        <div class="col">
                                            <textarea class="form-control" name="detail_solusi" id="detail_solusi" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    {{-- <button type="button" id="resolveTicketButton"
                                        class="btn btn-danger text-white">Hold
                                        Ticket</button> --}}
                                    <button type="button" id="resolveTicketButton" class="btn btn-success">Solve
                                        Ticket</button>
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

            getAttachments();

            $('#solveTicketModal').on('show.bs.modal', function(event) {
                $('#solution_div_judul').hide();
                $('#solution_div_detail').hide();

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
                    $('#solution_div_judul').show();
                    $('#solution_div_detail').show();
                    $('#judul_solusi').attr('required', true); // Make required
                    $('#detail_solusi').attr('required', true); // Make required
                } else {
                    $('#solution_div_judul').hide();
                    $('#solution_div_detail').hide();
                    $('#judul_solusi').removeAttr('required'); // Remove required
                    $('#detail_solusi').removeAttr('required'); // Remove required
                }
            });

            $('#resolveTicketButton').click(function() {
                $id_solusi = $('#solusi_tiket').val();

                if ($id_solusi != 9999) {
                    $.ajax({
                        url: "/api/submit-solution",
                        method: "POST",
                        dataType: "json",
                        data: {
                            nik: $user_id,
                            id_tiket: $id_tiket,
                            id_solusi: $id_solusi,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log(data);
                            window.location.href = '/';
                        }
                    })
                } else {
                    $judul_solusi = $('#judul_solusi').val();
                    $detail_solusi = $('#detail_solusi').val();

                    $.ajax({
                        url: "/api/submit-new-solution",
                        method: "POST",
                        dataType: "json",
                        data: {
                            nik: $user_id,
                            id_tiket: $id_tiket,
                            id_solusi: $id_solusi,
                            judul_solusi: $judul_solusi,
                            detail_solusi: $detail_solusi,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log(data);
                            window.location.href = '/';
                        }
                    })
                }

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
            };

            function getAttachments() {
                $.ajax({
                    url: "/api/tiket-attachments/" + $id_tiket,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);

                        // File Path
                        var fileLocations = data.map(function(item) {
                            return item.file_location;
                        });

                        var fileLocationsString = fileLocations.join(',');

                        // File Name Original
                        var fileNames = data.map(function(item) {
                            return item.nama_file_original;
                        });

                        var fileNameString = fileNames.join(',');

                        attachmentList(fileLocationsString, fileNameString);
                    }
                })
            }

            function attachmentList(attachmentsString, fileNameString) {
                var attachments = attachmentsString.split(",");
                var fileNames = fileNameString.split(",");
                var html = "";

                for (var i = 0; i < attachments.length; i++) {
                    var fileType = attachments[i].split('.').pop().toLowerCase();
                    var fileName = fileNames[i];
                    var filePath = '/storage/' + attachments[i]; // Modify as per your actual path
                    var fileDisplay = "";

                    if (fileType === 'jpg' || fileType === 'png' || fileType === 'jpeg') {
                        fileDisplay = '<img src="' + filePath + '" alt="' + fileName +
                            '" style="max-height:200px; display: block;"/>';
                    } else if (fileType === 'pdf' || fileType === 'zip') {
                        fileDisplay = '<a href="' + filePath + '" target="_blank"><i class="fas fa-' + (fileType ===
                            'pdf' ? 'file-pdf' : 'file-archive') + '"></i> ' + fileName + '</a>';
                    }

                    html += '<li style="list-style-type: none; margin-bottom: 10px;">' + fileDisplay + ' <span>' +
                        fileName + '</span></li>';
                }

                $("#attachment_list").html(html);
            }

        });
    </script>
@endsection
