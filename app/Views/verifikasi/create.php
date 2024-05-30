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
                        <li class="breadcrumb-item"><a href="/verifikasi">Verifikasi</a></li>
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
                        <h4 class="card-title">Tambah Data Verifikasi</h4>
                        <form action="/verifikasi/store/" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control js-example-basic-single w-100" name="id_detail_penatausahaan" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detailpenatausahaan as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['kode_urusan']; ?>.<?= $key['kode_bidang_urusan']; ?>.<?= $key['kode_program']; ?>.<?= $key['kode_kegiatan']; ?>.<?= $key['kode_subkegiatan']; ?> - <?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <!-- <td> $row['id_detail_penatausahaan']; ?></td> -->

                            <div class="form-group">
                                <label>Nomor BKU</label>
                                <input type="text" name="nomor_bku" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>Uraian</label>
                                <input type="text" name="uraian" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>Nilai SPJ</label>
                                <input type="text" name="nilai_spj" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>PPN</label>
                                <input type="number" name="ppn" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>PPH PSL 23</label>
                                <input type="number" name="pph_psl_23" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>PPH PSL 22</label>
                                <input type="number" name="pph_psl_22" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label>PPH PSL 21</label>
                                <input type="number" name="pph_psl_21" class="form-control"  required>
                            </div>

                            <div class="form-group">
                                <label>Pajak Daerah</label>
                                <input type="number" name="pajak_daerah" class="form-control"  required>
                            </div>

                            <div class="form-group">
                                <label>Diterima</label>
                                <input type="text" name="diterima" class="form-control"  required>
                            </div>

                            <div class="form-group">
                                <label>File SPJ</label> <br>
                                <label><small>Upload dalam Format PDF</small></label> <br>
                                <input type="file" name="file_spj" id="file_spj" class="form-control-file" accept=".pdf">
                            </div>

                            <div class="form-group">
                                <label>File Kwitansi</label> <br>
                                <label><small>Upload dalam Format PDF</small></label> <br>
                                <input type="file" name="file_kwitansi" id="file_kwitansi" class="form-control-file" accept=".pdf">
                            </div>
                            <input type="text" name="status_bendahara"  value="MENUNGGU" class="form-control"  hidden required>
                            <input type="text" name="status_kasubbag"  value="MENUNGGU" class="form-control"  hidden required>
                            <input type="text" name="status_pptik"  value="MENUNGGU" class="form-control"  hidden required>
                            <input type="text" name="status_verifikator_keuangan"  value="MENUNGGU" class="form-control"  hidden required>

                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/verifikasi'); ?>" class="btn btn-danger">Batal</a>
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