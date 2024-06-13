<?php include "dashboard/header.php"; ?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="row mb-2">
                    <div class="col">
                        <h1>Form Pendaftaran Masjid</h1>
                    </div>
                </div>

                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h3>Buat Management Masjid Anda</h3>
                        </div>
                        <div class="card-body">
                            <form id="formMasjid">
                                <div class="form-group mb-4">
                                    <label for="nama_masjid">Nama<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="nama_masjid"
                                        name="nama_masjid" placeholder="Nama" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="alamat_masjid">Alamat<span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-sm" id="alamat_masjid"
                                        name="alamat_masjid" aria-label="With textarea" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="keterangan_masjid">Keterangan<span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-sm" id="keterangan_masjid"
                                        name="keterangan_masjid" aria-label="With textarea" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="kode_ms">Kode MS<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="kode_ms" name="kode_ms"
                                        placeholder="Kode MS" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('formMasjid').addEventListener('submit', async function (event) {
                        event.preventDefault();

                        const form = document.getElementById('formMasjid');
                        const formData = new FormData(form);

                        formData.append('nama', formData.get('nama_masjid'));
                        formData.append('alamat', formData.get('alamat_masjid'));
                        formData.append('keterangan', formData.get('keterangan_masjid'));
                        formData.append('kode_ms', formData.get('kode_ms'));

                        try {
                            const response = await axios.post('/api/masjid', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            });
                            if (response.data.success === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil menyimpan data',
                                }).then(() => {
                                    window.location.href = `/masjid?id=${response.data.data.id}`;
                                    form.reset();
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