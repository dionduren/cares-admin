<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Chartjs_Charts'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Charts <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Chartjs <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Line Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="lineChart" height="300" data-colors='["rgba(28, 132, 238, 0.2)", "#1c84ee", "rgba(235, 239, 242, 0.2)", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Bar Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="bar" height="300" data-colors='["rgba(52, 195, 143, 0.8)", "rgba(52, 195, 143, 0.9)"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Pie Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="pie" height="260" data-colors='["#34c38f", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Donut Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="doughnut" height="260" data-colors='["#1c84ee", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Polar Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="polarArea" height="300" data-colors='["#ef6767", "#34c38f", "#ffcc5a", "#1c84ee"]'> </canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Radar Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="radar" height="300" data-colors='["rgba(52, 195, 143, 0.2)", "#34c38f", "rgba(28, 132, 238, 0.2)", "#1c84ee"]'></canvas>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/chart.js/chart.js.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/chartjs.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/charts-chartjs.blade.php ENDPATH**/ ?>