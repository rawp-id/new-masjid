<!-- Modal -->
<div class="modal animated zoomInUp modal-lg" id="kegiatanInsert" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="formKegiatan">
                    <div class="form-group mb-4">
                        <label for="nama_acara">Acara<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="nama_acara" placeholder="Acara"
                            required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tanggal_acara">Tanggal<span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control form-control-sm" name="tanggal_acara"
                            placeholder="Tanggal" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="keterangan_acara">Keterangan<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="keterangan_acara"
                            aria-label="With textarea" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('formKegiatan').addEventListener('submit', async function (event) {
        event.preventDefault();

        const form = document.getElementById('formKegiatan');
        const formData = new FormData(form);

        formData.append('acara', formData.get('nama_acara'));
        formData.append('waktu', formData.get('tanggal_acara'));
        formData.append('keterangan', formData.get('keterangan_acara'));
        formData.append('masjid_id', getIdMasjidFromUrl());

        try {
            const response = await axios.post('/api/kegiatan', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            console.log(response.data);
            if (response.data.success === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menyimpan data',
                }).then(() => {
                    window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
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