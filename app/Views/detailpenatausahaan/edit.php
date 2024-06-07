<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Detail Penatausahaan</h4>
                        <form class="forms-sample"
                            action="/detailpenatausahaan/update/<?= $detailpenatausahaan['id']; ?>" method="post">

                            <input type="hidden" name="id_penatausahaan"
                                value="<?= $detailpenatausahaan['id_penatausahaan']; ?>" class="form-control" required>

                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->

                            <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control js-example-basic-single w-100" name="id_detail_dpa"
                                    required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpa as $key) : ?>
                                    <option value="<?= $key['id']; ?> "
                                        <?= ($key['id'] == $detailpenatausahaan['id_detail_dpa']) ? 'selected' : ''; ?>>
                                        <?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Untuk Pembayaran</label>
                                <input type="text" name="untuk_pembayaran" required class="form-control"
                                    value="<?= $detailpenatausahaan['untuk_pembayaran']; ?>">
                            </div>
                            
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="/detailpenatausahaan/show/<?= $detailpenatausahaan['id_penatausahaan']; ?>"
                                class="btn btn-danger">Batal</a>
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