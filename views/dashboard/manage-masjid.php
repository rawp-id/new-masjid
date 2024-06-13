<?php

use Core\Auth;

$user_id = Auth::id();


include "dashboard/header.php"; ?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="row mb-2">
                    <div class="col text-center">
                        <h1>Manage Masjid</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="container">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambahkan menu manage masjid</h5>
                                </div>
                                <div class="card-body">
                                    <form id="manageForm">
                                        <h6>Masukan Kode Masjid</h6>
                                        <div class="form-group mb-4">
                                            <!-- <label for="kode_ms">Kode MS<span class="text-danger">*</span></label> -->
                                            <input type="text" class="form-control form-control-sm" id="kode_ms"
                                                name="kode_ms" placeholder="Kode MS" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Tambahkan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>


                <script>
                    function getIdMasjidFromUrl() {
                        const urlParams = new URLSearchParams(window.location.search);
                        return urlParams.get('id');
                    }
                    document.getElementById('manageForm').addEventListener('submit', async function (event) {
                        event.preventDefault();

                        const form = document.getElementById('manageForm');
                        const formData = new FormData(form);

                        formData.append('user_id', <?= $user_id ?>);
                        formData.append('masjid_id', getIdMasjidFromUrl());
                        formData.append('role_id', 5);
                        formData.append('kode_ms', formData.get('kode_ms'));

                        try {
                            const response = await axios.post('/api/manage-masjid', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            });
                            console.log(response.data)
                            if (response.data.success === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil menyimpan data',
                                }).then(() => {
                                    window.location.href = `/masjid?id=${getIdMasjidFromUrl()}`;
                                    // form.reset();
                                });
                            } else {
                                throw new Error('Gagal menyimpan data');
                            }
                        } catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal menyimpan data',
                            });
                        }
                    });
                </script>

            </div>
        </div>

    </div>


</div>
<!--  END CONTENT AREA  -->

<?php include "dashboard/footer.php"; ?>