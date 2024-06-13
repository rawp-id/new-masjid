<!-- Modal -->
<div class="modal animated zoomInUp modal-lg" id="zakatInsert" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zakat</h5>
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
                <form id="formZakat">
                    <div class="form-group mb-4">
                        <label for="nama_zakat">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nama_zakat" name="nama_zakat"
                            placeholder="Nama" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlah_zakat">Jumlah<span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm" id="jumlah_zakat" name="jumlah_zakat"
                            placeholder="Jumlah" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="alamat_zakat">Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" id="alamat_zakat" name="alamat_zakat"
                            aria-label="With textarea" required></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="rincian_zakat">Rincian</label>
                        <textarea class="form-control form-control-sm" id="rincian_zakat" name="rincian_zakat"
                            aria-label="With textarea" ></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_zakat">Keterangan</label>
                        <textarea class="form-control form-control-sm" id="keterangan_zakat" name="keterangan_zakat"
                            aria-label="With textarea" ></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tanggal_zakat">Tanggal<span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="tanggal_zakat" name="tanggal_zakat"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('formZakat').addEventListener('submit', function (event) {
        event.preventDefault();

        submitFormZakat();
    });

    async function sendFormZakat(formData) {
        try {
            const response = await axios.post('/api/zakat', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    function getIdMasjidFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
    }

    async function submitFormZakat() {
        const form = document.getElementById('formZakat');
        const formData = new FormData(form);

        formData.append('nama', formData.get('nama_zakat'));
        formData.append('jumlah', parseInt(formData.get('jumlah_zakat')));
        formData.append('alamat', formData.get('alamat_zakat'));
        formData.append('rincian', formData.get('rincian_zakat'));
        formData.append('keterangan', formData.get('keterangan_zakat'));
        formData.append('masjid_id', getIdMasjidFromUrl());
        formData.append('waktu', formData.get('tanggal_zakat'));
        formData.append('status', 'tidak sah');

        try {
            const responseData = await sendFormZakat(formData);
            console.log(responseData);
            if (responseData.success === true) {
                console.log(responseData)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menyimpan data',
                }).then(() => {
                    window.location.href = '/masjid?id=' + getIdMasjidFromUrl();
                    form.reset();
                });
            } else {
                throw new Error('Gagal menyimpan data');
            }
        } catch (error) {
            console.error('Gagal menyimpan data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal menyimpan data',
            });
        }
    }

</script>