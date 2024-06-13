<div class="widget widget-activity-five">

    <div class="widget-heading">
        <h5 class="">Jamaah & Tabungan</h5>

        <div class="task-action">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="activitylog" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-more-horizontal">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg>
                </a>

                <div class="dropdown-menu left" aria-labelledby="activitylog" style="will-change: transform;">
                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                    <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                </div>
            </div>
        </div>
    </div>

    <div class="widget-content">

        <div class="w-shadow-top"></div>

        <div class="mt-container mx-auto">
            <div class="timeline-line">

                <?php
                foreach ($dataJamaah as $jamaah):
                    ?>
                    <div class="item-timeline timeline-new">
                        <!-- <i class="bi bi-arrow-return-right me-2"></i> -->
                        <h3 class="bi bi-person-fill me-3"></h3>
                        <div class="t-content">
                            <div class="t-uppercontent">
                                <h5><?= $jamaah['jamaah']->nama ?></h5>
                            </div>
                            <p><?= $jamaah['tabungan'] ?></p>
                        </div>

                        <?php
                        if ($role->role_id === 1 || $role->role_id === 2 || $role->role_id === 3):
                            ?>
                            <!-- <div class="dropdown"> -->
                            <a>
                                <button class="btn btn-primary btn-sm me-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#detailTabungan<?= $jamaah['jamaah']->id ?>">
                                    Detail
                                </button>
                            </a>
                            <!-- <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Tabungan</a></li>
                                    <li><a class="dropdown-item" href="#">Edit Data Jamaah</a></li>
                                </ul>
                            </div> -->
                            <a href="/jamaah/delete?id=<?= $jamaah['jamaah']->id ?>"><button
                                    class="btn btn-danger btn-sm">Hapus</button></a>
                            <?php
                        endif;
                        ?>

                        <!-- Modal -->
                        <div class="modal animated zoomInUp modal-lg" id="detailTabungan<?= $jamaah['jamaah']->id ?>"
                            data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Tabungan & Jamaah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card container">
                                            <form action="/jamaah/update/<?= $jamaah['jamaah']->id ?>" method="post" class="mt-3 mb-3">
                                                <div class="form-group mb-4">
                                                    <label for="nama_jamaah">Nama<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" id="nama_jamaah"
                                                        name="nama_jamaah" value="<?= $jamaah['jamaah']->nama ?>"
                                                        placeholder="Nama" required>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="alamat_jamaah">Alamat<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control form-control-sm" id="alamat_jamaah"
                                                        name="alamat_jamaah" aria-label="With textarea"
                                                        required><?= $jamaah['jamaah']->alamat ?></textarea>
                                                </div>
                                                <div class="form-group mb-5">
                                                    <label for="jenis_kelamin_jamaah">Jenis Kelamin<span
                                                            class="text-danger">*</span></label>
                                                    <?php
                                                    $jenis_kelamin_options = ['Laki-laki', 'Perempuan'];
                                                    ?>

                                                    <select class="form-select form-control-sm" id="jenis_kelamin_jamaah"
                                                        name="jenis_kelamin_jamaah" required>
                                                        <option value="">Pilih salah satu</option>
                                                        <?php foreach ($jenis_kelamin_options as $option): ?>
                                                            <option value="<?= $option ?>"
                                                                <?= $jamaah['jamaah']->jenis_kelamin == $option ? 'selected' : '' ?>>
                                                                <?= $option ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary w-100">Simpan</button>
                                            </form>
                                        </div>


                                        <table class="table mt-5">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jamaah['dataTabungan'] as $tabungan):
                                                    ?>
                                                    <tr>
                                                        <td><?= $tabungan->tanggal ?></td>
                                                        <td><?= $tabungan->jumlah ?></td>
                                                        <td><?= $tabungan->keterangan ?></td>
                                                        <td>
                                                            <a href="/tabungan/delete?id=<?= $tabungan->id ?>&masjid_id=<?= $_GET['id'] ?>"
                                                                class="btn btn-danger btn-sm">Hapus</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <?php
                endforeach;
                ?>

            </div>
        </div>

        <div class="w-shadow-bottom"></div>
    </div>
</div>