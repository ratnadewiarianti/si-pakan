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
                                <a class="btn btn-success btn-sm"
                                    href="/detailpenatausahaan/create/<?= service('uri')->getSegment(3); ?>">Tambah
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
                                            <th>Subkegiatan</th>
                                            <th>Nomor Rekening</th>
                                            <!-- <th>Nomor BK Umum</th>
                                            <th>Nomor BK Pembantu</th>
                                            <th>Asli I,II,III</th>
                                            <th>Sudah Terima Dari</th> -->
                                            <!-- <th>Uang Sebanyak</th> -->
                                            <th>Untuk Pembayaran</th>
                                            <th>Terbilang</th>
                                            <th>Pajak</th>
                                            <th>Status Verifikasi</th>
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
                                                    - <?= $row['nama_subkegiatan']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['kode_rekening']; ?> -
                                                    <?= $row['uraian_sub_rincian_objek']; ?>
                                                </td>
                                                
                                                <td style="text-align: justify;">
                                                    <?php
                                                            $wrapped_text = wordwrap($row['untuk_pembayaran'], 70, "<br>\n", true);
                                                            echo $wrapped_text;
                                                            ?>
                                                </td>
                                                <td>
                                                    <?= 'Rp ' . number_format($sumTotal, 0, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    <ol>
                                                        <?php if (!empty($row['pajak'])) : ?>
                                                        <?php foreach ($row['pajak'] as $pajak_item) : ?>
                                                        <li> <?= $pajak_item['nama_pajak']; ?>
                                                            <?= 'Rp ' . number_format($pajak_item['jumlah_p'], 0, ',', '.'); ?>
                                                        </li>
                                                        <?php endforeach; ?>
                                                        <?php else : ?>
                                                        <li>Tidak ada data pajak</li>
                                                        <?php endif; ?>
                                                    </ol>
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
                                                    <button class="btn <?= $buttonClass; ?>"
                                                        disabled><?= $row['status_verifikasi']; ?></button>
                                                </td>

                                                <td>

                                                    <?php if ($row['status_verifikasi'] == 'DITERIMA' && $row['verifikasi_bendahara'] == 'DITERIMA') : ?>
                                                    <a href="/detailpenatausahaan/cetakbendahara/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-dark" target="_blank">Pinbuk</a>

                                                    <?php elseif ($row['status_verifikasi'] == 'DITERIMA') : ?>
                                                    <a href="/detailpenatausahaan/cetak/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-dark" target="_blank">Cetak</a>

                                                    <?php else : ?>
                                                    <a href="/detailpenatausahaan/preview/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-secondary" target="_blank">Preview</a>
                                                    <?php endif; ?>

                                                    <a href="/keterangan/show/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-success">Detail</a>
                                                    <!-- <a href="/detailpenatausahaan/edit/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-primary">Edit</a> -->
                                                    <a href="/detailpenatausahaan/delete/<?= $row['id']; ?>"
                                                        class="btn btn-sm btn-danger">Delete</a>
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
        document.addEventListener('DOMContentLoaded', function () {
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

            buttonsTerima.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    var id = this.getAttribute('data-id');

                    fetch('/detailpenatausahaan/terima/' + id + '?timestamp=' + new Date()
                            .getTime(), {
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

                    fetch('/detailpenatausahaan/tolak/' + id + '?timestamp=' + new Date()
                            .getTime(), {
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

    <?php
    function terbilang($number)
    {
        $number = abs($number);
        $units = ["", "Ribu", "Juta", "Miliar", "Triliun"];
        $words = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

        if ($number < 12) {
            return $words[$number];
        } elseif ($number < 20) {
            return $words[$number - 10] . " Belas";
        } elseif ($number < 100) {
            return $words[intval($number / 10)] . " Puluh" . (($number % 10 > 0) ? " " . $words[$number % 10] : "");
        } elseif ($number < 200) {
            return "Seratus" . (($number - 100 > 0) ? " " . terbilang($number - 100) : "");
        } elseif ($number < 1000) {
            return $words[intval($number / 100)] . " Ratus" . (($number % 100 > 0) ? " " . terbilang($number % 100) : "");
        } elseif ($number < 2000) {
            return "Seribu" . (($number - 1000 > 0) ? " " . terbilang($number - 1000) : "");
        } else {
            $output = "";
            $i = 0;
            while ($number > 0) {
                $remainder = $number % 1000;
                if ($remainder > 0) {
                    $output = terbilang($remainder) . " " . $units[$i] . (($output) ? " " . $output : "");
                }
                $number = intval($number / 1000);
                $i++;
            }
            return trim($output);
        }
    }
    ?>



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