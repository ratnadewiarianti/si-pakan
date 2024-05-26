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
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-4">
                            <div>
                                <p class="card-title">Detail Data DPA</p>
                            </div>
                            <div>
                                <a class="btn btn-success btn-sm"
                                    href="/detaildpa/create/<?= service('uri')->getSegment(3); ?>">Tambah Data</a>
                                <a class="btn btn-dark btn-sm" href="/dpa">Kembali</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <!-- <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%" id=" table-2"> -->
                                        <thead>
                                            <th>No</th>
                                            <th>Nomor DPA</th>
                                            <th>Subkegiatan</th>
                                            <th>Rekening</th>
                                            <th>Jumlah</th>
                                            <th>Jumlah Perubahan</th>
                                            <th>Action</th>

                                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($detaildpa)) : ?>
                                                <?php $no = 1; ?>
                                            <?php foreach ($detaildpa as $row) : ?>
                                            <tr>
                                            <td><?= $no++; ?></td>
                                                <td><?= $row['nomor_dpa']; ?></td>
                                                <td><?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?> <?= $row['nama_subkegiatan']; ?>
                                                </td>
                                                <td><?= $row['kode_akun']; ?>.<?= $row['kode_kelompok']; ?>.<?= $row['kode_jenis']; ?>.<?= $row['kode_objek']; ?>.<?= $row['kode_rincian_objek']; ?>.<?= $row['kode_sub_rincian_objek']; ?> <?= $row['uraian_sub_rincian_objek']; ?>
                                                </td>
                                                <td><?= 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'); ?></td>

                                                <td>
                                                    <?php
                                                    if (!empty($row['jumlahdpaperubahan'])) {
                                                        echo 'Rp ' . number_format($row['jumlahdpaperubahan'], 0, ',', '.');
                                                    } else {
                                                        // echo '<a href="/detaildpa/edit_jumlah_perubahan/' . $row['id'] . '" class="btn btn-sm btn-warning">Tambah Perubahan</a>';
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>

                                                <td>

                                                <!-- <a href="/detaildpasubkegiatan/showdetail/<?= $row['id']; ?>"
                                                    class="btn btn-sm btn-success">Detail</a> -->
                                                    <a href="/detaildpa_subkegiatan/showdetail/<?= $row['id']; ?>" class="btn btn-sm btn-success">Detail</a>

                                                <a href="/detaildpa/edit/<?= $row['id']; ?>"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <a href="/detaildpa/delete/<?= $row['id']; ?>"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data detail dpa.</td>
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
    $(document).ready(function () {
        $('#table-1').DataTable();
    });
</script>

<?= $this->endSection() ?>