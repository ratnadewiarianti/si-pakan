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
                        <li class="breadcrumb-item"><a href="/bp_kas_tunai">Buku Pembantu Kas Tunai</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Buku Pembantu Kas Tunai</h4>
                        <form action="/bp_kas_tunai/store/" method="post">
                        <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control js-example-basic-single w-100" name="id_subkegiatan" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($subkegiatan as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['kode_subkegiatan1']; ?> - <?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rekening</label>
                                <select class="form-control js-example-basic-single w-100" name="id_sub_rincian_objek" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($rekening as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['kode_rekening']; ?> - <?= $key['uraian_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor Bukti</label>
                                <input type="text" name="no_bukti" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Uraian</label>
                                <input type="text" name="uraian" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Penerimaan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="penerimaan" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pengeluaran</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="pengeluaran" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Saldo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="saldo" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Periode Ini</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="jumlah_periode_ini" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Periode Lalu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="jumlah_periode_lalu" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Semua Periode Sampai Periode Ini</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="jumlah_semua_periode" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sisa Kas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="sisa_kas" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kas Bendahara</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="kas_bendahara" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kepala Dinas Perpustakaan dan Kearsipan</label>
                                <select class="form-control js-example-basic-single w-100" name="kepala_dinas" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($karyawan as $key) : ?>
                                        <option value="<?= $key['nip']; ?>"><?= $key['nip']; ?> - <?= $key['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bendahara Pengeluaran</label>
                                <select class="form-control js-example-basic-single w-100" name="bendahara_pengeluaran" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($karyawan as $key) : ?>
                                        <option value="<?= $key['nip']; ?>"><?= $key['nip']; ?> - <?= $key['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/bp_kas_tunai'); ?>" class="btn btn-danger">Batal</a>
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