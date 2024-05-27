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
                        <li class="breadcrumb-item"><a href="/kelompok">kelompok</a></li>
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
                        <h4 class="card-title">Edit Data kelompok</h4>
                        <form action="/kelompok/update/<?= $kelompok['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Kode Akun</label>
                                <select class="form-control js-example-basic-single w-100" name="id_akun" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($akun as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?php if ($key['id'] == $kelompok['id_akun']) echo 'selected="selected"'; ?>><?= $key['uraian_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode kelompok</label>
                                <input type="text" name="kode_kelompok" class="form-control" value="<?= $kelompok['kode_kelompok']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian kelompok</label>
                                <input type="text" name="uraian_kelompok" class="form-control" value="<?= $kelompok['uraian_kelompok']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/kelompok'); ?>" class="btn btn-danger">Batal</a>
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