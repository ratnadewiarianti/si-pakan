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
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-10">
                                <p class="card-title">Data Berita</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/berita/create">Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="">No</th>
                                                <th>berita</th>
                                                <th>tanggal dibuat</th>
                                                <th>tanggal diperbarui</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($berita)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($berita as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>
                                                            <b><?= $row['judul']; ?></b><br>
                                                            <p style="word-wrap: break-word; white-space: normal; ">
                                                                <?= wordwrap($row['berita'], 100, "<br>\n", true); ?>

                                                            </p>
                                                        </td>
                                                        <td><?= date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                                        <td><?= $row['updated_at'] !== null ? date('d-m-Y', strtotime($row['updated_at'])) : '-'; ?>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" <?= $row['status'] == 'on' ? 'checked' : ''; ?> data-id="<?= $row['id']; ?>" onchange="changeStatus(this)">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/berita/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/berita/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data Berita.</td>
                                                </tr>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div>
                        </div>
                    </div>
                </div> -->
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
<script>
    $(document).ready(function() {
        $('#table-1').DataTable();
    });

    function changeStatus(checkbox) {
        const id = checkbox.getAttribute('data-id');
        const isChecked = checkbox.checked;

        // Kirim permintaan AJAX
        fetch('/berita/aktivasi/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    status: isChecked ? 'on' : 'off'
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Tindakan selanjutnya setelah respons dari server
                alert('Berhasil memperbarui status!');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<?= $this->endSection() ?>