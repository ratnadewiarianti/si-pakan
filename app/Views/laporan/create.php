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
                        <li class="breadcrumb-item"><a href="/laporan">Laporan</a></li>
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
                        <h4 class="card-title">Cetak Laporan SI SPJ</h4>
                        <form action="/laporan/cetak/" method="post">
                        <div class="form-group">
    <label>DPA</label>
    <select class="form-control js-example-basic-single w-100" name="id_detail_dpa" id="id_detail_dpa" required>
        <option selected disabled>-</option>
        <?php foreach ($subkegiatan as $key) : ?>
            <option value="<?= $key['id']; ?>"><?= $key['nama_subkegiatan']; ?> - <?= $key['uraian_sub_rincian_objek']; ?>, Pagu Rp. <?= 'Rp ' . number_format($key['jumlahdpa'], 0, ',', '.'); ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label>Realisasi</label>
    <input type="number" name="realisasi" id="realisasi" required class="form-control">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_detail_dpa').change(function() {
            var id_detail_dpa = $(this).val();
            $.ajax({
                url: '<?= base_url('laporancontroller/getJumlahByIdDetailDpa'); ?>/' + id_detail_dpa,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if(response.jumlah !== undefined) {
                        $('#realisasi').val(response.jumlah);
                    } else {
                        $('#realisasi').val('');
                        alert('Data not found');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                    alert('AJAX Error: ' + status + ' - ' + error);
                }
            });
        });
    });
</script>

                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/laporan'); ?>" class="btn btn-danger">Batal</a>
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