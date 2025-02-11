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
                        <li class="breadcrumb-item"><a href="/pajak">Pajak</a></li>
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
                        <h4 class="card-title">Edit Data Pajak</h4>
                        <form action="/pajak/update/<?= $pajak['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Nama Pajak</label>
                                <input type="text" name="nama_pajak" class="form-control"
                                    value="<?= $pajak['nama_pajak']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Pajak</label>
                                <select class="form-control" name="jenis_pajak" required>
                                    <option <?php if($pajak['jenis_pajak']=='Daerah') {echo "selected";}?> value="Daerah">Daerah</option>
                                    <option <?php if($pajak['jenis_pajak']=='Negara') {echo "selected";}?> value="Negara">Negara</option>
                                  </select> </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/pajak'); ?>" class="btn btn-danger">Batal</a>
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