<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row " style="margin-left: 20px;margin-right: 20px; padding: 100px 200px 200px 200px;">
                            <div class="col-md-4">
                                <div class="dropdown">
                                    <button class="btn btn-lg  btn-primary dropdown-toggle" type="button" id="dropdownSemester" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Semester
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownSemester">
                                        <li><a class="dropdown-item" href="#" data-value="semester_1">Semester 1</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="semester_2">Semester 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dropdown">
                                    <button class="btn btn-lg  btn-success dropdown-toggle" type="button" id="dropdownTriwulan" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Triwulan
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownTriwulan">
                                        <li><a class="dropdown-item" href="#" data-value="triwulan_1">Triwulan 1</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="triwulan_2">Triwulan 2</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="triwulan_3">Triwulan 3</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="triwulan_4">Triwulan 4</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dropdown">
                                    <button class="btn btn-lg  btn-danger dropdown-toggle" type="button" id="dropdownBulan" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Bulan
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownBulan">
                                        <li><a class="dropdown-item" href="#" data-value="januari">Januari</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="februari">Februari</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="maret">Maret</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="april">April</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="mei">Mei</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="juni">Juni</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="juli">Juli</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="agustus">Agustus</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="september">September</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="oktober">Oktober</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="november">November</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="desember">Desember</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?= $this->include('layout/footer') ?>
    <!-- partial -->
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function() {
        var firstSelectionMade = false;

        $('.dropdown-menu a.dropdown-item').click(function() {
            if (!firstSelectionMade) {
                firstSelectionMade = true;
                var value = $(this).data('value');
                var url = "<?= site_url('rakbelanja/index/') ?>" + value;
                window.location.href = url;
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection() ?>