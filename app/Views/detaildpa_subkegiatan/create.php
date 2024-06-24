<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Detail DPA Subkegiatan</h4>
                        <form class="forms-sample" action="/detaildpa_subkegiatan/store" method="post">

                            <input type="hidden" name="id_detail_dpa" value="<?= service('uri')->getSegment(3); ?>"
                                class="form-control" required>

                            <!-- id_detail_dpa','uraian','koefisien','satuan','harga','ppn','jumlah','keterangan','koefisien_perubahan','satuan_perubahan','harga_perubahan','ppn_perubahan','jumlah_perubahan','keterangan_perubahan' -->

                            <div class="form-group">
                                <label>Uraian</label>
                                <input type="text" name="uraian" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Koefisien</label>
                                <input type="text" name="koefisien" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name="satuan" class="form-control" required>
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
                            <div class="form-group">
                                <label>PPN</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" id="ppn" name="ppn" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="/detaildpa_subkegiatan/showdetail/<?= service('uri')->getSegment(3); ?>"
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

<script>
    // Mendapatkan elemen-elemen input
    var hargaInput = document.getElementById("harga");
    var ppnInput = document.getElementById("ppn");
    var jumlahInput = document.getElementById("jumlah");

    // Menambahkan event listener untuk menghitung jumlah
    hargaInput.addEventListener("input", updateJumlah);
    ppnInput.addEventListener("input", updateJumlah);

    // Fungsi untuk menghitung jumlah
    function updateJumlah() {
        var harga = parseFloat(hargaInput.value) || 0; // Mengonversi harga menjadi angka, jika kosong maka 0
        var ppn = parseFloat(ppnInput.value) || 0; // Mengonversi ppn menjadi angka, jika kosong maka 0
        var jumlah = harga + ppn; // Menghitung jumlah
        jumlahInput.value = jumlah; // Menetapkan jumlah ke input jumlah, dengan membulatkan ke 2 angka desimal
    }
</script>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>

<!-- link ref -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!--  script src -->
<?= $this->endSection() ?>