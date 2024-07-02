<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Detail Penatausahaan (Anggota)</h4>
                        <form class="forms-sample" action="/detailpenatausahaan/update2/<?= $detail2['id']; ?>" method="post">

                            <input type="hidden" name="id_detail_penatausahaan" value="<?= $detail2['id_detail_penatausahaan']; ?>" class="form-control" required>

                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->

                            <div class="form-group">
                                <label>Anggota</label>
                                <select class="form-control js-example-basic-single w-100" name="id_karyawan" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($karyawan as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?= ($key['id'] == $detail2['id_karyawan']) ? 'selected' : ''; ?>><?= $key['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="/keterangan/show/<?= $detail2['id_detail_penatausahaan']; ?>"
                            class="btn btn-danger">Batal</a>
                            <!-- <a href="/keterangan/show/<?= service('uri')->getSegment(3); ?>" class="btn btn-danger">Batal</a> -->
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