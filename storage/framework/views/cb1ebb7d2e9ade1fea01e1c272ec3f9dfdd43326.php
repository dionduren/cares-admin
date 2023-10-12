<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('/assets/libs/admin-resources/admin-resources.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Main Page
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xl-5 col-md-5 ms-auto">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="text-muted mb-4 lh-1 d-block text-truncate">
                                Jumlah Tiket Helpdesk
                            </h3>
                            <h5 class="mb-1">
                                Request : 61
                            </h5>
                            <div class="text-nowrap fs-5 mb-5">
                                <span class="badge bg-soft-success text-success">+21</span>
                                <span class="ms-1 text-muted font-size-13">Tiket <u><b>Request</b></u> Per Minggu
                                    lalu</span>
                            </div>
                            <h5 class="mb-1">
                                Incident : 89
                            </h5>
                            <div class="text-nowrap fs-5 mb-2">
                                <span class="badge bg-soft-warning text-warning">+12</span>
                                <span class="ms-1 text-muted font-size-13">Tiket <u><b>Incident</b></u> Per Minggu
                                    lalu</span>
                            </div>
                        </div>

                        <div class="flex-grow-1 text-end dash-widget">
                            <div id="mini-chart1" data-colors='["#6BDD63", "#FFBA10"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        


        <div class="col-xl-5 col-md-5 me-auto">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="text-muted mb-4 lh-1 d-block text-truncate">
                                Status Tiket Helpdesk
                            </h3>
                            <h5 class="mb-1">
                                Waiting : 5
                            </h5>
                            <div class="text-nowrap fs-5 mb-5">
                                <span class="badge bg-soft-primary text-primary">+3</span>
                                <span class="ms-1 text-muted font-size-13">Tiket <u><b>Baru</b></u> Per hari ini</span>
                            </div>

                            <h5 class="mb-1">
                                Assigned : 50
                            </h5>
                            <div class="text-nowrap fs-5 mb-5">
                                <span class="badge bg-soft-warning text-warning">+27</span>
                                <span class="ms-1 text-muted font-size-13">Tiket <u><b>Assigned</b></u> Per hari ini</span>
                            </div>

                            <h5 class="mb-1">
                                Finished : 95
                            </h5>
                            <div class="text-nowrap fs-5 mb-2">
                                <span class="badge bg-soft-success text-success">+11</span>
                                <span class="ms-1 text-muted font-size-13">Tiket <u><b>Closed</b></u> Per hari ini</span>
                            </div>
                        </div>

                        <div class="flex-grow-1 text-end dash-widget">
                            <div id="mini-chart2" data-colors='["#4785E1", "#FFBA10","#6BDD63"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row-->

    <div class="row">
        <div class="col-xl-10 col-md-10 mx-auto">
            <a href="/create-ticket" class="btn btn-lg btn-warning fs-4 fw-bold text-dark" style="width: 100%">Buat Tiket
                Baru</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-10 col-md-10 mx-auto">
            <div class="card card-h-100">
                <div class="card-body">
                    <h3 class="text-muted mb-4 lh-1 d-block text-truncate">
                        Daftar Tiket Aktif Anda
                    </h3>

                    <table id="ticket-display" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Tipe Tiket</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Subkategori</th>
                                <th class="text-center">Item kategori</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Status Tiket</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $daftar_tiket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tiket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($tiket->nomor_tiket != null ? $tiket->nomor_tiket : 'Empty'); ?>

                                    </td>
                                    <td class="text-center"><?php echo e($tiket->tipe_tiket); ?></td>
                                    <td class="text-center"><?php echo e($tiket->kategori_tiket); ?></td>
                                    <td><?php echo e($tiket->subkategori_tiket); ?></td>
                                    <td>
                                        <?php if($tiket->item_kategori_tiket != null): ?>
                                            <?php echo e($tiket->item_kategori_tiket); ?>

                                        <?php else: ?>
                                            <div class="text-center">
                                                -
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($tiket->judul_tiket); ?></td>
                                    <td class="text-center">
                                        <?php echo e($tiket->status_tiket); ?>

                                    </td>
                                    <td>
                                        <?php if($tiket->status_tiket == 'Finished'): ?>
                                            <div class="btn-group text-center">
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-expanded="false" style="background-color:#2D50A0;color:white">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Detail</a></li>
                                                    <li><a class="dropdown-item" href="#">Tutup Tiket</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Revisi
                                                            Solusi</a></li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- apexcharts -->
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/admin-resources/admin-resources.min.js')); ?>"></script>

    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/dashboard.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#ticket-display').DataTable();
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/index.blade.php ENDPATH**/ ?>