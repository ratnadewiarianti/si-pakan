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
                        <li class="breadcrumb-item"><a href="/detaildpa_subkegiatan">Detail DPA</a></li>
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
                                <p class="card-title">Detail Data DPA Subkegiatan</p>
                            </div>
                            <div>
                            <?php $role_id = session()->get('role_id'); ?>
                            <?php if ($role_id != 'staff') : ?>
                                <a class="btn btn-success btn-sm"
                                    href="/detaildpa_subkegiatan/create/<?= service('uri')->getSegment(3); ?>">Tambah
                                    Data</a>
                                    <?php endif; ?>
                                <!-- <a class="btn btn-dark btn-sm" href="/detaildpa/show">Kembali</a> -->
                                <a href="/detaildpa/show/<?= service('uri')->getSegment(3); ?>" class="btn btn-dark btn-sm">Kembali</a>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <!-- <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%" id=" table-2"> -->
                                        <thead>
                                            <!-- id_detail_dpa','uraian','koefisien','satuan','harga','ppn','jumlah','keterangan','koefisien_perubahan','satuan_perubahan','harga_perubahan','ppn_perubahan','jumlah_perubahan','keterangan_perubahan' -->
                                            <tr>
                                                <th rowspan="2"
                                                    style="text-align:center; vertical-align:middle; background-color: #D3D3D3;">
                                                    No</th>
                                                <th rowspan="2"
                                                    style="text-align:center; vertical-align:middle; background-color: #D3D3D3;">
                                                    Subkegiatan</th>
                                                <th rowspan="2"
                                                    style="text-align:center; vertical-align:middle; background-color: #D3D3D3;">
                                                    Uraian</th>
                                                <th colspan="6" style="text-align: center; background-color: #A0A0A0;">
                                                    Sebelum Perubahan</th>
                                                <th colspan="6" style="text-align:center; background-color: #D3D3D3;">
                                                    Sesudah Perubahan</th>
                                                    <?php if ($role_id != 'staff') : ?>
                                                <th rowspan="2"
                                                    style="text-align:center; vertical-align:middle; background-color: #D3D3D3;">
                                                    Action</th> <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #A0A0A0;">Koefisien</th>
                                                <th style="background-color: #A0A0A0;">Satuan</th>
                                                <th style="background-color: #A0A0A0;">Harga </th>
                                                <th style="background-color: #A0A0A0;">PPN</th>
                                                <th style="background-color: #A0A0A0;">Jumlah</th>
                                                <th style="background-color: #A0A0A0;">Keterangan</th>
                                                <th style="background-color: #D3D3D3;">Koefisien Perubahan</th>
                                                <th style="background-color: #D3D3D3;">Satuan Perubahan</th>
                                                <th style="background-color: #D3D3D3;">Harga Perubahan</th>
                                                <th style="background-color: #D3D3D3;">PPN Perubahan</th>
                                                <th style="background-color: #D3D3D3;">Jumlah Perubahan</th>
                                                <th style="background-color: #D3D3D3;">Keterangan Perubahan</th>
                                            </tr>
                                        </thead>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($detaildpa_subkegiatan)) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($detaildpa_subkegiatan as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?>
                                                </td>
                                                <td><?= $row['uraian']; ?></td>
                                                <td><?= $row['koefisien']; ?></td>
                                                <td><?= $row['satuan']; ?></td>
                                                <td><?= 'Rp ' . number_format($row['harga'], 0, ',', '.'); ?></td>
                                                <td><?= 'Rp ' . number_format($row['ppn'], 0, ',', '.'); ?></td>
                                                <td><?= 'Rp ' . number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                                <td><?= $row['keterangan']; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['koefisien_perubahan'])) {
                                                           echo $row['koefisien_perubahan'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['satuan_perubahan'])) {
                                                           echo $row['satuan_perubahan'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['harga_perubahan'])) {
                                                           echo 'Rp ' . number_format($row['harga_perubahan'], 0, ',', '.');
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['ppn_perubahan'])) {
                                                           echo 'Rp ' . number_format($row['ppn_perubahan'], 0, ',', '.');
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['jumlah_perubahan'])) {
                                                           echo 'Rp ' . number_format($row['jumlah_perubahan'], 0, ',', '.');
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($row['keterangan_perubahan'])) {
                                                           echo $row['keterangan_perubahan'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>

                                                <?php if ($role_id != 'staff') : ?>
                                                <td>

                                                    <?php if (empty($row['koefisien_perubahan'])): ?>
                                                    <a href="/detaildpa_subkegiatan/perubahan/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-warning">Add Changes</a>
                                                    <?php endif; ?>

                                                    <a href="/detaildpa_subkegiatan/edit/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="/detaildpa_subkegiatan/delete/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="20" class="text-center">Tidak ada data detail dpa.</td>
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