<div class="widget widget-seven">
    <div class="widget-heading">
        <h6>Data Zakat</h6>
        <div class="row">
            <?php
            if ($role->role_id === 1 || $role->role_id === 4):
                ?>
                <div class="col">
                    <button class="btn btn-primary" onclick="multiVerifikasi()">Verifikasi</button>
                </div>
                <div class="col">
                    <button class="btn btn-danger" onclick="multiDelete()">Delete</button>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr role="row">
                            <th>
                                <input class="form-check-input chk-parent" type="checkbox" id="chk-parent"
                                    onclick="toggleCheckboxes(this)">
                            </th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Alamat</th>
                            <th>Rincian</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataZakat as $zakat): ?>
                            <tr>
                                <td>
                                    <input class="form-check-input child-chk" type="checkbox" id="chk-<?= $zakat->id ?>"
                                        data-id="<?= $zakat->id ?>">
                                </td>
                                <td><?= $zakat->waktu ?></td>
                                <td><?= $zakat->nama ?></td>
                                <td><?= $zakat->jumlah ?></td>
                                <td><?= $zakat->alamat ?></td>
                                <td><?= $zakat->rincian ?></td>
                                <td><?= $zakat->keterangan ?></td>
                                <td class="<?= $zakat->status == 'sah' ? 'text-success' : 'text-danger' ?>">
                                    <?= $zakat->status ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCheckboxes(source) {
        var checkboxes = document.querySelectorAll('.child-chk');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = source.checked;
        });
    }

    function multiVerifikasi() {
        var checkboxes = document.querySelectorAll('.child-chk:checked');
        var ids = [];

        checkboxes.forEach(function (checkbox) {
            var id = checkbox.getAttribute('data-id');
            ids.push(id);
        });

        if (ids.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please select at least one item to verify.'
            });
            return;
        }

        // Confirm action
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to verify selected items?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, verify',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                ids.forEach(id => {
                    var data = {
                        status: 'sah'
                    };

                    axios.put(`/api/zakat/${id}`, data)
                        .then(response => {
                            console.log(`Verification successful for ID: ${id}`);
                            window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
                        })
                        .catch(error => {
                            console.error(`Error verifying ID ${id}:`, error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: `Failed to verify ID ${id}. Please try again later.`
                            });
                        });
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Verification initiated!',
                    text: 'Verification process initiated for selected items.'
                });
            }
        });
    }

    function multiDelete() {
        var checkboxes = document.querySelectorAll('.child-chk:checked');
        var ids = Array.from(checkboxes).map(checkbox => checkbox.dataset.id);

        if (ids.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please select at least one item to delete.'
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                ids.forEach(id => {
                    axios.delete(`/api/zakat/${id}`)
                        .then(response => {
                            console.log(`Item with ID ${id} deleted successfully.`);
                            window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
                        })
                        .catch(error => {
                            console.error(`Failed to delete item with ID ${id}:`, error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: `Failed to delete item with ID ${id}. Please try again later.`
                            });
                        });
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Selected items have been deleted.',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    }
</script>