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
                        <li class="breadcrumb-item"><a href="/rincianobjek">Rincian Objek</a></li>
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
                        <h4 class="card-title">Edit Data Rincian Objek</h4>
                        <form action="/rincianobjek/update/<?= $rincianobjek['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Kode Objek</label>
                                <select class="js-example-basic-single w-100 form-control" name="id_objek" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($objek as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?php if ($key['id'] == $rincianobjek['id_objek']) echo 'selected="selected"'; ?>><?= $key['uraian_objek']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode rincian objek</label>
                                <input type="text" name="kode_rincian_objek" class="form-control" value="<?= $rincianobjek['kode_rincian_objek']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian rincian objek</label>
                                <input type="text" name="uraian_rincian_objek" class="form-control" value="<?= $rincianobjek['uraian_rincian_objek']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/rincianobjek'); ?>" class="btn btn-danger">Batal</a>
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