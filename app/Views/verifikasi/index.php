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
                        <li class="breadcrumb-item"><a href="/verifikasi">Verifikasi</a></li>
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
                                <p class="card-title">Verifikasi</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/verifikasi/create">Tambah Data</a>
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
                                                <th>Nomor BKU</th>
                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Nilai SPJ</th>
                                                <th>PPN</th>
                                                <th>PPH PSL 23</th>
                                                <th>PPH PSL 22</th>
                                                <th>PPH PSL 21</th>
                                                <th>Pajak Daerah</th>
                                                <th>Diterima</th>
                                                <th>File SPJ</th>
                                                <th>File Kwitansi</th>
                                                <th>Status Verifikasi</th>
                                                <th>Verifikasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($verifikasi)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($verifikasi as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?> <?= $row['nama_subkegiatan']; ?></td>

                                                        <td><?= $row['kode_rekening']; ?> <?= $row['uraian_sub_rincian_objek']; ?></td>
                                                        <td><?= $row['nomor_bku']; ?></td>
                                                        <td><?= $row['tanggal']; ?></td>
                                                        <td><?= $row['uraian']; ?></td>
                                                        <td><?= $row['nilai_spj']; ?></td>
                                                        <td><?= $row['ppn']; ?></td>
                                                        <td><?= $row['pph_psl_23']; ?></td>
                                                        <td><?= $row['pph_psl_22']; ?></td>
                                                        <td><?= $row['pph_psl_21']; ?></td>
                                                        <td><?= $row['pajak_daerah']; ?></td>
                                                        <td><?= $row['diterima']; ?></td>
                                                        <!-- <td><?= $row['file_spj']; ?></td> -->
                                                        <td>
                                                            <a href="/verifikasi/preview_spj/<?= $row['file_spj']; ?>" class="btn btn-sm btn-dark" target="_blank">Pratinjau</a>
                                                        </td>
                                                        <td>
                                                            <a href="/verifikasi/preview_kwintansi/<?= $row['file_kwitansi']; ?>" class="btn btn-sm btn-dark" target="_blank">Pratinjau</a>
                                                        </td>
                                                        <!-- id_detail_penatausahaan','nomor_bku', 'tanggal', 'uraian', 'nilai_spj', 'ppn', 'pph_psl_23', 'pph_psl_22', 'pph_psl_21', 'pajak_daerah', 'diterima', 'file_spj', 'file_kwitansi', 'status_bendahara', 'status_kasubbag', 'status_pptik', 'status_verifikator_keuangan -->
                                                    <td>
                                                    <?php
                                                    $buttonClass = '';
                                                    switch ($row['status_bendahara']) {
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
                                                    <button class="btn <?= $buttonClass; ?>" disabled><?= $row['status_bendahara']; ?></button>
                                                </td>
                                                <td>
                                                    <a href="/verifikasi/terima/<?= $row['id']; ?>"
                                                        class="btn btn-success btn-sm btn-terima"
                                                        data-id="<?= $row['id']; ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin menerima data ini?')">Disetujui</a>
                                                    <a href="/verifikasi/tolak/<?= $row['id']; ?>"
                                                        class="btn btn-danger btn-sm btn-tolak"
                                                        data-id="<?= $row['id']; ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin menolak data ini?')">Ditolak</a>
                                                </td>
                                                        <td>
                                                            <a href="/verifikasi/edit/<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="/verifikasi/destroy/<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="14" class="text-center">Tidak ada Verifikasi.</td>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-1').DataTable();
    });

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

                fetch('/verifikasi/terima/' + id + '?timestamp=' + new Date().getTime(), {
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

                fetch('/verifikasi/tolak/' + id + '?timestamp=' + new Date().getTime(), {
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


<?= $this->endSection() ?>