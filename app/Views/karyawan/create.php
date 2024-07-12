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
                        <li class="breadcrumb-item"><a href="/karyawan">Karyawan</a></li>
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
                        <h4 class="card-title">Tambah Karyawan</h4>
                        <!-- Tampilkan pesan kesalahan -->
                        <?php if (session()->has('error')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('errors')) : ?>
                            <?php foreach (session()->get('errors') as $error) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $error ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- End tampilkan pesan kesalahan -->
                        <form class="forms-sample" action="/karyawan/store" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori_pegawai">Kategori Pegawai</label>
                                <select name="kategori_pegawai" class="form-control" required>
                                    <option value="PNS">PNS</option>
                                    <option value="PTT">PTT</option>
                                    <option value="Tenaga Ahli">Tenaga Ahli</option>
                                    <option value="NON PNS">NON PNS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>No Rek</label>
                                <input type="text" name="norek" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Status Tanda Tangan</label><br>
                                <input type="radio" name="status_ttd" value="Ya" required onclick="showUploadForm()">
                                Ya<br>
                                <input type="radio" name="status_ttd" value="Tidak" required onclick="hideUploadForm()">
                                Tidak
                            </div>

                            <div id="uploadForm" style="display: none;">
                                <div class="form-group">
                                    <label>Upload Tanda Tangan</label> <br>
                                    <div id="previewContainer" style="display: none;">
                                        <img id="previewImage" src="" alt="Pratinjau Gambar" width="100" height="100">
                                    </div>
                                    <label><small>Upload dalam Format JPG dan PNG</small></label> <br>

                                    <input type="file" name="file" id="fileUpload" class="form-control-file" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="<?= base_url('/karyawan'); ?>" class="btn btn-danger">Batal</a>
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
    function showUploadForm() {
        document.getElementById('uploadForm').style.display = 'block';
        document.getElementById('fileUpload').setAttribute('required', 'required');
    }

    function hideUploadForm() {
        document.getElementById('uploadForm').style.display = 'none';
        document.getElementById('fileUpload').removeAttribute('required');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewImage').setAttribute('src', e.target.result);
                document.getElementById('previewContainer').style.display = 'block'; // Tampilkan pratinjau kontainer
            }

            reader.readAsDataURL(input.files[0]); // Membaca data URL gambar
        }
    }

    // Panggil fungsi previewImage() ketika pengguna memilih gambar baru
    document.getElementById('fileUpload').addEventListener('change', function() {
        previewImage(this);
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- link ref -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!--  script src -->
<?= $this->endSection() ?>