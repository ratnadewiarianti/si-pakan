<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <!-- breadcrumb -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 ">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Master</a></li>
                        <li class="breadcrumb-item"><a href="/jenis">jenis</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Jenis</h4>
                        <form action="/jenis/update/<?= $jenis['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Kode Kelompok</label>
                                <select class="form-control" name="id_kelompok" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($kelompok as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?php if ($key['id'] == $jenis['id_kelompok']) echo 'selected="selected"'; ?>><?= $key['kode_kelompok']; ?> - <?= $key['uraian_kelompok']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode jenis</label>
                                <input type="text" name="kode_jenis" class="form-control" value="<?= $jenis['kode_jenis']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian jenis</label>
                                <input type="text" name="uraian_jenis" class="form-control" value="<?= $jenis['uraian_jenis']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/jenis'); ?>" class="btn btn-danger">Batal</a>
                        </form>
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

<?= $this->section('styles') ?>
<!-- link ref -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!--  script src -->
<?= $this->endSection() ?>