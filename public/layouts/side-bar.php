<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="/home">
                        <img src="../mosque.png" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="/home" class="nav-link"> Masjid-In </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="/home" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled show" id="dashboard" data-bs-parent="#accordionExample">
                    <?php

                    use App\Models\ManageMasjid;
                    use App\Models\Masjid;
                    use Core\Auth;

                    // Ambil daftar masjid yang diatur oleh pengguna yang sedang terotentikasi
                    $manageMasjids = ManageMasjid::where('user_id', '=', Auth::id());

                    foreach ($manageMasjids as $manageMasjid):
                        // Ambil informasi masjid menggunakan id masjid yang diatur
                        $masjid = Masjid::find($manageMasjid->masjid_id);
                        ?>
                        <li class="">
                            <a href="/masjid?id=<?= $masjid->id ?>"> <?= $masjid->nama ?> </a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </li>

            <li class="menu">
                <a href="/pendaftaran-masjid" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        <span>Pendaftaran Masjid</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="/manage-masjid" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Tambahkan Manage</span>
                    </div>
                </a>
            </li>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var currentLocation = window.location.href;

                    var navLinks = document.querySelectorAll('.menu a');

                    navLinks.forEach(function (navLink) {
                        if (navLink.href === currentLocation) {
                            navLink.parentElement.classList.add('active'); // Add 'active' class to the parent <li>
                        }
                    });
                });
            </script>

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->