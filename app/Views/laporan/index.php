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
                        <li class="breadcrumb-item"><a href="/laporan">Laporan SI SPJ</a></li>
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
                                <p class="card-title">Master Data Laporan SI SPJ</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/laporan/create">Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="">No</th>
                                                <th>Subkegiatan</th>
                                                <th>Rekening</th>
                                                <th>Pagu Rekening</th>
                                                <th>Realisasi Per Rekening</th>
                                                <th>Persen</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($laporan)) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($laporan as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>

                                                <td><?= $row['nama_subkegiatan']; ?></td>
                                                <td><?= $row['kode_akun']; ?>.<?= $row['kode_kelompok']; ?>.<?= $row['kode_jenis']; ?>.<?= $row['kode_objek']; ?>.<?= $row['kode_rincian_objek']; ?>.<?= $row['kode_sub_rincian_objek']; ?>
                                                    <?= $row['uraian_sub_rincian_objek']; ?></td>
                                                <td><?= 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'); ?></td>
                                                <td><?= 'Rp ' . number_format($row['realisasi'], 0, ',', '.'); ?></td>
                                                <td>
                                                    <?php 
                                                        if ($row['jumlahdpa'] != 0) {
                                                            $persentase_realisasi = ($row['realisasi'] / $row['jumlahdpa']) * 100; 
                                                            echo number_format($persentase_realisasi, 2) . '%';
                                                        } else {
                                                            echo 'N/A'; // Jika jumlah DPA adalah 0, maka tidak bisa dihitung
                                                        }
                                                    ?>
                                                </td>

                                                <td>
                                                    <a href="/laporan/cetak/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-dark" target="_blank">Cetak</a>
                                                    <a href="/laporan/edit/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="/laporan/delete/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data Laporan SI SPJ.</td>
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