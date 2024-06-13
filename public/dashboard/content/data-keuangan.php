<div class="widget widget-chart-three">
    <div class="widget-heading">
        <div class="">
            <h5 class="">Detail Keuangan</h5>
        </div>

        <div class="task-action">
            <div class="dropdown ">
                <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-more-horizontal">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg>
                </a>

                <div class="dropdown-menu left" aria-labelledby="uniqueVisitors">
                    <a class="dropdown-item" href="javascript:void(0);">View</a>
                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                </div>
            </div>
        </div>
    </div>

    <div class="widget-content widget-content-area">
        <!-- <div id="uniqueVisits"></div> -->
        <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table id="html5-extension" class="table dt-table-hover dataTable no-footer" style="width: 100%;"
                    role="grid" aria-describedby="html5-extension_info">
                    <thead>
                        <tr role="row">
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // echo (json_encode($detailKeuangan));
                        foreach ($detailKeuangan as $detail):
                            ?>
                            <tr role="row">
                                <td><?= $detail->jenis; ?></td>
                                <td><?= $detail->jumlah; ?></td>
                                <td><?= $detail->tanggal; ?></td>
                                <td><?= $detail->keterangan; ?></td>
                                <td>
                                    <a href="<?= './uploads/' . $detail->bukti; ?>" target="_blank">
                                        <?php if ($detail->bukti): ?>
                                            <img src="<?= './uploads/' . $detail->bukti; ?>" alt="<?= $detail->bukti; ?>"
                                                width="50">
                                        <?php else: ?>
                                            <p>Gambar tidak tersedia</p>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    if ($role->role_id === 1 || $role->role_id === 2):
                                        ?>
                                        <button class="btn btn-primary btn-sm me-2" onclick="showUpdateForm(
                                                <?= $detail->id ?>,
                                                '<?= $detail->jenis ?>',
                                                <?= $detail->jumlah ?>,
                                                '<?= $detail->tanggal ?>',
                                                '<?= $detail->keterangan ?>'
                                            );">Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmAndDelete(<?= $detail->id ?>)">Hapus</button>
                                        <?php
                                    endif;
                                    ?>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>

                <script>

                    function showUpdateForm(id, jenis, jumlah, tanggal, keterangan) {
                        Swal.fire({
                            title: 'Update Detail Keuangan',
                            html: `
            <form id="updateForm">
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" class="form-control" id="jenis" value="${jenis}">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" value="${jumlah}">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="datetime-local" class="form-control" id="tanggal" value="${tanggal}">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" value="${keterangan}">
                </div>
                <div class="form-group">
                    <label for="bukti">Bukti</label>
                    <input type="file" class="form-control" id="bukti">
                </div>
            </form>
        `,
                            showCancelButton: true,
                            confirmButtonText: 'Update',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true,
                            preConfirm: () => {
                                const jenis = Swal.getPopup().querySelector('#jenis').value;
                                const jumlah = Swal.getPopup().querySelector('#jumlah').value;
                                const tanggal = Swal.getPopup().querySelector('#tanggal').value;
                                const keterangan = Swal.getPopup().querySelector('#keterangan').value;
                                const bukti = Swal.getPopup().querySelector('#bukti').files[0];

                                updateDetailKeuangan(id, jenis, jumlah, tanggal, keterangan, bukti);
                            }
                        });
                    }

                    function confirmAndDelete(id) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda tidak akan dapat mengembalikan ini!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                deleteDetailKeuangan(id);
                            }
                        });
                    }

                    function updateDetailKeuangan(id, jenis, jumlah, tanggal, keterangan, bukti) {
                        console.log(id, jenis, jumlah, tanggal, keterangan, bukti);

                        var formData = new FormData();
                        formData.append('id', id);
                        formData.append('jenis', jenis);
                        formData.append('jumlah', jumlah);
                        formData.append('tanggal', tanggal);
                        formData.append('keterangan', keterangan);

                        if (bukti) {
                            formData.append('bukti', bukti);
                        }

                        // var data = {
                        //     id: id,
                        //     jenis: jenis,
                        //     jumlah: parseInt(jumlah),
                        //     tanggal: tanggal,
                        //     keterangan: keterangan,
                        //     bukti: bukti
                        // };

                        // console.log(data);

                        axios.post(`/api/detail-keuangan/${id}`, formData)
                            .then(response => {
                                console.log(response.data);
                                Swal.fire(
                                    'Sukses!',
                                    'Detail keuangan telah diupdate.',
                                    'success'
                                );
                                window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
                                // refreshTableKeuangan();
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'Gagal melakukan update detail keuangan.',
                                    'error'
                                );
                            });
                    }

                    function deleteDetailKeuangan(id) {
                        axios.delete(`/api/detail-keuangan/${id}`)
                            .then(response => {
                                // console.log(response);
                                Swal.fire(
                                    'Sukses!',
                                    'Detail keuangan telah dihapus.',
                                    'success'
                                );
                                window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
                                // refreshTableKeuangan();
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'Gagal menghapus detail keuangan.',
                                    'error'
                                );
                            });
                    }
                </script>

            </div>
        </div>
    </div>
</div>