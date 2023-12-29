@extends('layouts.master')
@section('title')
    Buat Tiket Problem Baru
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
            Buat Tiket Problem Baru
        @endslot
    @endcomponent
    <div class="row py-5">
        <div class="col-11 mx-auto">

            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <form id="create-tiket-form">

                        <div class="row mb-3">
                            <label for="id_tiket_prev">Sumber Tiket Insiden</label>
                            <div class="col">
                                <select class="form-control" name="id_tiket_prev" id="id_tiket_prev">
                                    {{-- <option value="0">Pilih Kategori</option> --}}
                                    <option value="1">INC-PIH-TI-00001 - Problem Modul BPC</option>
                                    <option value="2">INC-PIH-TI-00002 - Permasalahan Jaringan Server</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kategori_tiket">Kategori Tiket</label>
                            <div class="col">
                                <select class="form-control" name="kategori_tiket" id="kategori_tiket">
                                    <option value="1">Software & Aplikasi</option>
                                    <option value="2">Hardware</option>
                                    {{-- <option value="0">Pilih Kategori</option> --}}
                                    {{-- <option value="1">Software</option> --}}
                                    {{-- <option value="2">Database</option>
                                    <option value="3">Hardware</option>
                                    <option value="4">Security</option>
                                    <option value="5">Network</option>
                                    <option value="6">Others</option>
                                    <option value="7">None</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkategori_tiket">Subkategori Tiket</label>
                            <div class="col">
                                <select class="form-control" name="subkategori_tiket" id="subkategori_tiket">
                                    <option value="2">SAP</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div id="item-category-container">
                                <!-- Item category dropdown will be inserted here -->
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="tipe_problem">Tipe Problem</label>
                            <div class="col">
                                <select class="form-control" name="tipe_problem" id="tipe_problem">
                                    {{-- <option value="0">Pilih Kategori</option> --}}
                                    <option value="1">Down</option>
                                    <option value="2">Error</option>
                                    <option value="3">Bugs</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3 ms-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="major_problem" checked>
                                <label class="form-check-label" for="major_problem">
                                    Major Problem
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3 ms-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="knowledge">
                                <label class="form-check-label" for="knowledge">
                                    Knowledge
                                </label>
                            </div>
                        </div>

                        <br>

                        <div class="row mb-3">
                            <label for="judul">Judul Tiket</label>
                            <div class="col">
                                <input type="text" class="form-control" name="judul_tiket" id="judul_tiket">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="detail_tiket">Detail Tiket</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="detail_tiket" id="detail_tiket" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gejala_problem">Gejala</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="gejala_problem" id="gejala_problem" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kronologi_problem">Kronologi</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="kronologi_problem" id="kronologi_problem" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="root_cause_analysis_result">Root Cause Analysis Result</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="root_cause_analysis_result" id="root_cause_analysis_result"
                                    rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="workaround">Workaround</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="workaround" id="workaround" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="workaround">Workaround</label>
                            <div class="col">
                                <textarea type="text" class="form-control" name="workaround" id="workaround" rows="3"></textarea>
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

                        <div class="row pb-3 mx-auto text-center">
                            <button class="btn btn-lg btn-primary" type="submit" style="width: 100%">Submit
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

        // $(document).ready(function() {
        //     $.ajax({
        //         url: "/api/kategori-list/",
        //         method: "GET",
        //         dataType: "json",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(data) {
        //             //
        //             $('#kategori_tiket').empty();
        //             $('#kategori_tiket').append('<option value="">Pilih Kategori</option>');
        //             $('#subkategori_tiket').append('<option value="">Pilih Sub Kategori</option>');

        //             $.each(data, function(key, value) {
        //                 $('#kategori_tiket').append('<option value="' + value.id + '">' + value
        //                     .nama_kategori + '</option>');
        //             });

        //             // get_subcat(1);
        //         }
        //     })

        //     $('#kategori_tiket').change(function() {
        //         var id_kategori = $(this).val();

        //         get_subcat(id_kategori);
        //     })

        //     $('#subkategori_tiket').change(function() {
        //         var id_subkategori = $(this).val();

        //         get_itemcat(id_subkategori);
        //     })

        //     // Attachment Validation & Preview Function
        //     $('#file-input').on('change', function() {
        //         var files = $(this)[0].files;
        //         var errorMessages = [];

        //         // Clear existing previews
        //         $('#preview-container').html('');
        //         var row = $('<div>').addClass('row');
        //         $('#preview-container').append(row);

        //         // Check file count
        //         if (files.length > 3) {
        //             errorMessages.push('Hanya bisa melampirkan maksimal 3 berkas.');
        //             this.value = ''; // Clear the file input
        //         } else {
        //             // Check file types and sizes
        //             var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.rar|\.pdf)$/i;
        //             for (var i = 0; i < files.length; i++) {
        //                 var file = files[i];
        //                 var fileName = file.name;

        //                 if (!allowedExtensions.exec(fileName)) {
        //                     errorMessages.push('Tipe File (' + file.name + ') tidak sesuai.');
        //                 } else if (file.size > 2097152) { // 2MB in bytes
        //                     errorMessages.push('Ukuran Berkas (' + file.name +
        //                         ') Melebihi jumlah maksimal 2MB.');
        //                 } else {
        //                     var col = $('<div>').addClass('col-md-4');
        //                     var reader = new FileReader();

        //                     reader.onload = (function(file, col) {
        //                         return function(e) {
        //                             var filePreview = $('<div>').addClass('file-preview');
        //                             var caption = $('<p class="text-center">').text(file.name);

        //                             if (file.type.match('image.*')) {
        //                                 var img = $('<img>').attr('src', e.target.result).css({
        //                                         'max-height': '150px',
        //                                         'width': 'auto',
        //                                         'display': 'block',
        //                                         'margin': '0 auto'
        //                                     })
        //                                     .addClass('img-fluid');
        //                                 filePreview.append(img);
        //                             } else if (file.type === 'application/pdf') {
        //                                 var icon = $('<i class="fas fa-file-pdf"></i>').css(
        //                                     'font-size', '24px');
        //                                 filePreview.append(icon);
        //                             }
        //                             // else if (file.name.endsWith('.zip') || file.name.endsWith(
        //                             //         '.rar')) {
        //                             //     var icon = $('<i class="fas fa-file-archive"></i>').css(
        //                             //         'font-size', '24px');
        //                             //     filePreview.append(icon);
        //                             // }
        //                             filePreview.append(caption);
        //                             col.append(filePreview);
        //                             row.append(col);
        //                         };
        //                     })(file, col);

        //                     if (file.type.match('image.*')) {
        //                         reader.readAsDataURL(file);
        //                     } else {
        //                         reader.onload();
        //                     }
        //                 }
        //             }
        //         }

        //         // Display error messages if any
        //         if (errorMessages.length > 0) {
        //             var htmlErrorMessage = '<ul class="text-start">';
        //             for (var i = 0; i < errorMessages.length; i++) {
        //                 htmlErrorMessage += '<li>' + errorMessages[i] + '</li>';
        //             }
        //             htmlErrorMessage += '</ul>';

        //             Swal.fire({
        //                 title: 'Error!',
        //                 html: htmlErrorMessage,
        //                 icon: 'error',
        //                 customClass: 'swal-wide'
        //             });
        //         }
        //     });

        //     // $('#create-tiket-form').submit(function(event) {
        //     //     event.preventDefault();

        //     //     // Pengumpulan data di dalam form
        //     //     let formData = $(this).serialize();

        //     //     var selectedCategoryText = $("#kategori_tiket option:selected").text();
        //     //     var selectedSubCategoryText = $("#subkategori_tiket option:selected").text();

        //     //     formData += '&user_id=' + encodeURIComponent($user_id);
        //     //     formData += '&nama_kategori=' + encodeURIComponent(selectedCategoryText);
        //     //     formData += '&nama_subkategori=' + encodeURIComponent(selectedSubCategoryText);

        //     //     if ($("select[name='item_kategori_tiket']").length) {
        //     //         var selectedItemCategoryText = $("#item_kategori_tiket option:selected").text();
        //     //         formData += '&nama_item_kategori=' + encodeURIComponent(selectedItemCategoryText);
        //     //     }

        //     //     // Add files to formData
        //     //     var fileInput = $('#file-input')[0]; // Adjust the selector to your file input field
        //     //     if (fileInput.files.length > 0) {
        //     //         for (var i = 0; i < fileInput.files.length; i++) {
        //     //             // formData.append('attachments[]', fileInput.files[i]);
        //     //             formData.push({
        //     //                 name: 'attachments[]',
        //     //                 value: fileInput.files[i]
        //     //             });
        //     //         }
        //     //     }

        //     //     $.ajax({
        //     //         url: "/api/submit-tiket",
        //     //         method: "POST",
        //     //         dataType: "json",
        //     //         data: formData,
        //     //         processData: false,
        //     //         contentType: false,
        //     //         headers: {
        //     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     //         },
        //     //         success: function(data) {
        //     //             console.log('INI MASUK SUCCESS')
        //     //             console.log(data);
        //     //             console.log(data.success);
        //     //             window.location.href = '/';
        //     //         }
        //     //     })
        //     // })

        //     $('#create-tiket-form').submit(function(event) {
        //         event.preventDefault();

        //         // Pengumpulan data di dalam form
        //         var formData = new FormData($('#create-tiket-form')[0]);

        //         formData.append('user_id', $user_id);
        //         formData.append('nama_kategori', $("#kategori_tiket option:selected").text());
        //         formData.append('nama_subkategori', $("#subkategori_tiket option:selected").text());

        //         if ($("select[name='item_kategori_tiket']").length) {
        //             formData.append('nama_item_kategori', $("#item_kategori_tiket option:selected").text());
        //         }

        //         // Log the FormData contents
        //         // for (var entry of formData.entries()) {
        //         //     console.log(entry[0], entry[1]);
        //         // }

        //         $.ajax({
        //             url: "/api/submit-tiket",
        //             method: "POST",
        //             dataType: "json",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(data) {
        //                 window.location.href = '/';
        //             }
        //         })
        //     })
        // });

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
                    }
                }
            })
        }
    </script>
@endsection
