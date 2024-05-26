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
                        <li class="breadcrumb-item"><a href="/subrincian">Sub Rincian Objek</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Sub Rincian Objek</h4>
                        <form action="/subrincian/update/<?= $subrincian['id']; ?>" method="post">
                            <div class="form-group">
                                <label>Kode Rincian Objek</label>
                                <select class="form-control js-example-basic-single w-100" name="id_rincian_objek" id="id_rincian_objek" required>
                                    <?php foreach ($rincianobjek as $key) : ?>
                                        <option value="<?= $key['id']; ?>" <?php if ($key['id'] == $subrincian['id_rincian_objek']) echo 'selected="selected"' ?>><?= $key['kode_rincian_objek']; ?> - <?= $key['uraian_rincian_objek']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode sub rincian objek</label>
                                <input type="text" name="kode_sub_rincian_objek" class="form-control" value="<?= $subrincian['kode_sub_rincian_objek']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian sub rincian objek</label>
                                <input type="text" name="uraian_sub_rincian_objek" class="form-control" value="<?= $subrincian['uraian_sub_rincian_objek']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/subrincian'); ?>" class="btn btn-danger">Batal</a>
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
<script type="text/javascript">
    $(document).ready(function() {


        // ajax method for get kelompok option
        $('#id_akun').change(function() {
            var id_akun = $(this).val();
            if (id_akun != '') {
                $.ajax({
                    url: '/subrincian/getKelompok/' + id_akun,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var options = '<option value="">- Pilih Kelompok -</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.kode_kelompok + ' - ' + value.uraian_kelompok + '</option>';
                        });
                        $('#id_kelompok').html(options);
                    }
                });
            }
        });

        // ajax method for get jenis option
        $('#id_kelompok').change(function() {
            var id_kelompok = $(this).val();
            if (id_kelompok != '') {
                $.ajax({
                    url: '/subrincian/getJenis/' + id_kelompok,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var options = '<option value="">- Pilih Jenis -</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.kode_jenis + ' - ' + value.uraian_jenis + '</option>';
                        });
                        $('#id_jenis').html(options);
                    }
                });
            }
        });

        // ajax method for get objek option
        $('#id_jenis').change(function() {
            var id_jenis = $(this).val();
            if (id_jenis != '') {
                $.ajax({
                    url: '/subrincian/getObjek/' + id_jenis,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var options = '<option value="">- Pilih Objek -</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.kode_objek + ' - ' + value.uraian_objek + '</option>';
                        });
                        $('#id_objek').html(options);
                    }
                });
            }
        });

        // ajax method for get rincian objek option
        $('#id_objek').change(function() {
            var id_objek = $(this).val();
            if (id_objek != '') {
                $.ajax({
                    url: '/subrincian/getRincianObjek/' + id_objek,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var options = '<option value="">- Pilih Objek -</option>';
                        $.each(response, function(index, value) {
                            options += '<option value="' + value.id + '">' + value.kode_rincian_objek + ' - ' + value.uraian_rincian_objek + '</option>';
                        });
                        $('#id_rincian_objek').html(options);
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>