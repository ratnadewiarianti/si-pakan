<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Custom CSS for Background Image -->
    <style>
        .content-wrapper {
            background-image: url('assets/images/back.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-2 px-4 px-sm-5">
                            <div class="brand-logo" style="display: flex; justify-content: center; align-items: center;">
                                <img src="assets/images/logo_sipakan.png" alt="logo" style="vertical-align: middle; margin-right: 10px; width: 100px; height: auto;">
                                <b style="font-size: 40px;">SI-PAKAN</b>
                            </div>

                            <!-- <h4>Halo, Selamat Datang Di Sistem Informasi Pelaporan Keuangan.</h4> -->
                            <h6 class="font-weight-light">Sign in untuk melanjutkan.</h6>
                            <form method="POST" action="<?= base_url('auth/login'); ?>" class="pt-3">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="tahun" class="form-control form-control-lg" name="tahun" required placeholder="Pilih Tahun">
                                    <div class="invalid-feedback">
                                        Pilih tahun terlebih dahulu
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <!-- <input type="checkbox" class="form-check-input">
                                            Keep me signed in -->
                                        </label>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        // Inisialisasi Bootstrap Datepicker
        $(document).ready(function() {
            $('#tahun').datepicker({
                format: "yyyy",
                startView: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
    <!-- endinject -->
</body>

</html>