<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Products'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/gridjs/gridjs.min.css">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Ecommerce <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>Products <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Filter</h4>

                <div>
                    <h5 class="font-size-14 mb-3">Clothes</h5>
                    <ul class="list-unstyled product-list">
                        <li><a href="javascript: void(0);"><i class="mdi mdi-chevron-right me-1"></i> T-shirts</a></li>
                        <li><a href="javascript: void(0);"><i class="mdi mdi-chevron-right me-1"></i> Shirts</a></li>
                        <li><a href="javascript: void(0);"><i class="mdi mdi-chevron-right me-1"></i> Jeans</a></li>
                        <li><a href="javascript: void(0);"><i class="mdi mdi-chevron-right me-1"></i> Jackets</a></li>
                    </ul>
                </div>
                <div class="mt-4 pt-3">
                    <h5 class="font-size-14 mb-3">Price</h5>
                    <div id="priceslider" class="mb-4"></div>
                </div>

                <div class="mt-2 pt-5">
                    <h5 class="font-size-14 mb-3">Discount</h5>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck1">
                        <label class="form-check-label" for="productdiscountCheck1">
                            Less than 10%
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck2">
                        <label class="form-check-label" for="productdiscountCheck2">
                            10% or more
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck3" checked>
                        <label class="form-check-label" for="productdiscountCheck3">
                            20% or more
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck4">
                        <label class="form-check-label" for="productdiscountCheck4">
                            30% or more
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck5">
                        <label class="form-check-label" for="productdiscountCheck5">
                            40% or more
                        </label>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="productdiscountCheck6">
                        <label class="form-check-label" for="productdiscountCheck6">
                            50% or more
                        </label>
                    </div>

                </div>

                <div class="mt-4 pt-3">
                    <h5 class="font-size-14 mb-3">Customer Rating</h5>
                    <div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="productratingCheck1">
                            <label class="form-check-label" for="productratingCheck1">
                                4 <i class="bx bxs-star text-warning"></i>  & Above
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="productratingCheck2">
                            <label class="form-check-label" for="productratingCheck2">
                                3 <i class="bx bxs-star text-warning"></i>  & Above
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="productratingCheck3">
                            <label class="form-check-label" for="productratingCheck3">
                                2 <i class="bx bxs-star text-warning"></i>  & Above
                            </label>
                        </div>

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="productratingCheck4">
                            <label class="form-check-label" for="productratingCheck4">
                                1 <i class="bx bxs-star text-warning"></i>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-9">

        <div class="row mb-3">
            <div class="col-xl-4 col-sm-6">
                <div class="mt-2">
                    <h5>Clothes</h5>
                </div>
            </div>
            <div class="col-lg-8 col-sm-6">
                <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                    <div class="search-box me-2">
                        <div class="position-relative">
                            <input type="text" class="form-control border-0" placeholder="Search...">
                            <i class="bx bx-search-alt search-icon"></i>
                        </div>
                    </div>
                    <ul class="nav nav-pills product-view-nav justify-content-end mt-3 mt-sm-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="bx bx-grid-alt"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bx bx-list-ul"></i></a>
                        </li>
                    </ul>


                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="pricing-badge">
                            <span class="badge text-white bg-primary">- 25 %</span>
                        </div>
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-1.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Half sleeve T-shirt </a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$500</del></span> <b>$450</b></h5>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-2.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Light blue T-shirt</a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$240</del></span> <b>$225</b></h5>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="pricing-badge">
                            <span class="badge text-white bg-primary">- 20 %</span>
                        </div>
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-3.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Black Color T-shirt</a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$175</del></span> <b>$152</b></h5>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-4.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Hoodie (Blue)</a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$150</del></span> <b>$145</b></h5>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="pricing-badge">
                            <span class="badge text-white bg-primary">- 22 %</span>
                        </div>
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-5.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Half sleeve T-Shirt</a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$145</del></span> <b>$138</b></h5>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star"></i>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="pricing-badge">
                            <span class="badge text-white bg-primary">- 28 %</span>
                        </div>
                        <div class="product-img position-relative">
                            <img src="<?php echo e(URL::asset('assets/images/product/img-6.png')); ?>" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Green color T-shirt</a></h5>
                                <h5 class="my-0"><span class="text-muted me-2"><del>$138</del></span> <b>$135</b></h5>
                            </div>


                            <p class="text-muted mb-0">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star"></i>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
                    <li class="page-item disabled">
                        <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item">
                        <a href="javascript: void(0);" class="page-link">1</a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript: void(0);" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript: void(0);" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript: void(0);" class="page-link">4</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript: void(0);" class="page-link">5</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/libs/wnumb/wnumb.min.js')); ?>"></script>
<script src="assets/libs/gridjs/gridjs.js"></script>
<script src="https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js"></script>


<script src="<?php echo e(URL::asset('assets/js/pages/ecommerce-product-list.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/ecommerce-products.blade.php ENDPATH**/ ?>