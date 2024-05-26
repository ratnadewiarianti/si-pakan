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
                        <li class="breadcrumb-item"><a href="/pajak">Pajak</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <!-- <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-10">
                                <p class="card-title">Master Data Pajak</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/pajak/create">Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="">No</th>
                                                <th>Nama Pajak</th>
                                                <th>Persen (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($pajak)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pajak as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['nama_pajak']; ?></td>
                                                        <td><?= $row['persen']; ?></td>
                                                        <td>
                                                            <a href="/pajak/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/pajak/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data pajak.</td>
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
</script>

<?= $this->endSection() ?>