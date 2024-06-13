<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignUp | Masjid-In </title>
    <link rel="icon" type="image/x-icon" href="mosque.png" />
    <link href="../layouts/collapsible-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="../layouts/collapsible-menu/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="../layouts/collapsible-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/light/authentication/auth-cover.css" rel="stylesheet" type="text/css" />

    <link href="../layouts/collapsible-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/authentication/auth-cover.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../src/plugins/src/sweetalerts2/sweetalerts2.css">

    <link href="../src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />

    <link href="../src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div
                    class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>

                    <div class="auth-cover">

                        <div class="position-relative">

                            <a href="/"><img src="mosque.png" alt="auth-img"
                                    style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5), 0 6px 20px rgba(0, 0, 0, 0.5); border-radius: 50px;"></a>

                            <h2 class="mt-5 text-white font-weight-bolder px-2">Gabung bersama kami</h2>
                            <p class="text-white px-2">Untuk manage masjid anda dengan mudah.</p>
                        </div>

                    </div>

                </div>

                <div
                    class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>Sign Up</h2>
                                    <p>Masukkan email dan kata sandi Anda untuk mendaftar</p>

                                </div>

                                <form id="registrationForm">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" class="form-control add-billing-address-input"
                                                name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox"
                                                    id="form-check-default" required>
                                                <label class="form-check-label" for="form-check-default">
                                                    Saya setuju Dengan <a href="https://policies.google.com/privacy"
                                                        class="text-primary">Syarat dan Kondisi</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100" name="submit">SIGN
                                                UP</button>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                    // const axios = require('axios');
                                    document.getElementById('registrationForm').addEventListener('submit', async function (event) {
                                        event.preventDefault();

                                        const formData = new FormData(this);
                                        formData.append('nama', formData.get('nama'));
                                        formData.append('email', formData.get('email'));
                                        formData.append('password', formData.get('password'));

                                        try {
                                            const response = await axios.post('/api/register', formData, {
                                                headers: {
                                                    'Content-Type': 'multipart/form-data'
                                                }
                                            });
                                            console.log(response.data);
                                            // Handle response data as needed

                                            // Tampilkan SweetAlert sukses
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Registrasi Berhasil!',
                                                text: 'Anda telah berhasil mendaftar.',
                                                showConfirmButton: true,
                                                timer: 2000, // Durasi tampilan alert
                                                onClose: () => {
                                                    window.location.href = '/login';
                                                }
                                            }).then(() => {
                                                window.location.href = '/login';
                                            });

                                        } catch (error) {
                                            console.error(error);
                                            // Handle error

                                            // Tampilkan SweetAlert error
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Registrasi Gagal!',
                                                text: 'Terjadi kesalahan saat melakukan registrasi.',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    });
                                </script>


                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Sudah punya akun ? <a href="/login" class="text-warning">Sign
                                                in</a></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="../src/assets/js/scrollspyNav.js"></script>
    <script src="../src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
    <script src="../src/plugins/src/sweetalerts2/custom-sweetalert.js"></script>

</body>

</html>