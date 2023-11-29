@extends('layouts.master')
@section('title')
    Technical - Detail TIket
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        .rating-input {
            display: none;
        }

        .rating-star {
            cursor: pointer;
            font-size: 25px;
            color: grey;
        }

        .rating-input:checked~.rating-star,
        .rating-input:checked~.rating-star~.rating-option .rating-star {
            color: orange;
        }

        .caption {
            display: block;
            margin-top: 5px;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Helpdesk
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
                            <textarea type="text" class="form-control" rows="10" readonly>{{ $tiket->detail_tiket }}</textarea>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <label for="attachment_list">Daftar Lampiran / Attachments</label>
                        <div class="col-auto"></div>
                        <div class="col-11">
                            <ol class="fs-4" id="attachment_list"></ol>
                        </div>
                    </div>

                    <div class="row pb-3 mx-auto text-center">
                        <button type="button" class="btn btn-lg btn-success" style="width: 100%" data-bs-toggle="modal"
                            data-bs-target="#assignTicketModal">
                            Assign Tiket
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="assignTicketModal" tabindex="-1" aria-labelledby="assignTicketModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="assignTicketModalLabel">Assign Tiket</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row mx-auto">

                                        <label for="list_teknisi">Pilihan Teknisi</label>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <select class="form-control dropdownGrup" name="list_teknisi"
                                                    id="list_teknisi">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="assignGroupBtn">Assign</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

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
        let daftarTechnical = null;

        $(document).ready(function() {

            getAttachments();
            getTechnical($id_tiket)

            $('#assignGroupBtn').click(function() {
                $nik = $user_id;
                $id_tiket = $id_tiket;
                $id_teknisi = $('#list_teknisi').val();

                $.ajax({
                    url: "/api/tiket-assign-technical",
                    method: "POST",
                    dataType: "json",
                    data: {
                        nik: $nik,
                        id_tiket: $id_tiket,
                        id_technical: $id_teknisi,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        window.location.href = '/';

                    }
                })
            });

            function getTechnical(id) {
                if (daftarTechnical === null) {
                    $.ajax({
                        url: "/api/technical-list/" + id,
                        method: "GET",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            daftarTechnical = data;

                            populateDropdowns();
                        }
                    })
                } else {
                    // If the list is already fetched, populate the dropdowns
                    populateDropdowns();
                }
            }

            function populateDropdowns() {
                const dropdowns = $('.dropdownGrup');

                dropdowns.each(function() {
                    const dropdown = $(this);
                    daftarTechnical.forEach(listTechnical => {
                        const option = $('<option></option>').attr('value', listTechnical
                            .nik_member).text(
                            listTechnical.nama_member);
                        dropdown.append(option);
                    });
                });
            }


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

                        html += '<li margin-bottom: 10px;">' + fileDisplay +
                            ' <span>' +
                            fileName + '</span></li>';
                    } else if (fileType === 'pdf' || fileType === 'zip') {
                        fileDisplay = '<a href="' + filePath + '" target="_blank"><i class="fas fa-' + (fileType ===
                            'pdf' ? 'file-pdf' : 'file-archive') + '"></i> ' + fileName + '</a>';


                        html += '<li margin-bottom: 10px;">' + fileDisplay +
                            '</li>';
                    }
                }

                $("#attachment_list").html(html);
            }

        });
    </script>
@endsection
