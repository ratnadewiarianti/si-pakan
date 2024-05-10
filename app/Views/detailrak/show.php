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
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%" id=" table-2">
                                        <thead>
                                            <th>Nama Sub Kegiatan</th>
                                            <th>Kode Akun</th>
                                            <th>Nama Akun</th>
                                            <th>Nilai Rincian</th>
                                            <th>Total Rak</th>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($rakbelanja)) : ?>
                                                <?php foreach ($rakbelanja as $row) : ?>
                                                    <tr>
                                                        <td><?= $row['nm_subkegiatan']; ?></td>
                                                        <td><?= $row['kode_rekening']; ?></td>
                                                        <td><?= $row['uraian_akun']; ?></td>
                                                        <td><?= 'Rp ' . number_format($row['nilai_rincian'], 0, ',', '.'); ?></td>
                                                        <td><?= 'Rp ' . number_format($row['total_rak'], 0, ',', '.'); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data Rekening.</td>
                                                </tr>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-4">
                            <div>
                                <p class="card-title">Detail Data Rak Belanja</p>
                            </div>
                            <div>
                                <a class="btn btn-success btn-sm" href="/detailrak/create/<?= service('uri')->getSegment(3); ?>">Tambah Data</a>
                                <a class="btn btn-dark btn-sm" href="/rakbelanja">Kembali</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="">No</th>
                                                <th>Bulan</th>
                                                <th>Nilai</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($detailrak)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($detailrak as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['bulan']; ?></td>
                                                        <td><?= 'Rp ' . number_format($row['nilai'], 0, ',', '.'); ?></td>
                                                        <td>
                                                            <a href="/detailrak/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/detailrak/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan=" 6" class="text-center">Tidak ada data Rekening.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
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
<script>
    $(document).ready(function() {
        $('#table-1').DataTable();
    });
</script>

<?= $this->endSection() ?>