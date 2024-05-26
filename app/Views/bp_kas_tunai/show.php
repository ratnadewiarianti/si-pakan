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
                        <li class="breadcrumb-item"><a href="/bp_kas_tunai">Bidang Urusan</a></li>
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
                                <p class="card-title">Master Data Bidang Urusan</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/bp_kas_tunai/create">Tambah Data</a>
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
                                            <th>Tanggal</th>
                                            <th>No Bukti</th>
                                            <th>Uraian</th>
                                            <th>Penerimaan</th>
                                            <th>Pengeluaran</th>
                                            <th>Saldo</th>
                                            <th>Jumlah Periode Ini</th>
                                            <th>Jumlah Sampai Periode Lalu</th>
                                            <th>Jumlah Semua Sampai Periode Ini</th>
                                            <th>Sisa Kas</th>
                                            <th>Kas Bendahara Pengeluaran Tunai</th>
                                            <th>Kepala Dinas</th>
                                            <th>Bendahara Pengeluaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($bp_kas_tunai)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($bp_kas_tunai as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?> <?= $row['nomenklatur_urusan_provinsi']; ?>
                                                </td>
                                                <td><?= $row['kode_akun']; ?>.<?= $row['kode_kelompok']; ?>.<?= $row['kode_jenis']; ?>.<?= $row['kode_objek']; ?>.<?= $row['kode_rincian_objek']; ?>.<?= $row['kode_sub_rincian_objek']; ?> <?= $row['uraian_sub_rincian_objek']; ?>
                                                </td>
                                                        <td><?= $row['tanggal']; ?></td>
                                                <td><?= $row['no_bukti']; ?></td>
                                                <td><?= $row['uraian']; ?></td>
                                                <td><?= $row['penerimaan']; ?></td>
                                                <td><?= $row['pengeluaran']; ?></td>
                                                <td><?= $row['saldo']; ?></td>
                                                <td><?= $row['jumlah_periode_ini']; ?></td>
                                                <td><?= $row['jumlah_periode_lalu']; ?></td>
                                                <td><?= $row['jumlah_semua_periode']; ?></td>
                                                <td><?= $row['sisa_kas']; ?></td>
                                                <td><?= $row['kas_bendahara']; ?></td>
                                                <td><?= $row['nama_kepala_dinas']; ?></td>
                                                <td><?= $row['nama_bendahara_pengeluaran']; ?></td>
                                                        <td>
                                                        <a href="/bp_kas_tunai/cetak/<?= $row['id']; ?>" class="btn btn-sm btn-dark" target="_blank">Cetak</a>
                                                            <a href="/bp_kas_tunai/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/bp_kas_tunai/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data Bidang Urusan.</td>
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