<?php
include "dashboard/header.php";
?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="row mb-2">
                    <div class="col">
                        <?php

                        use App\Models\Masjid;

                        $dataMasjid = Masjid::find($id);
                        ?>
                        <h1>Masjid <?= $dataMasjid->nama ?></h1>
                    </div>
                    <div class="col-1 text-end">
                        <?php
                        if ($role->role_id === 1):
                            ?>
                            <a href="" class="btn btn-icon btn-rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                                    <path
                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                                </svg>
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>

                <div class="row mb-4">

                    <?php
                    if ($role->role_id === 5):
                        ?>
                        <div class="col mb-2">
                            <h5>Hubungi admin untuk mendapatkan hak akses !</h5>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($role->role_id === 1 || $role->role_id === 2):
                        ?>
                        <div class="col mb-2">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#keuanganInsert">
                                <strong>Keuangan</strong>
                            </button>
                            <?php include "dashboard/content/modal-keuangan.php"; ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($role->role_id === 1 || $role->role_id === 4):
                        ?>
                        <div class="col mb-2">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#zakatInsert">
                                <strong>Zakat</strong>
                            </button>
                            <?php include "dashboard/content/modal-zakat.php"; ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($role->role_id === 1 || $role->role_id === 3 || $role->role_id === 2):
                        ?>
                        <div class="col mb-2">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#jamaahInsert">
                                <strong>Jamaah</strong>
                            </button>
                            <?php include "dashboard/content/modal-jamaah.php"; ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($role->role_id === 1 || $role->role_id === 2):
                        ?>
                        <div class="col mb-2">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tabunganInsert">
                                <strong>Tabungan</strong>
                            </button>
                            <?php include "dashboard/content/modal-tabungan.php"; ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($role->role_id === 1 || $role->role_id === 3):
                        ?>
                        <div class="col mb-2">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#kegiatanInsert">
                                <strong>Kegiatan</strong>
                            </button>
                            <?php include "dashboard/content/modal-kegiatan.php"; ?>
                        </div>
                        <?php
                    endif;
                    ?>

                </div>

                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-five">
                        <div class="widget-content">
                            <div class="account-box">

                                <div class="info-box">
                                    <div class="icon">
                                        <span>
                                            <img src="../src/assets/img/money-bag.png" alt="money-bag">
                                        </span>
                                    </div>

                                    <div class="balance-info">
                                        <h6>Total Keuangan Masjid</h6>
                                        <p>Rp. <?= number_format($keuangan->jumlah ?? 0, 0, ',', '.') ?></p>
                                    </div>
                                </div>

                                <div class="card-bottom-section">
                                    <div><span class="badge badge-light-success"></span></div>
                                    <a href="javascript:void(0);" class="">View Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget widget-seven">
                        <div class="widget-heading">
                            <h6 class="">Statistik</h6>
                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu left" aria-labelledby="statistics"
                                        style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-chart">
                            <div class="w-chart-section t-visits">
                                <div class="w-chart-render-one">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bar-chart-2">
                                            <line x1="18" y1="20" x2="18" y2="10"></line>
                                            <line x1="12" y1="20" x2="12" y2="4"></line>
                                            <line x1="6" y1="20" x2="6" y2="14"></line>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-detail">
                                    <p class="w-title">Total Jamaah</p>
                                    <p class="w-stats"><?= $countJamaah ?></p>
                                </div>
                            </div>

                            <div class="w-chart-section p-visits">
                                <div class="w-chart-render-one">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-detail">
                                    <p class="w-title">Total Zakat</p>
                                    <p class="w-stats"><?= $totalZakat ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget widget-activity-five">

                        <div class="widget-heading">
                            <h5 class="">Kegiatan</h5>

                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="activitylog"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu left" aria-labelledby="activitylog"
                                        style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">

                            <div class="w-shadow-top"></div>

                            <div class="mt-container mx-auto" style="height: 100px;">
                                <div class="timeline-line">
                                    <?php
                                    foreach ($kegiatan as $k):
                                        ?>
                                        <div class="item-timeline timeline-new">
                                            <h3 class="bi bi-arrow-right-circle me-3"></h3>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5><?= $k->acara ?></h5>
                                                </div>
                                                <p><?= $k->waktu ?></p>
                                            </div>
                                            <?php
                                            if ($role->role_id === 1 || $role->role_id === 2):
                                                ?>
                                                <a href="/undangan?id=<?= $k->id ?>" target="_blank"
                                                    class="btn btn-primary btn-sm me-2">Cetak</a>
                                                <a href="/undangan/delete/<?= $k->id ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>

                        <div class="w-shadow-bottom"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <?php include "dashboard/content/data-keuangan.php"; ?>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <?php include "dashboard/content/data-jamaah-tabungan.php"; ?>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-activity-five">

                    <div class="widget-heading">
                        <h5 class="">Manage User Masjid</h5>
                    </div>

                    <div class="widget-content">

                        <div class="w-shadow-top"></div>

                        <div class="mt-container mx-auto">
                            <div class="timeline-line">
                                <?php
                                foreach ($manages as $manage):
                                    ?>
                                    <div class="item-timeline timeline-new">
                                        <!-- <i class="bi bi-arrow-return-right me-2"></i> -->
                                        <h3 class="bi bi-person-fill me-3"></h3>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5><?= $manage['user']->nama ?></h5>
                                            </div>
                                            <p><?= $manage['role']->nama ?></p>
                                        </div>
                                        <?php
                                        if ($role->role_id === 1):
                                            ?>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm me-2" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Akses
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="/hak-akses?id=<?= $manage['manage']->id ?>&role=1">Admin</a></li>
                                                    <li><a class="dropdown-item" href="/hak-akses?id=<?= $manage['manage']->id ?>&role=2">Bendahara</a></li>
                                                    <li><a class="dropdown-item" href="/hak-akses?id=<?= $manage['manage']->id ?>&role=3">Sekertaris</a></li>
                                                    <li><a class="dropdown-item" href="/hak-akses?id=<?= $manage['manage']->id ?>&role=4">Amil Zakat</a></li>
                                                </ul>
                                            </div>
                                            <a href=""><button class="btn btn-danger btn-sm">Hapus</button></a>
                                            <?php
                                        endif;
                                        ?>
                                    </div>

                                    <?php
                                endforeach;
                                ?>

                            </div>
                        </div>

                        <div class="w-shadow-bottom"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <?php include "dashboard/content/data-zakat.php"; ?>

            </div>

        </div>
    </div>

</div>


</div>
<!--  END CONTENT AREA  -->

<?php include "dashboard/footer.php"; ?>