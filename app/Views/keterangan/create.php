<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Keterangan Detail Penatausahaan</h4>
                        <form class="forms-sample" action="/keterangan/store" method="post">

                            <input type="hidden" name="id_detail_penatausahaan" value="<?= service('uri')->getSegment(3); ?>" class="form-control" required>

                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->
                            <div class="form-group">
                                <label>DPA Subkegiatan</label>
                                <select class="form-control" name="id_dpa_subkegiatan" id="id_dpa_subkegiatan" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpasubkegiatan as $key) : ?>
                                        <option value="<?= $key['id_dpa_subkegiatan']; ?>" data-jumlah="<?= $key['jumlah']; ?>">
                                            <?= $key['uraian']; ?>, <?= $key['koefisien']; ?> <?= $key['satuan']; ?>, Harga:
                                            Rp. <?= $key['harga']; ?>, Jumlah: <?= $key['jumlah']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" id="harga" name="harga" class="form-control" required>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="/keterangan/show/<?= $detailpenatausahaan['id'] ?>" class="btn btn-danger">Batal</a>
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
<script>
    document.getElementById('id_dpa_subkegiatan').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var maxJumlah = selectedOption.getAttribute('data-jumlah');
        var jumlahInput = document.getElementById('jumlah');
        jumlahInput.max = maxJumlah;
    });
</script>
<?= $this->endSection() ?>