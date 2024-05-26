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
                        <li class="breadcrumb-item"><a href="/penatausahaan">penatausahaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end breadcrumb -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card mb-5">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-4">
                            <div>
                                <p class="card-title">Detail Data penatausahaan</p>
                            </div>
                            <div>
                                <a class="btn btn-success btn-sm" href="/detailpenatausahaan/create/<?= service('uri')->getSegment(3); ?>">Tambah
                                    Data</a>
                                <a class="btn btn-dark btn-sm" href="/penatausahaan">Kembali</a>
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
                                            <th>Nomor Rekening</th>
                                            <th>Nomor BK Umum</th>
                                            <th>Nomor BK Pembantu</th>
                                            <th>Asli I,II,III</th>
                                            <th>Sudah Terima Dari</th>
                                            <th>Uang Sebanyak</th>
                                            <th>Untuk Pembayaran</th>
                                            <th>Pajak Daerah</th>
                                            <th>PPH 21</th>
                                            <th>Terbilang</th>
                                            <th>Status Verifikasi</th>
                                            <th>Verifikasi</th>
                                            <th>Action</th>

                                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($detailpenatausahaan)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($detailpenatausahaan as $row) : ?>
                                                    <tr>
                                                        <td>
                                                            <?= $no++; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?>
                                                            - <?= $row['nomenklatur_urusan_provinsi']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['kode_rekening']; ?> -
                                                            <?= $row['uraian_sub_rincian_objek']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['no_bk_umum']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['no_bk_pembantu']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['asli_123']; ?>
                                                        </td>
                                                        <td style="text-align: justify;">
                                                            <?php
                                                            $wrapped_text = wordwrap($row['sudah_terima_dari'], 40, "<br>\n", true);
                                                            echo $wrapped_text;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['uang_sebanyak']; ?>
                                                        </td>
                                                        <td style="text-align: justify;">
                                                            <?php
                                                            $wrapped_text = wordwrap($row['untuk_pembayaran'], 70, "<br>\n", true);
                                                            echo $wrapped_text;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['pajak_daerah']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['pph21']; ?>
                                                        </td>
                                                        <td>
                                                            <?= 'Rp ' . number_format($row['terbilang'], 0, ',', '.'); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $buttonClass = '';
                                                            switch ($row['status_verifikasi']) {
                                                                case 'MENUNGGU':
                                                                    $buttonClass = 'btn-warning';
                                                                    break;
                                                                case 'DITERIMA':
                                                                    $buttonClass = 'btn-success';
                                                                    break;
                                                                case 'DITOLAK':
                                                                    $buttonClass = 'btn-danger';
                                                                    break;
                                                                default:
                                                                    // Default class atau logika jika tidak sesuai kondisi di atas.
                                                                    break;
                                                            }
                                                            ?>
                                                            <button class="btn <?= $buttonClass; ?>" disabled><?= $row['status_verifikasi']; ?></button>
                                                        </td>
                                                        <td>
                                                            <a href="/detailpenatausahaan/terima/<?= $row['id']; ?>" class="btn btn-success btn-sm btn-terima" data-id="<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menerima data ini?')">Disetujui</a>
                                                            <a href="/detailpenatausahaan/tolak/<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-tolak" data-id="<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menolak data ini?')">Ditolak</a>

                                                        </td>
                                                        <td>
                                                            <?php if ($row['status_verifikasi'] == 'DITERIMA') : ?>
                                                                <a href="/detailpenatausahaan/cetak/<?= $row['id']; ?>" class="btn btn-sm btn-dark" target="_blank">Cetak</a>
                                                            <?php endif; ?>
                                                            <a href="/keterangan/show/<?= $row['id']; ?>" class="btn btn-sm btn-success">Keterangan</a>
                                                            <a href="/detailpenatausahaan/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/detailpenatausahaan/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data detail penatausahaan.
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

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-4">
                            <div>
                                <p class="card-title">Keterangan Anggota</p>
                            </div>
                            <div>
                                <a class="btn btn-success btn-sm" href="/detailpenatausahaan/create2/<?= service('uri')->getSegment(3); ?>">Tambah Data</a>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <!-- <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%" id=" table-2"> -->
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>

                                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($detail2)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($detail2 as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['nama']; ?></td>
                                                        <td><?= $row['nip']; ?></td>
                                                        <td><?= $row['jabatan']; ?></td>
                                                        <td>
                                                            <a href="/detailpenatausahaan/edit2/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/detailpenatausahaan/delete2/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data detail penatausahaan.
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttonsTerima = document.querySelectorAll('.btn-terima');
            var buttonsTolak = document.querySelectorAll('.btn-tolak');

            function handleResponse(data) {
                if (data.status === 'success') {
                    console.log(data.message);
                    // Ubah tampilan sesuai dengan respons
                    location.reload(); // Reload halaman setelah pembaruan berhasil
                } else {
                    console.error('Gagal memperbarui status:', data.message);
                }
            }

            buttonsTerima.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var id = this.getAttribute('data-id');

                    fetch('/detailpenatausahaan/terima/' + id + '?timestamp=' + new Date().getTime(), {
                            method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            handleResponse(data);
                        })
                        .catch(error => {
                            console.error('Gagal mengirim permintaan: ' + error);
                        });
                });
            });

            buttonsTolak.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var id = this.getAttribute('data-id');

                    fetch('/detailpenatausahaan/tolak/' + id + '?timestamp=' + new Date().getTime(), {
                            method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            handleResponse(data);
                        })
                        .catch(error => {
                            console.error('Gagal mengirim permintaan: ' + error);
                        });
                });
            });
        });
    </script>


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