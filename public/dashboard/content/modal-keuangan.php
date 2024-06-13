<!-- Modal -->
<div class="modal animated zoomInUp modal-lg" id="keuanganInsert" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keuangan</h5>
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
                <button id="addFormBtn" class="btn btn-primary mb-4">Tambah Form
                    Insert</button>

                <div id="toggleAccordion" class="accordion mb-3">
                    <div id="formContainer">
                        <!-- Initial form insert -->
                        <div class="card mb-3">
                            <div class="card-header" id="heading1">
                                <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#defaultAccordion1" aria-expanded="false"
                                        aria-controls="defaultAccordion1">
                                        <div class="row">
                                            <div class="col">
                                                Form Insert Data
                                            </div>
                                            <div class="col text-end">
                                                <span class="text-secondary">Detail</span>
                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn"><i
                                                        class="bi bi-trash3-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div id="defaultAccordion1" class="collapse" data-bs-parent="#toggleAccordion">
                                <div class="card-body">
                                    <form id="formKeuangan1">
                                        <div class="form-group mb-4">
                                            <label for="jenis_keuangan">Jenis<span class="text-danger">*</span></label>
                                            <select class="form-select form-control-sm" id="jenis_keuangan"
                                                name="jenis_keuangan" required>
                                                <option selected>Pilih salah satu
                                                </option>
                                                <option value="pemasukan">Pemasukan</option>
                                                <option value="pengeluaran">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="jumlah_keuangan">Jumlah<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm"
                                                id="jumlah_keuangan" name="jumlah_keuangan" placeholder="Jumlah"
                                                required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="tanggal_keuangan">Tanggal<span
                                                    class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control form-control-sm"
                                                id="tanggal_keuangan" name="tanggal_keuangan" placeholder="Tanggal"
                                                required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="keterangan_keuangan">Keterangan<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-sm" id="keterangan_keuangan"
                                                name="keterangan_keuangan" aria-label="With textarea"
                                                required></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="bukti_keuangan">Bukti</label>
                                            <div class="mb-3">
                                                <input class="form-control file-upload-input" type="file"
                                                    id="bukti_keuangan" name="bukti_keuangan">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="submitButton" class="btn btn-primary w-100">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    let formCount = 1;

    document.getElementById('addFormBtn').addEventListener('click', function () {
        formCount++;
        const formContainer = document.getElementById('formContainer');
        const newForm = document.createElement('div');
        newForm.classList.add('card', 'mb-3');
        newForm.innerHTML = `
                                            <div class="card-header" id="heading${formCount}">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#defaultAccordion${formCount}" aria-expanded="false" aria-controls="defaultAccordion${formCount}">
                                                        <div class="row">
                                                            <div class="col">
                                                                Form Insert Data
                                                            </div>
                                                            <div class="col text-end">
                                                                <span class="text-secondary">Detail</span>
                                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn"><i class="bi bi-trash3-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div id="defaultAccordion${formCount}" class="collapse" data-bs-parent="#toggleAccordion">
                                                <div class="card-body">
                                                    <form id="formKeuangan${formCount}">
                                                        <div class="form-group mb-4">
                                                            <label for="jenis_keuangan">Jenis<span class="text-danger">*</span></label>
                                                            <select class="form-select form-control-sm" id="jenis_keuangan"
                                                                name="jenis_keuangan" required>
                                                                <option selected>Pilih salah satu
                                                                </option>
                                                                <option value="pemasukan">Pemasukan</option>
                                                                <option value="pengeluaran">Pengeluaran</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="jumlah_keuangan">Jumlah<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control form-control-sm"
                                                                id="jumlah_keuangan" name="jumlah_keuangan" placeholder="Jumlah"
                                                                required>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="tanggal_keuangan">Tanggal<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="datetime-local" class="form-control form-control-sm"
                                                                id="tanggal_keuangan" name="tanggal_keuangan" placeholder="Tanggal"
                                                                required>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="keterangan_keuangan">Keterangan<span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control form-control-sm" id="keterangan_keuangan"
                                                                name="keterangan_keuangan" aria-label="With textarea"
                                                                required></textarea>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="bukti_keuangan">Bukti</label>
                                                            <div class="mb-3">
                                                                <input class="form-control file-upload-input" type="file"
                                                                    id="bukti_keuangan" name="bukti_keuangan">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        `;
        formContainer.appendChild(newForm);
        attachRemoveEvent(newForm);
    });

    function attachRemoveEvent(formElement) {
        const removeButton = formElement.querySelector('.remove-btn');
        removeButton.addEventListener('click', function () {
            formElement.remove();
        });
    }

    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function () {
            button.closest('.card').remove();
        });
    });
</script>

<script>
    document.getElementById('submitButton').addEventListener('click', function (event) {
        event.preventDefault();

        submitFormData();
    });

    function getIdMasjidFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
    }

    async function sendFormData(formData) {
        try {
            const response = await axios.post('/api/detail-keuangan', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    async function submitFormData() {
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`formKeuangan${i}`);
            const formData = new FormData(form);

            formData.append('masjid_id', getIdMasjidFromUrl());
            formData.append('jenis', formData.get('jenis_keuangan'));
            formData.append('jumlah', parseInt(formData.get('jumlah_keuangan')));
            formData.append('tanggal', formData.get('tanggal_keuangan'));
            formData.append('keterangan', formData.get('keterangan_keuangan'));
            formData.append('bukti', form.querySelector('#bukti_keuangan').files[0]);

            try {
                const responseData = await sendFormData(formData);
                if (responseData.success === true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil menyimpan data',
                    }).then(() => {
                        // refreshTableKeuangan();
                        window.location.href = `/masjid?id=${getIdMasjidFromUrl()}`
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
    }

</script>