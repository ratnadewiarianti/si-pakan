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
                        <li class="breadcrumb-item"><a href="/rakbelanja">Rak Belanja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Rak Belanja</h4>
                        <form class="forms-sample" action="/rakbelanja/store" method="post">
                            <!-- <div class="form-group">
                                <label>Nama Sub Kegiatan</label>
                                <input type="text" name="nm_subkegiatan" class="form-control" required>
                            </div> -->
                            <div class="form-group">
                                <label>Data Rekening</label>
                                <select class="form-control js-example-basic-single w-100" name="id_detail_dpa" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($rekening as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['uraian_sub_rincian_objek']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nilai Rincian <small id="total_jumlah"> </small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="nilai_rincian" class="form-control" required>
                                </div>
                                <small id="error_message" class="text-danger"></small> <!-- Tempat untuk menampilkan pesan error -->
                            </div>

                            <input type="hidden" name="waktu" value="<?= service('uri')->getSegment(3); ?>">
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="/rakbelanja/index/<?= service('uri')->getSegment(3); ?>" class="btn btn-danger">Batal</a>
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
    $(document).ready(function() {
        // Event listener untuk perubahan pada select dengan ID id_detail_dpa
        $('select[name="id_detail_dpa"]').change(function() {
            var idDetailDPA = $(this).val(); // Ambil nilai ID yang dipilih

            // Kirim permintaan AJAX
            $.ajax({
                url: '/rakbelanja/getTotalJumlah/' + idDetailDPA, // Ganti dengan URL endpoint yang sesuai
                type: 'GET',
                success: function(response) {
                    // Tampilkan total jumlah di dalam tag <small>
                    $('small#total_jumlah').text("(maksimal jumlah yang bisa diinput: " + response.total_jumlah + ")");
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('input[name="nilai_rincian"]').blur(function() {
            var idDetailDPA = $('select[name="id_detail_dpa"]').val();
            var nilaiRincian = $(this).val();
            // Kirim permintaan AJAX untuk validasi nilai_rincian
            $.ajax({
                url: '/rakbelanja/cekNilai/' + idDetailDPA + '/' + nilaiRincian,
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        // Tampilkan pesan error jika ada kesalahan validasi
                        $('small#error_message').text(response.error).addClass('text-danger');
                    } else {
                        // Kosongkan pesan error jika nilai rincian valid
                        $('small#error_message').text('').removeClass('text-danger');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>