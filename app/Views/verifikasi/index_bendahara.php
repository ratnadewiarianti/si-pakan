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
                        <li class="breadcrumb-item"><a href="/verifikasi">Verifikasi Bendahara</a></li>
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
                                <p class="card-title">Verifikasi Data Bendahara</p>
                            </div>
                            <div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <th>No</th>
                                            <th>Link Google</th>
                                            <th>Rekening</th>
                                            <th>Subkegiatan</th>
                                            <th>Jumlah</th>
                                            <th>Untuk Pembayaran</th>
                                            <!-- <th>Pajak</th> -->
                                            <th>Status Verifikasi</th>
                                            <th>Verifikasi</th>
                                            <th>Action</th>

                                            <!-- 'id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan' -->
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($penatausahaan)) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($penatausahaan as $row) : ?>
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <td><a href="<?= $row['link_google']; ?>" target="_blank">lihat dokumen</a></td>
                                                <td>
                                                    <?= $row['kode_urusan']; ?>.<?= $row['kode_bidang_urusan']; ?>.<?= $row['kode_program']; ?>.<?= $row['kode_kegiatan']; ?>.<?= $row['kode_subkegiatan']; ?>
                                                    - <?= $row['nama_subkegiatan']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['kode_rekening']; ?> -
                                                    <?= $row['uraian_sub_rincian_objek']; ?>
                                                </td>
                                                <td>
                                                    <?= 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'); ?>
                                                </td>
                                                <td style="text-align: justify;">
                                                    <?php
                                                            $wrapped_text = wordwrap($row['untuk_pembayaran'], 70, "<br>\n", true);
                                                            echo $wrapped_text;
                                                            ?>
                                                </td>
                                                <!-- <td>
                                                    <?php if (!empty($item['pajak'])): ?>
                                                    <ul>
                                                        <?php foreach ($pajak as $key) : ?>
                                            <tr>
                                                <td style="vertical-align: top;white-space: nowrap;">
                                                    <b><?= $key['nama_pajak']; ?></b> <?= 'Rp ' . number_format($key['nilai_pajak'], 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </ul>
                                            <?php else: ?>
                                            Tidak ada data pajak
                                            <?php endif; ?>
                                            </td> -->


                                                <td>
                                                    <?php
                                                        $buttonClass = '';
                                                        switch ($row['verifikasi_bendahara']) {
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
                                                    <button class="btn <?= $buttonClass; ?>"
                                                        disabled><?= $row['verifikasi_bendahara']; ?></button>
                                                </td>
                                                <td>
                                                    <a href="/detailpenatausahaan/terima_bendahara/<?= $row['id']; ?>"
                                                        class="btn btn-success btn-sm btn-terima"
                                                        data-id="<?= $row['id']; ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin menerima data ini?')">Disetujui</a>
                                                    <a href="/detailpenatausahaan/tolak_bendahara/<?= $row['id']; ?>"
                                                        class="btn btn-danger btn-sm btn-tolak"
                                                        data-id="<?= $row['id']; ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin menolak data ini?')">Ditolak</a>
                                                </td>
                                                <td>
                                                    <?php if ($row['verifikasi_bendahara'] == 'DITERIMA') : ?>
                                                    <a href="/detailpenatausahaan/cetakbendahara/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-dark" target="_blank">Cetak</a>
                                                    <?php else : ?>
                                                    -
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data Verifikasi.
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




            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var buttonsTerima = document.querySelectorAll('.btn-terima');
                    var buttonsTolak = document.querySelectorAll('.btn-tolak');

                    function handleResponse(data) {
                        if (data.status === 'success') {
                            console.log(data.message);
                            location.reload(); // Reload halaman setelah pembaruan berhasil
                        } else {
                            console.error('Gagal memperbarui status:', data.message);
                        }
                    }

                    buttonsTerima.forEach(function (button) {
                        button.addEventListener('click', function (event) {
                            event.preventDefault();
                            var id = this.getAttribute('data-id');
                            fetch('/detailpenatausahaan/terima_bendahara/' + id +
                                    '?timestamp=' + new Date().getTime(), {
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

                    buttonsTolak.forEach(function (button) {
                        button.addEventListener('click', function (event) {
                            event.preventDefault();
                            var id = this.getAttribute('data-id');
                            fetch('/detailpenatausahaan/tolak_bendahara/' + id + '?timestamp=' +
                                    new Date().getTime(), {
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
            $(document).ready(function () {
                $('#table-1').DataTable();
            });
        </script>

        <?= $this->endSection() ?>