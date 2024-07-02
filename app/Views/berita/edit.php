<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <!-- breadcrumb -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 ">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/berita">Berita</a></li>
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
                        <h4 class="card-title">Tambah Berita Baru</h4>
                        <form action="/berita/update/<?= $berita['id']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" class="form-control" name="judul" value="<?= $berita['judul']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Isi Berita</label>
                                <textarea id="summernote" style="height: 300px;" name="berita">
                                <?= $berita['berita']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>File Gambar</label> <br>

                                <div id="previewContainer">
                                    <img id="previewImage" src="<?= base_url('uploads/berita/' . $berita['file']); ?>" alt="Gambar" width="200" height="200">
                                </div>
                                <label><small>Upload dalam skala 1:1 / persegi</small></label> <br>

                                <input type="file" name="file" id="fileUpload" class="form-control-file" accept=".jpg, .jpeg, .png">
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/berita'); ?>" class="btn btn-danger">Batal</a>
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
<!-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!--  script src -->

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script> -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            minHeight: 200,
            focus: true
        });


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
    });
</script>
<?= $this->endSection() ?>