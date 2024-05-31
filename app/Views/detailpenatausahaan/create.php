<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Detail Penatausahaan</h4>
                        <form class="forms-sample" action="/detailpenatausahaan/store" method="post">

                            <input type="hidden" name="id_penatausahaan" value="<?= service('uri')->getSegment(3); ?>" class="form-control" required>

                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->

                            <!-- <div class="form-group">
                                <label>Nomor DPA</label>
                                <select class="form-control js-example-basic-single w-100" name="id_detail_dpa" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpa as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nomor_dpa']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control" name="id_detail_dpa" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpa as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['kode_urusan']; ?>.<?= $key['kode_bidang_urusan']; ?>.<?= $key['kode_program']; ?>.<?= $key['kode_kegiatan']; ?>.<?= $key['kode_subkegiatan']; ?> - <?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rekening</label>
                                <select class="form-control js-example-basic-single w-100" name="id_rekening" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($rekening as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['kode_rekening']; ?> - <?= $key['uraian_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nomor BK Umum</label>
                                <input type="text" name="no_bk_umum" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor BK Pembantu</label>
                                <input type="text" name="no_bk_pembantu" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Asli</label>
                                <input type="text" name="asli_123" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sudah Terima Dari</label>
                                <input type="text" name="sudah_terima_dari" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Uang Sebanyak</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="uang_sebanyak" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Untuk Pembayaran</label>
                                <input type="text" name="untuk_pembayaran" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pajak Daerah</label>
                                <input type="text" name="pajak_daerah" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>PPH</label>
                                <input type="text" name="pph21" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Terbilang</label>
                                <input type="number" name="terbilang" required class="form-control">
                            </div>
                            <input type="text" name="status_verifikasi"  value="MENUNGGU" class="form-control"  hidden required>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="/detailpenatausahaan/show/<?= service('uri')->getSegment(3); ?>" class="btn btn-danger">Batal</a>
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