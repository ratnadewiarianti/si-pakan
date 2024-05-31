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

                            <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control" name="id_detail_dpa" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpa as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama_subkegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rekening</label>
                                <select class="form-control js-example-basic-single w-100" name="id_rekening" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($rekening as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['uraian_akun']; ?></option>
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
                                <input type="text" name="uang_sebanyak" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Untuk Pembayaran</label>
                                <textarea name="untuk_pembayaran" required class="form-control" style="min-height:100px"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Apakah berisi pajak?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="berisi_pajak" value="Ya" required onclick="togglePajakOptions(true)"> Ya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="berisi_pajak" value="Tidak" required onclick="togglePajakOptions(false)"> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="pajak-options" style="display: none;">
                                <label>Pilih Pajak <small> (maksimal pilih 2 pajak)</small></label>
                                <?php foreach ($pajak as $key) : ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" checked>
                                            <input class="form-check-input" type="checkbox" name="id_pajak[]" value="<?= $key['id']; ?>" onclick="limitPajakSelection(this)">
                                            <?= $key['nama_pajak']; ?> (<?= $key['persen']; ?>%)
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label>Terbilang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="terbilang" required class="form-control">
                                </div>
                            </div>
                            <input type="text" name="status_verifikasi" value="MENUNGGU" class="form-control" hidden required>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="/detailpenatausahaan/show/<?= service('uri')->getSegment(3); ?>" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Add any additional CSS here -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function togglePajakOptions(show) {
        var pajakOptions = document.getElementById('pajak-options');
        pajakOptions.style.display = show ? 'block' : 'none';
    }

    function limitPajakSelection(checkbox) {
        var checkboxes = document.querySelectorAll('input[name="pajak[]"]');
        var checkedCount = 0;
        checkboxes.forEach(function(cb) {
            if (cb.checked) {
                checkedCount++;
            }
        });
        if (checkedCount > 2) {
            checkbox.checked = false;
            alert("Anda hanya bisa memilih maksimal 2 pajak.");
        }
    }
</script>
<?= $this->endSection() ?>