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
                        <li class="breadcrumb-item"><a href="/dpa">DPA</a></li>
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
                                <p class="card-title"> Data DPA</p>
                            </div>
                            <?php $role_id = session()->get('role_id'); ?>
                            <?php if ($role_id != 'staff') : ?>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/dpa/create">Tambah Data</a>
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="">No</th>
                                                <th>Nomor dpa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($dpa)) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($dpa as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['nomor_dpa']; ?></td>
                                                <td>
                                                    <a href="/dpa/cetak/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-dark">Cetak</a>
                                                    <a href="/detaildpa/show/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-success">Detail</a>

                                                   
                                                    <?php if ($role_id != 'staff') : ?>
                                                    <a href="/dpa/edit/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="/dpa/delete/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data DPA.</td>
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
    $(document).ready(function () {
        $('#table-1').DataTable();
    });
</script>

<?= $this->endSection() ?>