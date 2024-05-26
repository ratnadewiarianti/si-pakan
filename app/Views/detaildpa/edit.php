<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Detail DPA</h4> <!-- Mengubah judul -->
                        <!-- <form class="forms-sample" action="/detaildpa/update <?= $detaildpa['id']; ?>" method="post"> Mengubah action -->
                        <form class="forms-sample" action="/detaildpa/update/<?= $detaildpa['id']; ?>" method="post">
                            <input type="hidden" name="_method" value="PUT"> <!-- Menyertakan _method untuk PUT -->
                            <!-- <input type="hidden" name="id" value="<?= $detaildpa['id']; ?>" class="form-control" required> -->
                            <input type="hidden" name="id_dpa" value="<?= $detaildpa['id_dpa']; ?>" class="form-control" required>

                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->

                            <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control" name="id_subkegiatan" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($subkegiatan as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?= ($key['id'] == $detaildpa['id_subkegiatan']) ? 'selected' : ''; ?>><?= $key['kode_subkegiatan1']; ?> - <?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rekening</label>
                                <select class="form-control" name="id_rekening" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($rekening as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?= ($key['id'] == $detaildpa['id_rekening']) ? 'selected' : ''; ?>><?= $key['kode_rekening']; ?> - <?= $key['uraian_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="/detaildpa/show/<?= $detaildpa['id_dpa']; ?>" class="btn btn-danger">Batal</a>
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
