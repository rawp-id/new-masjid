<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Masjid-In </title>
    <link rel="icon" type="image/x-icon" href="mosque.png" />
    <link href="../layouts/collapsible-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="../layouts/collapsible-menu/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="../src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />

    <link href="../src/plugins/src/autocomplete/css/autoComplete.02.css" rel="stylesheet" type="text/css" />

    <link href="../src/plugins/css/light/autocomplete/css/custom-autoComplete.css" rel="stylesheet" type="text/css" />
    <link href="../src/plugins/css/dark/autocomplete/css/custom-autoComplete.css" rel="stylesheet" type="text/css" />

    <link href="../src/assets/css/light/pages/knowledge_base.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/pages/knowledge_base.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="layout-boxed alt-menu">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>

            <div class="search-animated toggle-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <!-- <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search..."> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x search-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
                <!-- <span class="badge badge-secondary">Ctrl + /</span> -->
            </div>

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-moon dark-mode">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-sun light-mode">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/login" class="btn btn-primary">Login</a>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container  sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="./index.html">
                                <img src="mosque.png" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="./index.html" class="nav-link"> Masjid-In </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                        </div>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu active">
                    </li>
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="fq-header-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 align-self-center order-md-0 order-1">
                                <div class="faq-header-content">
                                    <h1 class="mb-4">Masjid-In</h1>
                                    <div class="row">
                                        <div class="col-lg-5 mx-auto">
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-0">Manage semua masjid kamu dengan 1 aplikasi
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq container">

                    <div class="faq-layouting layout-spacing">

                        <div class="kb-widget-section">

                            <div class="row justify-content-center">

                                <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-icon mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-airplay">
                                                    <path
                                                        d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1">
                                                    </path>
                                                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                                </svg>
                                            </div>
                                            <h5 class="card-title mb-0">Umum</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-icon mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-user">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <h5 class="card-title mb-0">Dukungan Cepat</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-icon mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-package">
                                                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg>
                                            </div>
                                            <h5 class="card-title mb-0">Gratis Update</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-icon mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                            <h5 class="card-title mb-0">Harga Murah</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="fq-tab-section">
                            <div class="row">
                                <div class="col-md-12">

                                    <h2 class="text-center">Tentang Kami</h2>

                                    <div class="d-block text-center">
                                        <p class="">Selamat datang di Masjid-In, sebuah aplikasi berbasis web yang
                                            dibangun untuk memfasilitasi masyarakat dalam mencari informasi mengenai
                                            masjid-masjid di sekitar mereka. Kami berkomitmen untuk memberikan data yang
                                            akurat, lengkap, dan terkini mengenai lokasi, jadwal sholat, kegiatan, serta
                                            layanan yang tersedia di berbagai masjid. Dengan platform ini, kami berharap
                                            dapat mempermudah umat Muslim dalam menjalankan ibadah dan menjalin
                                            silaturahmi dengan sesama. Terima kasih atas kunjungan Anda, dan semoga
                                            Masjid-In dapat menjadi sahabat yang bermanfaat dalam perjalanan spiritual
                                            Anda. Wassalamu'alaikum warahmatullahi wabarakatuh.</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="fq-article-section mt-5 text-center">

                            <h2>Tim Kami</h2>

                            <div class="row">
                                <div class="col"></div>
                                <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                                    <div class="card style-2 mb-md-0 mb-4">
                                        <img src="./fotoku.jpeg" class="card-img-top" alt="...">
                                        <div class="card-body px-0 pb-0">
                                            <h5 class="card-title mb-3"></h5>
                                            <div class="media mt-4 mb-0 pt-1">
                                                <img src="./fotoku.jpeg" class="card-media-image me-3" alt="">
                                                <div class="media-body">
                                                    <h4 class="media-heading mb-1">Rifky Aryo</h4>
                                                    <p class="media-text">Developer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2024</span> Masjid-In , All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded by RAWP</p>
                </div>
            </div>
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="../src/plugins/src/waves/waves.min.js"></script>
    <script src="../layouts/collapsible-menu/app.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="../src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="../src/assets/js/dashboard/dash_1.js"></script>
    <script src="../src/plugins/src/autocomplete/autoComplete.min.js"></script>
    <script src="../src/assets/js/pages/knowledge-base.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>