<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index " class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('assets/images/logo-sm.svg')); ?>" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo e(URL::asset('assets/images/logo-sm.svg')); ?>" alt="" height="24"> <span
                            class="logo-txt">Dason</span>
                    </span>
                </a>

                <a href="index " class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('assets/images/logo-sm.svg')); ?>" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo e(URL::asset('assets/images/logo-sm.svg')); ?>" alt="" height="24"> <span
                            class="logo-txt">Dason</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button"><i
                            class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                </button>


                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item" id="mode-setting-btn">
                        <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                        <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                    </button>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i data-feather="grid" class="icon-lg"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/github.png')); ?>" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/bitbucket.png')); ?>"
                                            alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/dribbble.png')); ?>"
                                            alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/dropbox.png')); ?>"
                                            alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/mail_chimp.png')); ?>"
                                            alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?php echo e(URL::asset('assets/images/brands/slack.png')); ?>" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i data-feather="bell" class="icon-lg"></i>
                        <span class="badge bg-danger rounded-pill">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small text-reset text-decoration-underline"> Unread
                                        (3)</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="<?php echo e(URL::asset('assets/images/users/avatar-3.jpg')); ?>"
                                        class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">James Lemire</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">It will seem like simplified English.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours
                                                    ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min
                                                    ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="bx bx-badge-check"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your item is shipped</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min
                                                    ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="<?php echo e(URL::asset('assets/images/users/avatar-6.jpg')); ?>"
                                        class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Salena Layfield</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours
                                                    ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item right-bar-toggle me-2">
                        <i data-feather="settings" class="icon-lg"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item bg-soft-light border-start border-end"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="<?php if(Auth::user()->avatar != ''): ?> <?php echo e(URL::asset('images/' . Auth::user()->avatar)); ?><?php else: ?><?php echo e(URL::asset('assets/images/users/avatar-1.png')); ?> <?php endif; ?>"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo e(Auth::user()->name); ?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="apps-contacts-profile "><i
                                class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item" href="auth-lock-screen "><i
                                class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="javascript:void();"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                key="t-logout">Logout</span></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                            style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard"
                            role="button">
                            <i data-feather="home"></i><span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement"
                            role="button">
                            <i data-feather="briefcase"></i>
                            <span data-key="t-elements">Elements</span>
                            <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                            aria-labelledby="topnav-uielement">
                            <div class="ps-2 p-lg-0">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div>
                                            <div class="menu-title">Elements</div>
                                            <div class="row g-0">
                                                <div class="col-lg-5">
                                                    <div>
                                                        <a href="ui-alerts " class="dropdown-item"
                                                            data-key="t-alerts">Alerts</a>
                                                        <a href="ui-buttons " class="dropdown-item"
                                                            data-key="t-buttons">Buttons</a>
                                                        <a href="ui-cards " class="dropdown-item"
                                                            data-key="t-cards">Cards</a>
                                                        <a href="ui-carousel " class="dropdown-item"
                                                            data-key="t-carousel">Carousel</a>
                                                        <a href="ui-dropdowns " class="dropdown-item"
                                                            data-key="t-dropdowns">Dropdowns</a>
                                                        <a href="ui-grid " class="dropdown-item"
                                                            data-key="t-grid">Grid</a>
                                                        <a href="ui-images " class="dropdown-item"
                                                            data-key="t-images">Images</a>
                                                        <a href="ui-modals " class="dropdown-item"
                                                            data-key="t-modals">Modals</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div>
                                                        <a href="ui-offcanvas " class="dropdown-item"
                                                            data-key="t-offcanvas">Offcanvas</a>
                                                        <a href="ui-progressbars " class="dropdown-item"
                                                            data-key="t-progress-bars">Progress_Bars</a>
                                                        <a href="ui-placeholders " class="dropdown-item"
                                                            data-key="t-progress-bars">Placeholders</a>
                                                        <a href="ui-tabs-accordions " class="dropdown-item"
                                                            data-key="t-tabs-accordions">Tabs_&_Accordions</a>
                                                        <a href="ui-typography " class="dropdown-item"
                                                            data-key="t-typography">Typography</a>
                                                        <a href="ui-video " class="dropdown-item"
                                                            data-key="t-video">Video</a>
                                                        <a href="ui-general " class="dropdown-item"
                                                            data-key="t-general">General</a>
                                                        <a href="ui-colors " class="dropdown-item"
                                                            data-key="t-colors">Colors</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div>
                                            <div class="menu-title">Extended</div>
                                            <div>
                                                <a href="extended-lightbox " class="dropdown-item"
                                                    data-key="t-lightbox">Lightbox</a>
                                                <a href="extended-rangeslider " class="dropdown-item"
                                                    data-key="t-range-slider">Range_Slider</a>
                                                <a href="extended-sweet-alert " class="dropdown-item"
                                                    data-key="t-sweet-alert">Sweet_Alert 2</a>
                                                <a href="extended-session-timeout " class="dropdown-item"
                                                    data-key="t-session-timeout">Session_Timeout</a>
                                                <a href="extended-rating " class="dropdown-item"
                                                    data-key="t-rating">Rating</a>
                                                <a href="extended-notifications " class="dropdown-item"
                                                    data-key="t-notifications">Notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages"
                            role="button">
                            <i data-feather="grid"></i><span data-key="t-apps">Apps</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-ecommerce" role="button">
                                    <span data-key="t-ecommerce">Ecommerce</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">

                                    <a href="ecommerce-products " class="dropdown-item"
                                        data-key="t-products">Products</a>
                                    <a href="ecommerce-product-detail " class="dropdown-item"
                                        data-key="t-product-detail">Product_Detail</a>
                                    <a href="ecommerce-orders " class="dropdown-item" data-key="t-orders">Orders</a>
                                    <a href="ecommerce-customers " class="dropdown-item"
                                        data-key="t-customers">Customers</a>
                                    <a href="ecommerce-cart " class="dropdown-item" data-key="t-cart">Cart</a>
                                    <a href="ecommerce-checkout " class="dropdown-item"
                                        data-key="t-checkout">Checkout</a>
                                    <a href="ecommerce-shops " class="dropdown-item" data-key="t-shops">Shops</a>
                                    <a href="ecommerce-add-product " class="dropdown-item"
                                        data-key="t-add-product">Add_Product</a>
                                </div>
                            </div>


                            <a href="apps-calendar " class="dropdown-item" data-key="t-calendar">Calendars</a>
                            <a href="apps-chat " class="dropdown-item" data-key="t-chat">Chat</a>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Email</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="apps-email-inbox " class="dropdown-item" data-key="t-inbox">Inbox</a>
                                    <a href="apps-email-read " class="dropdown-item"
                                        data-key="t-read-email">Read_Email</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tasks"
                                    role="button">
                                    <span data-key="t-tasks">Tasks</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tasks">
                                    <a href="tasks-list " class="dropdown-item" data-key="t-task-list">Task_List</a>
                                    <a href="tasks-kanban " class="dropdown-item"
                                        data-key="t-kanban-board">Kanban_Board</a>
                                    <a href="tasks-create " class="dropdown-item"
                                        data-key="t-create-task">Create_Task</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-contact" role="button">
                                    <span data-key="t-contacts">Contacts</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                    <a href="apps-contacts-grid " class="dropdown-item"
                                        data-key="t-user-grid">User_Grid</a>
                                    <a href="apps-contacts-list " class="dropdown-item"
                                        data-key="t-user-list">User_List</a>
                                    <a href="apps-contacts-profile " class="dropdown-item"
                                        data-key="t-profile">Profile</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components"
                            role="button">
                            <i data-feather="box"></i><span data-key="t-components">Components</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                    role="button">
                                    <span data-key="t-forms">Forms</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-form">
                                    <a href="form-elements " class="dropdown-item"
                                        data-key="t-form-elements">Basic_Elements</a>
                                    <a href="form-validation " class="dropdown-item"
                                        data-key="t-form-validation">Validation</a>
                                    <a href="form-advanced " class="dropdown-item"
                                        data-key="t-form-advanced">Advanced_Plugins</a>
                                    <a href="form-editors " class="dropdown-item"
                                        data-key="t-form-editors">Editors</a>
                                    <a href="form-uploads " class="dropdown-item"
                                        data-key="t-form-upload">File_Upload</a>
                                    <a href="form-wizard " class="dropdown-item" data-key="t-form-wizard">Wizard</a>
                                    <a href="form-mask " class="dropdown-item" data-key="t-form-mask">Mask</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                    role="button">
                                    <span data-key="t-tables">Tables</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-table">
                                    <a href="tables-basic " class="dropdown-item"
                                        data-key="t-basic-tables">Bootstrap_Basic</a>
                                    <a href="tables-datatable " class="dropdown-item"
                                        data-key="t-data-tables">Data_Tables</a>
                                    <a href="tables-responsive " class="dropdown-item"
                                        data-key="t-responsive-table">Responsive</a>
                                    <a href="tables-editable " class="dropdown-item"
                                        data-key="t-editable-table">Editable_Table</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                    role="button">
                                    <span data-key="t-charts">Charts</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="charts-apex " class="dropdown-item"
                                        data-key="t-apex-charts">Apex_Charts</a>
                                    <a href="charts-echart " class="dropdown-item" data-key="t-e-charts">E_Charts</a>
                                    <a href="charts-chartjs " class="dropdown-item"
                                        data-key="t-chartjs-charts">Chartjs</a>
                                    <a href="charts-knob " class="dropdown-item"
                                        data-key="t-knob-charts">Jquery_Knob</a>
                                    <a href="charts-sparkline " class="dropdown-item"
                                        data-key="t-sparkline-charts">Sparkline</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                    role="button">
                                    <span data-key="t-icons">Icons</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-feather " class="dropdown-item" data-key="t-feather">Feather</a>
                                    <a href="icons-boxicons " class="dropdown-item"
                                        data-key="t-boxicons">Boxicons</a>
                                    <a href="icons-materialdesign " class="dropdown-item"
                                        data-key="t-material-design">Material_Design</a>
                                    <a href="icons-dripicons " class="dropdown-item"
                                        data-key="t-dripicons">Dripicons</a>
                                    <a href="icons-fontawesome " class="dropdown-item"
                                        data-key="t-font-awesome">Font_awesome 5</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                    role="button">
                                    <span data-key="t-maps">Maps</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-map">
                                    <a href="maps-google " class="dropdown-item" data-key="t-g-maps">Google</a>
                                    <a href="maps-vector " class="dropdown-item" data-key="t-v-maps">Vector</a>
                                    <a href="maps-leaflet " class="dropdown-item" data-key="t-l-maps">Leaflet</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                            role="button">
                            <i data-feather="file-text"></i><span data-key="t-extra-pages">Extra_Pages</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-more">

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                    role="button">
                                    <span data-key="t-authentication">Authentication</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="auth-login " class="dropdown-item" data-key="t-login">Login</a>
                                    <a href="auth-register " class="dropdown-item" data-key="t-register">Register</a>
                                    <a href="auth-recoverpw " class="dropdown-item"
                                        data-key="t-recover-password">Recover_Password</a>
                                    <a href="auth-lock-screen " class="dropdown-item"
                                        data-key="t-lock-screen">Lock_Screen</a>
                                    <a href="auth-logout " class="dropdown-item" data-key="t-logout">Logout</a>
                                    <a href="auth-confirm-mail " class="dropdown-item"
                                        data-key="t-confirm-mail">Confirm_Mail</a>
                                    <a href="auth-email-verification " class="dropdown-item"
                                        data-key="t-email-verification">Email_verification</a>
                                    <a href="auth-two-step-verification " class="dropdown-item"
                                        data-key="t-two-step-verification">Two_step_verification</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-utility" role="button">
                                    <span data-key="t-utility">Utility</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                    <a href="pages-starter " class="dropdown-item"
                                        data-key="t-starter-page">Starter_Page</a>
                                    <a href="pages-maintenance " class="dropdown-item"
                                        data-key="t-maintenance">Maintenance</a>
                                    <a href="pages-comingsoon " class="dropdown-item"
                                        data-key="t-coming-soon">Coming_Soon</a>
                                    <a href="pages-timeline " class="dropdown-item"
                                        data-key="t-timeline">Timeline</a>
                                    <a href="pages-faqs " class="dropdown-item" data-key="t-faqs">FAQs</a>
                                    <a href="pages-pricing " class="dropdown-item" data-key="t-pricing">Pricing</a>
                                    <a href="pages-404 " class="dropdown-item" data-key="t-error-404">Error_404</a>
                                    <a href="pages-500 " class="dropdown-item" data-key="t-error-500">Error_500</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="layouts-horizontal " role="button">
                            <i data-feather="layout"></i><span data-key="t-horizontal">Horizontal</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
<?php /**PATH C:\Kerjaan\Pupuk Indonesia - TI\2023\01. Remake Cares\Project\cares-admin\resources\views/layouts/horizontal.blade.php ENDPATH**/ ?>