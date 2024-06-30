<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKU PEMBANTU PAJAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/laporan.css" rel="stylesheet">
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

    // Fungsi untuk memformat tanggal ke dalam format Indonesia
    function formatTanggalIndonesia($tanggal, $bulan)
    {
        $tanggal_parts = explode('-', $tanggal);
        $tanggal = (int)$tanggal_parts[2]; // Mengambil tanggal
        $bulan_index = (int)$tanggal_parts[1]; // Mengambil indeks bulan
        $tahun = $tanggal_parts[0]; // Mengambil tahun
        return $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    }

    // Pastikan $bp_kas_tunai tidak kosong dan memiliki kunci 'tanggal', 'tgl_mulai', dan 'tgl_selesai'
    if (!empty($bp_pajak)) {
        $tanggal_formatted = isset($bp_pajak[0]['tanggal']) ? formatTanggalIndonesia($bp_pajak[0]['tanggal'], $bulan) : 'Tanggal tidak ditemukan';
        $tgl_mulai_formatted = isset($bp_pajak[0]['tgl_mulai']) ? formatTanggalIndonesia($bp_pajak[0]['tgl_mulai'], $bulan) : 'Tanggal mulai tidak ditemukan';
        $tgl_selesai_formatted = isset($bp_pajak[0]['tgl_selesai']) ? formatTanggalIndonesia($bp_pajak[0]['tgl_selesai'], $bulan) : 'Tanggal selesai tidak ditemukan';
    } else {
        $tanggal_formatted = 'Tanggal tidak ditemukan';
        $tgl_mulai_formatted = 'Tanggal mulai tidak ditemukan';
        $tgl_selesai_formatted = 'Tanggal selesai tidak ditemukan';
    }
    ?>

    <div class="container">
        <a href="#" class="btn btn-sm btn-dark mb-2" id="printButton">Cetak</a>
        <div class="header">
            <img src="/assets/images/logo_tala.png" alt="Logo Tala" class="logo">
            <div>
                <div class="title">PEMERINTAH KABUPATEN TANAH LAUT</div>
                <div class="title1">BUKU PEMBANTU PAJAK</div>
                <div class="sub-title1">BENDAHARA PENGELUARAN</div>
                <div class="sub-title"> Periode <?= $tgl_mulai_formatted; ?> s/d <?= $tgl_selesai_formatted; ?></div>
            </div>
        </div>

        <table class="table-borderless" style="text-align: left;">
            <tr>
                <td style="white-space: nowrap;vertical-align: top; padding-right: 79px;"><b>Urusan Pemerintahan</b></td>
                <td style="text-align: left;padding-right: 8px;"> : </td>
                <td style="text-align: left;vertical-align: top;padding-right: 79px;">2</td>
                <td style="text-align: left;vertical-align: top;">Urusan Wajib Bukan Pelayanan Dasar</td>
            </tr>
            <tr>
                <td style="vertical-align: top;white-space: nowrap;"><b>Bidang Pemerintahan</b></td>
                <td style="text-align: left;vertical-align: top;"> : </td>
                <td style="text-align: left;vertical-align: top;"> 2.17 </td>
                <td style="text-align: left;vertical-align: top;"> Perpustakaan </td>
            </tr>
            <tr>
                <td style="vertical-align: top;white-space: nowrap;"><b>Unit Organisasi</b></td>
                <td style="text-align: left;vertical-align: top;"> : </td>
                <td style="text-align: left;vertical-align: top;"> 2.17.01</td>
                <td style="text-align: left;vertical-align: top;"> Dinas Perpustakaan dan Kearsipan</td>
            </tr>
            <tr>
                <td style="vertical-align: top;white-space: nowrap;"><b>Sub Unit Organisasi</b></td>
                <td style="text-align: left;vertical-align: top;"> : </td>
                <td style="text-align: left;vertical-align: top;"> 2.17.01.01</td>
                <td style="text-align: left;vertical-align: top;"> Dinas Perpustakaan dan Kearsipan</td>
            </tr>
        </table>


        <div class="row mt-4">
            <!-- <label class="sub-title mb-2" style="text-align: Left;">KETERANGAN</label> -->
            <div class="col-md-12">
                <table class="table table-bordered" style="text-align: left; border-color:black;">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>TGL</th>
                            <th>NO. BUKTI</th>
                            <th>URAIAN</th>
                            <th>PEMOTONGAN</th>
                            <th>PENYETORAN</th>
                            <th>SALDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Saldo</td>
                            <td>-</td>
                            <td>0,00</td>
                            <td>0,00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td>Saldo Awal</td>
                            <td>0,00</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <?php $no = 2; ?>
                        <?php foreach ($data as $row) : ?>
                            <?php if ($row['type'] == 'detail') : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= (new DateTime($row['tanggal']))->format('d/m/Y') ?></td>
                                    <td><?= $row['no_bukti'] ?></td>
                                    <td><?= $row['uraian'] ?></td>
                                    <td><?= number_format($row['pemotongan'], 2, ',', '.') ?></td>
                                    <td>-</td>
                                    <td><?= number_format($row['pemotongan'], 2, ',', '.') ?></td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><?= $row['no_bukti'] ?></td>
                                    <td><?= $row['uraian'] ?></td>
                                    <td>-</td>
                                    <td><?= number_format($row['penyetoran'], 2, ',', '.') ?></td>
                                    <td>-</td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title2">Mengetahui,</div>
                <div class="sub-title2"><b><?= $bp_pajak[0]['jabatan_kepala_dinas']; ?></b></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2">Pelaihari, <?= $tanggal_formatted; ?></div>
                <div class="sub-title2"><b><?= $bp_pajak[0]['jabatan_bendahara']; ?></b></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 text-center">
                <?php if (!empty($bp_pajak[0]['ttd_kepala_dinas'])) : ?>
                    <img src="<?= base_url('uploads/ttd/' . $bp_pajak[0]['ttd_kepala_dinas']) ?>" alt="Gambar" width="100" height="100">
                <?php else : ?>
                    -
                <?php endif; ?>
            </div>
            <div class="col-md-6 text-center">
                <?php if (!empty($bp_pajak[0]['ttd_bendahara'])) : ?>
                    <img src="<?= base_url('uploads/ttd/' . $bp_pajak[0]['ttd_bendahara']) ?>" alt="Gambar" width="100" height="100">
                <?php else : ?>
                    -
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title2"><?= $bp_pajak[0]['kepala_dinas_nama']; ?></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2"><?= $bp_pajak[0]['bendahara_nama']; ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="sub-title2">NIP. <?= $bp_pajak[0]['kepala_dinas']; ?></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2">NIP. <?= $bp_pajak[0]['bendahara_pengeluaran']; ?></div>
            </div>
        </div>






    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>
</body>

</html>