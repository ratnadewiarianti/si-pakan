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
                        <li class="breadcrumb-item"><a href="/bp_simpanan_bank"> Buku Pembantu Kas Tunai</a></li>
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
                        <h4 class="card-title">Edit Data Buku Pembantu Kas Tunai</h4>
                        <form action="/bp_simpanan_bank/update/<?= $bp_simpanan_bank['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Periode</label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="date" name="tgl_mulai" value="<?= $bp_simpanan_bank['tgl_mulai']; ?>" required class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="tgl_selesai" value="<?= $bp_simpanan_bank['tgl_selesai']; ?>"required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="<?= $bp_simpanan_bank['tanggal']; ?>" required
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Kepala Dinas Perpustakaan dan Kearsipan</label>
                                <select class="form-control js-example-basic-single w-100" name="kepala_dinas" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($karyawan as $key) : ?>
                                    <option value="<?= $key['nip']; ?>"
                                        <?php if ($key['nip'] == $bp_simpanan_bank['kepala_dinas']) echo 'selected="selected"'; ?>>
                                        <?= $key['nip']; ?> - <?= $key['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bendahara Pengeluaran</label>
                                <select class="form-control js-example-basic-single w-100" name="bendahara_pengeluaran"
                                    required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($karyawan as $key) : ?>
                                    <option value="<?= $key['nip']; ?>"
                                        <?php if ($key['nip'] == $bp_simpanan_bank['bendahara_pengeluaran']) echo 'selected="selected"'; ?>>
                                        <?= $key['nip']; ?> - <?= $key['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/bp_simpanan_bank'); ?>" class="btn btn-danger">Batal</a>
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