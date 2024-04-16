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
                        <li class="breadcrumb-item"><a href="/objek">objek</a></li>
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
                        <h4 class="card-title">Edit Data Objek</h4>
                        <form action="/objek/update/<?= $objek['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Kode Jenis</label>
                                <select class="form-control" name="id_jenis" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($jenis as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?php if ($key['id'] == $objek['id_jenis']) echo 'selected="selected"'; ?>><?= $key['kode_jenis']; ?> - <?= $key['uraian_jenis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode objek</label>
                                <input type="text" name="kode_objek" class="form-control" value="<?= $objek['kode_objek']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian objek</label>
                                <input type="text" name="uraian_objek" class="form-control" value="<?= $objek['uraian_objek']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/objek'); ?>" class="btn btn-danger">Batal</a>
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