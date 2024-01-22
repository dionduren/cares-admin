@extends('layouts.master')
@section('title')
    Buat Tiket Baru
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <style>
        .swal-wide {
            width: 850px !important;
        }
    </style>
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

            <div class="col">
                <div class="card bg-danger border-danger text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="mdi mdi-block-helper me-3"></i>Alasan Reject</h5>
                        <textarea type="text" class="form-control" name="alasan_reject" id="alasan_reject" rows="4" readonly>{{ $tiket->alasan_reject }}</textarea>
                    </div>
                </div>
            </div><!-- end col -->

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

                        <div class="row mb-3">
                            <label for="judul">Judul Tiket</label>
                            <div class="col">
                                <input type="text" class="form-control" name="judul_tiket" id="judul_tiket"
                                    value="{{ $tiket->judul_tiket }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="detail_tiket">Detail Tiket</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="detail_tiket" id="detail_tiket" rows="5">{{ $tiket->detail_tiket }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file-input">Lampiran</label>
                            <div class="col">
                                <input type="file" id="file-input" name="attachments[]" multiple>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div id="preview-container"></div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <small>catatan: Dengan mengupload lampiran baru, lampiran existing anda akan terhapus</small>
                        </div>


                        <div class="row mb-3">
                            <label for="attachment_list">Daftar Lampiran / Attachments</label>
                            <div class="col-auto"></div>
                            <div class="col-11">
                                <ul class="fs-4" id="attachment_list"></ul>
                            </div>
                        </div>

                        <div class="row pb-3 mx-auto text-center">
                            <button class="btn btn-lg btn-primary" type="submit" style="width: 100%">Revisi
                                Ticket</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $user_id = "{{ $user->nik }}";
        $ticket_detail = {!! json_encode($tiket) !!};

        $(document).ready(function() {
            // console.log($ticket_detail);

            $.ajax({
                url: "/api/kategori-list/",
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //
                    $('#kategori_tiket').empty();
                    $('#kategori_tiket').append('<option value="">Pilih Kategori</option>');
                    $('#subkategori_tiket').append('<option value="">Pilih Sub Kategori</option>');

                    $.each(data, function(key, value) {
                        $('#kategori_tiket').append('<option value="' + value.id + '">' + value
                            .nama_kategori + '</option>');
                    });

                    $('#kategori_tiket').val($ticket_detail['id_kategori']).change();

                    getAttachments();

                }
            })

            $('#kategori_tiket').change(function() {
                var id_kategori = $(this).val();

                get_subcat(id_kategori);
            })

            $('#subkategori_tiket').change(function() {
                var id_subkategori = $(this).val();

                get_itemcat(id_subkategori);
            })

            // Attachment Validation & Preview Function
            $('#file-input').on('change', function() {
                var files = $(this)[0].files;
                var errorMessages = [];

                // Clear existing previews
                $('#preview-container').html('');
                var row = $('<div>').addClass('row');
                $('#preview-container').append(row);

                // Check file count
                if (files.length > 3) {
                    errorMessages.push('Hanya bisa melampirkan maksimal 3 berkas.');
                    this.value = ''; // Clear the file input
                } else {
                    // Check file types and sizes
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.rar|\.pdf)$/i;
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var fileName = file.name;

                        if (!allowedExtensions.exec(fileName)) {
                            errorMessages.push('Tipe File (' + file.name + ') tidak sesuai.');
                        } else if (file.size > 2097152) { // 2MB in bytes
                            errorMessages.push('Ukuran Berkas (' + file.name +
                                ') Melebihi jumlah maksimal 2MB.');
                        } else {
                            var col = $('<div>').addClass('col-md-4');
                            var reader = new FileReader();

                            reader.onload = (function(file, col) {
                                return function(e) {
                                    var filePreview = $('<div>').addClass('file-preview');
                                    var caption = $('<p class="text-center">').text(file.name);

                                    if (file.type.match('image.*')) {
                                        var img = $('<img>').attr('src', e.target.result).css({
                                                'max-height': '150px',
                                                'width': 'auto',
                                                'display': 'block',
                                                'margin': '0 auto'
                                            })
                                            .addClass('img-fluid');
                                        filePreview.append(img);
                                    } else if (file.type === 'application/pdf') {
                                        var icon = $('<i class="fas fa-file-pdf"></i>').css(
                                            'font-size', '24px');
                                        filePreview.append(icon);
                                    }
                                    filePreview.append(caption);
                                    col.append(filePreview);
                                    row.append(col);
                                };
                            })(file, col);

                            if (file.type.match('image.*')) {
                                reader.readAsDataURL(file);
                            } else {
                                reader.onload();
                            }
                        }
                    }
                }

                // Display error messages if any
                if (errorMessages.length > 0) {
                    var htmlErrorMessage = '<ul class="text-start">';
                    for (var i = 0; i < errorMessages.length; i++) {
                        htmlErrorMessage += '<li>' + errorMessages[i] + '</li>';
                    }
                    htmlErrorMessage += '</ul>';

                    Swal.fire({
                        title: 'Error!',
                        html: htmlErrorMessage,
                        icon: 'error',
                        customClass: 'swal-wide'
                    });
                }
            });

            $('#create-tiket-form').submit(function(event) {
                event.preventDefault();

                // Pengumpulan data di dalam form
                var formData = new FormData($('#create-tiket-form')[0]);

                formData.append('id', $ticket_detail.id);
                formData.append('user_id', $user_id);
                formData.append('nama_kategori', $("#kategori_tiket option:selected").text());
                formData.append('nama_subkategori', $("#subkategori_tiket option:selected").text());

                if ($("select[name='item_kategori_tiket']").length) {
                    formData.append('nama_item_kategori', $("#item_kategori_tiket option:selected").text());
                }

                $.ajax({
                    url: "/api/submit-tiket-revise",
                    method: "POST",
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        window.location.href = '/';
                    }
                })
            })
        });

        function get_subcat(id) {
            $.ajax({
                url: "/api/subkategori-list/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //
                    $('#subkategori_tiket').empty();
                    $('#item-category-container').empty();

                    $('#subkategori_tiket').append('<option value="">Pilih Sub Kategori</option>');

                    $.each(data, function(key, value) {
                        $('#subkategori_tiket').append('<option value="' + value
                            .id +
                            '">' + value
                            .nama_subkategori + '</option>');
                    });

                    $('#subkategori_tiket').val($ticket_detail['id_subkategori']).change();
                }
            })
        }

        function get_itemcat(id) {
            $.ajax({
                url: "/api/item-kategori-list/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#item-category-container').empty();

                    // check if data exist or not
                    if (data !== null && data.length > 0) {
                        var itemCategorySelect = $(
                            '<label for="item_kategori_tiket">Item Kategori Tiket</label><select class="form-control mb-3" id="item_kategori_tiket" name="item_kategori_tiket"></select>'
                        );
                        $('#item-category-container').append(itemCategorySelect);
                        $('#item_kategori_tiket').append('<option value="">Pilih Item Kategori</option>');

                        $.each(data, function(key, value) {
                            $('#item_kategori_tiket').append('<option value="' + value
                                .id +
                                '">' + value
                                .nama_item_kategori + '</option>');
                        });


                        $('#item_kategori_tiket').val($ticket_detail['id_item_kategori']);
                    }
                }
            })
        }

        function getAttachments() {
            $.ajax({
                url: "/api/tiket-attachments/" + $ticket_detail['id'],
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
    </script>
@endsection
