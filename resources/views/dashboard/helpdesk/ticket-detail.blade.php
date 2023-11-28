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
                                        <input type="text" class="form-control" name="id_tiket" id="id_tiket" readonly
                                            hidden>

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
                                                <input type="text" class="form-control" name="tingkat_prioritas"
                                                    id="tingkat_prioritas" readonly>
                                            </div>
                                        </div>

                                        <label for="tipe_sla">Durasi SLA</label>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input type="text" class="form-control" name="tipe_sla"
                                                    id="tipe_sla" readonly>
                                            </div>
                                        </div>


                                        <label for="grup_teknisi">Pilihan Grup Teknisi</label>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <select class="form-control dropdownGrup" name="grup_teknisi"
                                                    id="grup_teknisi">
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
        let daftarGrup = null;

        $(document).ready(function() {

            getAttachments();
            getGrup();

            $('#assignTicketModal').on('show.bs.modal', function(event) {
                getTicketInfo($id_tiket);
            });

            $('#tingkat_urgensi, #tingkat_dampak').change(calculatePriority);
            $('#tingkat_urgensi, #tingkat_dampak, #jenis_tiket').change(getSLAtype);

            $('#assignGroupBtn').click(function() {
                $nik = $user_id;
                $id_tiket = $id_tiket;
                $tipe_tiket = $('#jenis_tiket').val();
                $tingkat_urgensi = $('#tingkat_urgensi').val();
                $tingkat_dampak = $('#tingkat_dampak').val();
                $tingkat_prioritas = $('#tingkat_prioritas').val();
                $tipe_sla = $('#tipe_sla').val();
                $id_group = $('#grup_teknisi').find(':selected').val();
                $assigned_group = $('#grup_teknisi').find(':selected').text();

                $.ajax({
                    url: "/api/tiket-assign-group",
                    method: "POST",
                    dataType: "json",
                    data: {
                        nik: $nik,
                        id_tiket: $id_tiket,
                        tipe_tiket: $tipe_tiket,
                        tingkat_urgensi: $tingkat_urgensi,
                        tingkat_dampak: $tingkat_dampak,
                        tingkat_prioritas: $tingkat_prioritas,
                        tipe_sla: $tipe_sla,
                        id_group: $id_group,
                        assigned_group: $assigned_group,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // $('#assignModal').modal('toggle');
                        window.location.href = '/';

                    }
                })
            });

            function getGrup() {
                if (daftarGrup === null) {
                    // If the list is not already fetched, make an API call
                    $.ajax({
                        url: "/api/technical-group-list",
                        method: "GET",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            daftarGrup = data;

                            populateDropdowns();
                        }
                    })
                } else {
                    // If the list is already fetched, populate the dropdowns
                    populateDropdowns();
                }
            }

            function getTicketInfo(id_tiket) {
                $.ajax({
                    url: "/api/tiket-detail/" + id_tiket,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#jenis_tiket').val(data.tipe_tiket);
                        $('#tingkat_urgensi').val(data.level_urgensi);
                        $('#tingkat_dampak').val(data.level_dampak);

                        calculatePriority();
                        getSLAtype();
                    }
                })
            }

            function populateDropdowns() {
                const dropdowns = $('.dropdownGrup');

                dropdowns.each(function() {
                    const dropdown = $(this);
                    daftarGrup.forEach(grupTeknis => {
                        const option = $('<option></option>').attr('value', grupTeknis.id).text(
                            grupTeknis.nama_group);
                        // const option = $('<option></option>').attr('value', grupTeknis.id).text(
                        //     grupTeknis.nama_group).attr('data-leader', grupTeknis
                        //     .nama_team_lead);
                        dropdown.append(option);
                    });
                });
            }

            function calculatePriority() {
                var urgency = $('#tingkat_urgensi option:selected').text();
                var impact = $('#tingkat_dampak option:selected').text();

                var priorityMatrix = {
                    'HIGH': {
                        'HIGH': 'Critical',
                        'MEDIUM': 'High',
                        'LOW': 'Medium'
                    },
                    'MEDIUM': {
                        'HIGH': 'High',
                        'MEDIUM': 'Medium',
                        'LOW': 'Low'
                    },
                    'LOW': {
                        'HIGH': 'Medium',
                        'MEDIUM': 'Low',
                        'LOW': 'Low'
                    }
                };

                // Determine the priority text based on the matrix
                var priorityText = priorityMatrix[urgency][impact];

                // Set the value in the readonly input field
                $('#tingkat_prioritas').val(priorityText);
            }

            function getSLAtype() {
                var tipe_tiket = $('#jenis_tiket').val();
                var tipe_sla = $('#tingkat_prioritas').val();

                $.ajax({
                    url: "/api/helpdesk-get-sla",
                    method: "GET",
                    dataType: "json",
                    data: {
                        tipe_tiket: tipe_tiket,
                        tipe_sla: tipe_sla,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#tipe_sla').val(data.nama_sla);
                    }
                })
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
