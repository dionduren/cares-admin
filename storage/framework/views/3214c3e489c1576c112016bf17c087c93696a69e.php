
<?php $__env->startSection('title'); ?>
    Buat Tiket Baru
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('/assets/libs/admin-resources/admin-resources.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Tiket
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Buat Tiket Baru
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row py-5">
        <div class="col-11 mx-auto">
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
                        <input type="text" class="form-control" name="judul_tiket" id="judul_tiket">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="detail_tiket">Detail Tiket</label>
                    <div class="col">
                        <textarea type="text" class="form-control" name="detail_tiket" id="detail_tiket" rows="5"></textarea>
                    </div>
                </div>

                <div class="row pb-3 mx-auto text-center">
                    <button class="btn btn-lg btn-primary" type="submit" style="width: 100%">Submit
                        Ticket</button>
                </div>

            </form>
        </div>
    </div>

    <div class="row" id="failure-box">
        <div class="col-11 mx-auto">
            <div class="form-group mb-3">
                <label for="reason">Reason for Failure:</label>
                <textarea id="reason" class="form-control" readonly></textarea>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
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

                    // get_subcat(1);
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

            $('#create-tiket-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submit action

                let formData = $(this).serialize(); // Serialize form data

                var selectedCategoryText = $("#kategori_tiket option:selected").text();
                var selectedSubCategoryText = $("#subkategori_tiket option:selected").text();

                formData += '&nama_kategori=' + encodeURIComponent(selectedCategoryText);
                formData += '&nama_subkategori=' + encodeURIComponent(selectedSubCategoryText);

                if ($("select[name='item_kategori_tiket']").length) {
                    var selectedItemCategoryText = $("#item_kategori_tiket option:selected").text();
                    formData += '&nama_item_kategori=' + encodeURIComponent(selectedItemCategoryText);
                }

                // console.log(formData);
                // alert(formData);

                $.ajax({
                    url: "/api/submit-tiket",
                    method: "POST",
                    dataType: "json",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log('INI MASUK SUCCESS')
                        console.log(data);
                        console.log(data.success);
                        window.location.href = '/'; // Redirect to user home page
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log('INI MASUK ERROR')
                        console.log(err);
                        console.log(err.success);
                        console.log(err.errors);

                        $.each(err.errors, function(index, value) {

                            $('#' + index).addClass(
                                'highlight'); // Add a CSS class to highlight the field
                        })

                        $('#reason').val(err.reason); // Show the reason for failure

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/ticket/create.blade.php ENDPATH**/ ?>