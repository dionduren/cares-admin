<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="/index">
                        <i data-feather="home"></i>
                        <span class="badge rounded-pill bg-soft-success text-success float-end">9+</span>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                    <a href="/create-ticket">
                        <i class="mdi mdi-ticket-confirmation-outline"></i>
                        <span data-key="t-dashboard">Buat Tiket Baru</span>
                    </a>
                </li>


                @if (Auth::user()->role_id == 7)
                    <li class="menu-title" data-key="t-menu">VP Menu</li>

                    <li>
                        <a href="/vp/ticket-list">
                            <i class="mdi mdi-ticket-confirmation"></i>
                            <span data-key="t-horizontal" style="color:red">Halaman Approval</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks" style="color:red">Daftar Tiket</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/VP User/ticket/new" key="t-task-list" style="color:red">Daftar Tiket Saya</a>
                            </li>
                            <li><a href="/VP User/ticket/ongoing" key="t-kanban-board" style="color:red">Daftar Tiket
                                    Ongoing</a></li>
                            <li><a href="/VP User/ticket/resolved" key="t-create-task" style="color:red">Daftar Tiket
                                    Resolved</a></li>
                            <li><a href="/VP User/ticket/history" key="t-create-task" style="color:red">Histori
                                    Tiket</a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if (Auth::user()->role_id == 3)
                    <li class="menu-title" data-key="t-menu">VP Pemilik Layanan TI</li>

                    <li>
                        <a href="/vp_layanan/ticket-list">
                            <i class="mdi mdi-ticket-confirmation"></i>
                            <span data-key="t-horizontal" style="color:red">Halaman Approval</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks" style="color:red">Daftar Tiket</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/layanan_owner/ticket/new" key="t-task-list" style="color:red">Daftar Tiket
                                    Baru</a>
                            </li>
                            <li><a href="/layanan_owner/ticket/ongoing" key="t-kanban-board" style="color:red">Daftar
                                    Tiket
                                    Ongoing</a></li>
                            <li><a href="/layanan_owner/ticket/resolved" key="t-create-task" style="color:red">Daftar
                                    Tiket
                                    Resolved</a></li>
                            <li><a href="/layanan_owner/ticket/all" key="t-create-task" style="color:red">Histori
                                    Tiket</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_id == 4)
                    <li class="menu-title" data-key="t-menu">Technical Group Leader</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks">Daftar Tiket</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/leader/ticket/new" key="t-task-list">Daftar Tiket Baru</a></li>
                            <li><a href="/leader/ticket/ongoing" key="t-kanban-board">Daftar Tiket
                                    Ongoing</a></li>
                            <li><a href="/leader/ticket/resolved" key="t-create-task">Daftar Tiket
                                    Resolved</a></li>
                            <li><a href="/leader/ticket/all" key="t-create-task">Histori Tiket</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_id == 5)
                    <li class="menu-title" data-key="t-menu">Technical Menu</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks" style="color:red">Daftar Tiket</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/technical/ticket/assigned" key="t-task-list">Daftar Tiket
                                    Assigned</a>
                            </li>
                            <li><a href="/technical/ticket/resolved" key="t-task-list" style="color:red">Daftar Tiket
                                    Resolved</a>
                            </li>
                            <li><a href="/technical/ticket/history" key="t-create-task" style="color:red">All Tiket</a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if (Auth::user()->role_id <= 2)
                    <li class="menu-title" data-key="t-menu">Helpdesk</li>

                    <li>
                        <a href="/helpdesk/ticket/self">
                            <i class="mdi mdi-ticket-confirmation-outline"></i>
                            <span data-key="t-dashboard">Daftar Tiket Saya</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks">Daftar Tiket</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/helpdesk/ticket/new" key="t-task-list">Daftar Tiket Baru</a></li>
                            <li><a href="/helpdesk/ticket/ongoing" key="t-kanban-board">Daftar Tiket Ongoing</a></li>
                            <li><a href="/helpdesk/ticket/resolved" key="t-create-task">Daftar Tiket Resolved</a></li>
                            <li><a href="/helpdesk/ticket/all" key="t-create-task">All Tiket</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-menu">Admin</li>

                    <li>
                        <a href="/master/ticket-list">
                            <i class="mdi mdi-ticket-confirmation"></i>
                            <span data-key="t-horizontal">Daftar Tiket Helpdesk (Test)</span>
                        </a>
                    </li>

                    <li>
                        <a href="/report-test">
                            <i class="bx bxs-report"></i>
                            <span data-key="t-horizontal">Report (Test)</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks">Master Data</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/master/kategori" key="t-task-list">Kategori</a></li>
                            <li><a href="/master/sub-kategori" key="t-kanban-board">Sub Kategori</a></li>
                            <li><a href="/master/item-kategori" key="t-create-task">Item kategori</a></li>
                            <li><a href="/master/hari-libur" key="t-create-task">Hari Libur Nasional</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_id == 1)
                    <li class="menu-title" data-key="t-menu">Super Admin</li>

                    <li>
                        <a href="/sadmin/activity-history">
                            <i class="bx bx-time"></i>
                            <span data-key="t-horizontal">Activity History</span>
                        </a>
                    </li>
                @endif



                @if (Auth::user()->role_id == 1)
                    <li class="menu-title" data-key="t-apps">Apps Example</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="users"></i>
                            <span data-key="t-contacts">Contacts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="apps-contacts-list" data-key="t-user-list">User_List</a></li>
                            {{-- <li><a href="apps-contacts-profile" data-key="t-profile">Profile</a></li> --}}
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="trello"></i>
                            <span data-key="t-tasks">Tasks</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="tasks-list" key="t-task-list">Task_List</a></li>
                            <li><a href="tasks-kanban" key="t-kanban-board">Kanban_Board</a></li>
                            <li><a href="tasks-create" key="t-create-task">Create_Task</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-pages">Page Type</li>

                    <li>
                        <a href="layouts-horizontal">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">Horizontal</span>
                        </a>
                    </li>

                    <li class="menu-title mt-2" data-key="t-components">Components</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="briefcase"></i>
                            <span data-key="t-components">Bootstrap</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/ui-alerts" key="t-alerts">Alerts</a></li>
                            <li><a href="/ui-buttons" key="t-buttons">Buttons</a></li>
                            <li><a href="/ui-cards" key="t-cards">Cards</a></li>
                            <li><a href="/ui-carousel" key="t-carousel">Carousel</a></li>
                            <li><a href="/ui-dropdowns" key="t-dropdowns">Dropdowns</a></li>
                            <li><a href="/ui-grid" key="t-grid">Grid</a></li>
                            <li><a href="/ui-images" key="t-images">Images</a></li>
                            <li><a href="/ui-modals" key="t-modals">Modals</a></li>
                            <li><a href="/ui-offcanvas" key="t-offcanvas">Offcanvas</a></li>
                            <li><a href="/ui-progressbars" key="t-progress-bars">Progress_Bars</a></li>
                            <li><a href="/ui-placeholders" key="t-placeholders">Placeholders</a></li>
                            <li><a href="/ui-tabs-accordions" key="t-tabs-accordions">Tabs_&_Accordions</a></li>
                            <li><a href="/ui-typography" key="t-typography">Typography</a></li>
                            <li><a href="/ui-video" key="t-video">Video</a></li>
                            <li><a href="/ui-general" key="t-general">General</a></li>
                            <li><a href="/ui-colors" key="t-colors">Colors</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="gift"></i>
                            <span data-key="t-ui-elements">Extended</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/extended-lightbox" data-key="t-lightbox">Lightbox</a></li>
                            <li><a href="/extended-rangeslider" data-key="t-range-slider">Range_Slider</a></li>
                            <li><a href="/extended-sweet-alert" data-key="t-sweet-alert">Sweet_Alert 2</a></li>
                            <li><a href="/extended-session-timeout" data-key="t-session-timeout">Session_Timeout</a>
                            </li>
                            <li><a href="/extended-rating" data-key="t-rating">Rating</a></li>
                            <li><a href="/extended-notifications" data-key="t-notifications">Notifications</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="box"></i>
                            <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                            <span data-key="t-forms">Forms</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/form-elements" data-key="t-form-elements">Basic_Elements</a></li>
                            <li><a href="/form-validation" data-key="t-form-validation">Validation</a></li>
                            <li><a href="/form-advanced" data-key="t-form-advanced">Advanced_Plugins</a></li>
                            <li><a href="/form-editors" data-key="t-form-editors">Editors</a></li>
                            <li><a href="/form-uploads" data-key="t-form-upload">File_Upload</a></li>
                            <li><a href="/form-wizard" data-key="t-form-wizard">Wizard</a></li>
                            <li><a href="/form-mask" data-key="t-form-mask">Mask</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="sliders"></i>
                            <span data-key="t-tables">Tables</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/tables-basic" data-key="t-basic-tables">Bootstrap_Basic</a></li>
                            <li><a href="/tables-datatable" data-key="t-data-tables">Data_Tables</a></li>
                            <li><a href="/tables-responsive" data-key="t-responsive-table">Responsive</a></li>
                            <li><a href="/tables-editable" data-key="t-editable-table">Editable_Table</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="pie-chart"></i>
                            <span data-key="t-charts">Charts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/charts-apex" data-key="t-apex-charts">Apex_Charts</a></li>
                            <li><a href="/charts-echart" data-key="t-e-charts">E_Charts</a></li>
                            <li><a href="/charts-chartjs" data-key="t-chartjs-charts">Chartjs</a></li>
                            <li><a href="/charts-knob" data-key="t-knob-charts">Jquery_Knob</a></li>
                            <li><a href="/charts-sparkline" data-key="t-sparkline-charts">Sparkline</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="cpu"></i>
                            <span data-key="t-icons">Icons</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/icons-feather" data-key="t-feather">Feather</a></li>
                            <li><a href="/icons-boxicons" data-key="t-boxicons">Boxicons</a></li>
                            <li><a href="/icons-materialdesign" data-key="t-material-design">Material_Design</a></li>
                            <li><a href="/icons-dripicons" data-key="t-dripicons">Dripicons</a></li>
                            <li><a href="/icons-fontawesome" data-key="t-font-awesome">Font_awesome 5</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="map"></i>
                            <span data-key="t-maps">Maps</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/maps-google" data-key="t-g-maps">Google</a></li>
                            <li><a href="/maps-vector" data-key="t-v-maps">Vector</a></li>
                            <li><a href="/maps-leaflet" data-key="t-l-maps">Leaflet</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="share-2"></i>
                            <span data-key="t-multi-level">Multi_Level</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);" data-key="t-level-1-1">Level_1.1</a></li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Level_1.2</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" data-key="t-level-2-1">Level_2.1</a></li>
                                    <li><a href="javascript: void(0);" data-key="t-level-2-2">Level_2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
