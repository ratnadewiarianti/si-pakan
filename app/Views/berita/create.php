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
                        <form action="/berita/store/" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="form-group">
                                <label>Isi Berita</label>
                                <textarea id="summernote" style="height: 300px;" name="berita"></textarea>
                            </div>
                            <div class="form-group">
                                <label>File Gambar atau PDF</label> <br>
                                <div id="previewContainer">
                                    <img id="previewImage" src="" alt="Pratinjau Gambar" width="200" height="200" style="display:none;">
                                    <iframe id="previewPdf" width="200" height="200" style="display:none;"></iframe>
                                </div>
                                <label><small>Upload dalam skala 1:1 / persegi atau file PDF</small></label> <br>
                                <input type="file" name="file" id="fileUpload" class="form-control-file" accept=".jpg, .jpeg, .png, .pdf">
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            minHeight: 200,
            focus: true
        });

        function previewFile(input) {
            var file = input.files[0];
            var previewImage = document.getElementById('previewImage');
            var previewPdf = document.getElementById('previewPdf');

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type === 'application/pdf') {
                        previewImage.style.display = 'none';
                        previewPdf.style.display = 'block';
                        previewPdf.setAttribute('src', e.target.result);
                    } else {
                        previewPdf.style.display = 'none';
                        previewImage.style.display = 'block';
                        previewImage.setAttribute('src', e.target.result);
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('fileUpload').addEventListener('change', function() {
            previewFile(this);
        });
    });
</script>
<?= $this->endSection() ?>