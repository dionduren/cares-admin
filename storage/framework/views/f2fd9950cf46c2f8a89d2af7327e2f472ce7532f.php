<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.E_Charts'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Charts <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Echarts <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Line Chart</h4>
            </div>
            <div class="card-body">
                <div id="line-chart" data-colors='["#34c38f", "#ccc"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Mix Line-Bar</h4>
            </div>
            <div class="carzd-body">
                <div id="mix-line-bar" data-colors='["#34c38f", "#1c84ee", "#ef6767"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Doughnut Chart</h4>
            </div>
            <div class="card-body">
                <div id="doughnut-chart" data-colors='["#1c84ee", "#ffcc5a", "#ef6767", "#16daf1", "#34c38f"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Pie Chart</h4>
            </div>
            <div class="card-body">
                <div id="pie-chart" data-colors='["#ef6767", "#34c38f", "#16daf1", "#ffcc5a", "#1c84ee"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Scatter Chart</h4>
            </div>
            <div class="card-body">
                <div id="scatter-chart" data-colors='["#34c38f"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Bubble Chart</h4>
            </div>
            <div class="card-body">
                <div id="bubble-chart" data-colors='["rgb(28, 132, 238)", "rgb(143, 148, 255)", "rgba(28, 132, 238, 0.5)", "rgb(52, 195, 143)", "rgb(111, 255, 203)",  "rgb(52, 195, 143, 0.5)"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Candlestick Chart</h4>
            </div>
            <div class="card-body">
                <div id="candlestick-chart" data-colors='["#1c84ee", "#34c38f"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Gauge Chart</h4>
            </div>
            <div class="card-body">
                <div id="gauge-chart" data-colors='["#34c38f", "#1c84ee", "#ef6767"]' class="e-charts"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/echarts/echarts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/echarts.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/charts-echart.blade.php ENDPATH**/ ?>