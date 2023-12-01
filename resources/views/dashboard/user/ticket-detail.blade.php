@extends('layouts.master')
@section('title')
    CARES - Detail TIket
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
            My Ticket
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

                    <div class="row mb-3">
                        <label for="detail_tiket">Solusi yang diberikan - {{ $tiket->judul_solusi }}</label>
                        <div class="col">
                            <textarea type="text" class="form-control" rows="5" readonly>{{ $tiket->detail_solusi }}</textarea>
                        </div>
                    </div>

                    <div class="row pb-3 mx-auto text-center">
                        <button type="button" class="btn btn-lg btn-success" style="width: 100%" data-bs-toggle="modal"
                            data-bs-target="#closeTicketModal">
                            Close Tiket
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="closeTicketModal" tabindex="-1" aria-labelledby="closeTicketModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="closeTicketModalLabel">Close Tiket</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row justify-content-center mb-5">

                                        <div class="row mb-3">
                                            <div class="col text-center rating-option">
                                                <label for="rating_kepuasan" class="fs-5">
                                                    Bagaimana kualitas pelayanan kami?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col text-center rating-option">
                                            <input type="radio" id="1-star" name="rating_kepuasan" value="1"
                                                class="rating-input" />
                                            <label for="1-star" class="rating-star"><i class="far fa-star"></i></label>
                                            <span class="caption">Tidak Puas</span>
                                        </div>
                                        <div class="col text-center rating-option">
                                            <input type="radio" id="2-stars" name="rating_kepuasan" value="2"
                                                class="rating-input" />
                                            <label for="2-stars" class="rating-star"><i
                                                    class="fas fa-star-half-alt"></i></label>
                                            <span class="caption">Cukup Puas</span>
                                        </div>
                                        <div class="col text-center rating-option">
                                            <input type="radio" id="3-stars" name="rating_kepuasan" value="3"
                                                class="rating-input" />
                                            <label for="3-stars" class="rating-star"><i class="fas fa-star"></i></label>
                                            <span class="caption">Sangat Puas</span>
                                        </div>
                                    </div>

                                    <div id="alasan_div">
                                        <label for="catatan_kepuasan" class="fs-5">Apa kendala yang anda hadapi?</label>
                                        <textarea class="form-control" name="catatan_kepuasan" id="catatan_kepuasan" rows="5"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="closeTicketButton" class="btn btn-primary">Submit</button>
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
        let daftarSolusi = null;
        $rating_review = null;

        $(document).ready(function() {
            $('#alasan_div').hide();

            getAttachments();

            $('input[name="rating_kepuasan"]').change(function() {
                var selectedRating = $(this).val();
                $rating_review = selectedRating;
                console.log('Selected Rating:', selectedRating);

                if (selectedRating < 3) {
                    $('#alasan_div').show();
                } else {
                    $('#alasan_div').hide();
                }

            });

            $('#closeTicketButton').click(function() {
                $catatan_kepuasan = $('#catatan_kepuasan').val();

                if ($rating_review == 3) {
                    $.ajax({
                        url: "/api/close-tiket",
                        method: "POST",
                        dataType: "json",
                        data: {
                            nik: $user_id,
                            id_tiket: $id_tiket,
                            rating_kepuasan: $rating_review,
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
                    $.ajax({
                        url: "/api/close-tiket-comment",
                        method: "POST",
                        dataType: "json",
                        data: {
                            nik: $user_id,
                            id_tiket: $id_tiket,
                            rating_kepuasan: $rating_review,
                            catatan_kepuasan: $catatan_kepuasan,
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
