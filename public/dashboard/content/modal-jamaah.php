<!-- Modal -->
<div class="modal animated zoomInUp modal-lg" id="jamaahInsert" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jamaah</h5>
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
                <form id="formJamaah" >
                    <div class="form-group mb-4">
                        <label for="nama_jamaah">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nama_jamaah" name="nama_jamaah" placeholder="Nama"
                            required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="alamat_jamaah">Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" id="alamat_jamaah" name="alamat_jamaah" aria-label="With textarea"
                            required></textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="jenis_kelamin_jamaah">Jenis Kelamin<span class="text-danger">*</span></label>
                        <select class="form-select form-control-sm" id="jenis_kelamin_jamaah" name="jenis_kelamin_jamaah" required>
                            <option selected>Pilih salah satu
                            </option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('formJamaah').addEventListener('submit', function (event) {
        event.preventDefault();

        submitFormJamaah();
    });

    async function sendFormJamaah(formData) {
        try {
            const response = await axios.post('/api/jamaah', formData, {
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

    async function submitFormJamaah() {
        const form = document.getElementById('formJamaah');
        const formData = new FormData(form);

        formData.append('nama', formData.get('nama_jamaah'));
        formData.append('alamat', formData.get('alamat_jamaah'));
        formData.append('jenis_kelamin', formData.get('jenis_kelamin_jamaah'));
        formData.append('masjid_id', getIdMasjidFromUrl());

        // console.log(formData);
        // console.log(formData.get('nama_jamaah') );

        try {
            const responseData = await sendFormJamaah(formData);
            // console.log(responseData);
            if (responseData.success === true) {
                // console.log(responseData)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menyimpan data',
                }).then(() => {
                    window.location.href = `/masjid?id=${getIdMasjidFromUrl()}`
                    // form.reset();
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