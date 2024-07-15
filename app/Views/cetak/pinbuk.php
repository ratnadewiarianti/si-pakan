<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinbuk</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/pinbuk.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php
    // SET Lokalisasi Tanggal ke Indonesia
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Memecah tanggal menjadi bagian-bagian
    $tanggal_parts = explode('-', $penatausahaan['tanggal']);
    $tanggal = (int)$tanggal_parts[2]; // Mengambil tanggal
    $bulan_index = (int)$tanggal_parts[1]; // Mengambil indeks bulan
    $tahun = $tanggal_parts[0]; // Mengambil tahun

    // Membuat format tanggal dengan nama bulan dalam bahasa Indonesia
    $tanggal_formatted = $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    ?>

    <div class="container">
        <a href="#" class="btn btn-sm btn-dark mb-2" id="printButton">Cetak</a>
        <div class="header">
            <img src="/assets/images/logodinas.jpg" alt="Logo Dinas" class="logo">
            <div>
                <div class="title">PEMERINTAH KABUPATEN TANAH LAUT</div>
                <div class="title1">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
                <div class="sub-title">Jalan A. Syairani Komplek Perkantoran Gagas - Pelaihari 70814</div>
            </div>

        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-1 mb-1">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; padding-right: 50px;">Nomor</td>
                        <td style="text-align: right;vertical-align: top; padding-right: 10px;"> : </td>
                        <td>900/<?= $detailpenatausahaan['id']; ?>-PERCNKEU/DISPUSIP/BP/<?= session()->get('tahun') ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Lampiran</td>
                        <td style="text-align: right;vertical-align: top; padding-right: 10px;"> : </td>
                        <td style="vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Perihal</td>
                        <td style="text-align: right;vertical-align: top; padding-right: 10px;"> : </td>
                        <td style="vertical-align: top;"> Pemindahbukuan Uang/transfer</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;">Pelaihari, <?= $tanggal_formatted; ?></td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row mt-1 mb-1">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; padding-right: 1px;">Kepada Yth.</td>
                        <!-- <td style="vertical-align: top;white-space: nowrap; "></td> -->
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>BANK KALSEL</b></td>
                        <!-- <td style="vertical-align: top;white-space: nowrap;"><b></b></td> -->
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>Cabang Pelaihari</b></td>
                        <!-- <td style="vertical-align: top;white-space: nowrap;"><b></b></td> -->
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">di-</td>
                        <!-- <td style="vertical-align: top;white-space: nowrap;"></td> -->
                    </tr>
                    <tr>
                        <!-- <td style="vertical-align: top;white-space: nowrap; "></td> -->
                        <td style="text-align: left;vertical-align: top; ">&nbsp; &nbsp;&nbsp;&nbsp;Tempat</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-1 mb-1">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; ">Dengan ini kami mohon bantuan Saudara
                            untuk memindahbukukan uang kami untuk ditransferkan</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="text-align: right;vertical-align: top;"> </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="row mt-1 mb-1">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; padding-right: 1px;">Dari Nomor Rekening
                        </td>
                        <td style="text-align: left;vertical-align: top;padding-right: 10px; "> : </td>
                        <td style="vertical-align: top; padding-right: 10px;"><?= $penatausahaan['norek2']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Nama Bendahara</td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;"> <?= $penatausahaan['nama_karyawan_2']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Nominal</td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;">Rp. <?= number_format($jumlahdpa, 0, ',', '.'); ?>,00</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Pada Tanggal</td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;"> <?= $tanggal_formatted; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Kepada pihak ketiga kami dengan rincian
                        </td>

                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Kegiatan </td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;"><?= $kegiatan['nama_kegiatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Sub Kegiatan</td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;"> <?= $detailpenatausahaan['nama_subkegiatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Kode</td>
                        <td style="text-align: left;vertical-align: top; "> : </td>
                        <td style="vertical-align: top;">
                            <?= $detailpenatausahaan['kode_urusan']; ?>.<?= $detailpenatausahaan['kode_bidang_urusan']; ?>.<?= $detailpenatausahaan['kode_program']; ?>.<?= $detailpenatausahaan['kode_kegiatan']; ?>.<?= $detailpenatausahaan['kode_subkegiatan']; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <!-- <label class="sub-title mb-2" style="text-align: Left;">KETERANGAN</label> -->
            <div class="col-md-12">
                <table class="table table-bordered" style="text-align: left; border-color:black;">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align:center; vertical-align:middle;">NO.</th>
                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Nama & Nomor Rekening
                                Penerima</th>
                            <th colspan="4" style="text-align: center; ">Nominal</th>
                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Keterangan</th>
                        </tr>
                        <tr>
                            <th>Total Debit</th>
                            <th>Transfer ke Rekening</th>
                            <th>PPN</th>
                            <th>PPh</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                        <?php foreach ($nama as $n): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $n['nama']; ?> <br> <?= $n['nip']; ?></td>
                            <td><?= $n['nominal']; ?></td>
                            <td><?= $n['nominal']; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tr>
                        <td colspan="2" class="text-center">
                            <d>Jumlah</d>
                        </td>
                        <td><?= number_format($jumlahdpa, 0, ',', '.'); ?>,00</td>
                        <td><?= number_format($jumlahdpa, 0, ',', '.'); ?>,00</td>
                        <td>-</td>
                        <td>-</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-1 mb-1">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; ">Demikian atas bantuan dan kerjasama yang
                            baik kami sampaikan terima kasih</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title3"></div>
                <div class="sub-title3">Bank Kalsel Cabang Pelaihari,</div>
            </div>

            <div class="col-md-6">
                <div class="sub-title3">Dibuat Oleh:</div>
                <div class="sub-title3">Bendahara Pengeluaran,</div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 text-center">
            </div>
            <div class="col-md-6 text-center">
                <?php if (!empty($penatausahaan[0]['ttd_karyawan_2'])) : ?>
                <img src="<?= base_url('uploads/ttd/' . $penatausahaan[0]['ttd_karyawan_2']) ?>" alt="Gambar"
                    width="100" height="100">
                <?php else : ?>
                -
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title3">Pimpinan Cabang</div>
            </div>

            <div class="col-md-6">
                <div class="sub-title3"><?= $penatausahaan['nama_karyawan_2']; ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="sub-title3"></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title3">NIP.<?= $penatausahaan['nip_karyawan_2']; ?></div>
            </div>
        </div>

    </div>



    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function () {
            window.print();
        });
    </script>




</body>

</html>