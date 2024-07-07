<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKU PEMBANTU KAS TUNAI</title>
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
    if (!empty($bp_kas_tunai)) {
        $tanggal_formatted = isset($bp_kas_tunai['tanggal']) ? formatTanggalIndonesia($bp_kas_tunai['tanggal'], $bulan) : 'Tanggal tidak ditemukan';
        $tgl_mulai_formatted = isset($bp_kas_tunai['tgl_mulai']) ? formatTanggalIndonesia($bp_kas_tunai['tgl_mulai'], $bulan) : 'Tanggal mulai tidak ditemukan';
        $tgl_selesai_formatted = isset($bp_kas_tunai['tgl_selesai']) ? formatTanggalIndonesia($bp_kas_tunai['tgl_selesai'], $bulan) : 'Tanggal selesai tidak ditemukan';
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
                <div class="title1">BUKU PEMBANTU KAS TUNAI</div>
                <div class="sub-title1">BENDAHARA PENGELUARAN</div>
                <div class="sub-title"> Periode <?= $tgl_mulai_formatted; ?> s/d <?= $tgl_selesai_formatted; ?></div>
            </div>
        </div>

        <table class="table-borderless" style="text-align: left;">
            <tr>
                <td style="white-space: nowrap;vertical-align: top; padding-right: 79px;"><b>Urusan</b></td>
                <td style="text-align: left;padding-right: 8px;"> : </td>
                <td style="text-align: left;vertical-align: top;padding-right: 79px;">2</td>
                <td style="text-align: left;vertical-align: top;">Urusan Wajib Bukan Pelayanan Dasar</td>
            </tr>
            <tr>
                <td style="vertical-align: top;white-space: nowrap;"><b>Bidang</b></td>
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
                        <th>NO.</th>
                        <th>TGL</th>
                        <th>NO. BUKTI</th>
                        <th>URAIAN</th>
                        <th>KODE REK</th>
                        <th>PENERIMAAN</th>
                        <th>PENGELUARAN</th>
                        <th>SALDO</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>0,00</td>
                            <td>0,00</td>
                            <td>0,00</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;padding-right: 239px;">Jumlah periode ini
                        </td>
                        <td style="text-align: right;vertical-align: top;padding-right: 79px;">0,00</td>
                        <td style="text-align: right;vertical-align: top;padding-right: 100px;">0,00</td>
                        <td style="text-align: right;vertical-align: top;"></td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Jumlah sampai periode lalu</td>
                        <td style="text-align: left;vertical-align: top;">0,00</td>
                        <td style="text-align: left;vertical-align: top;">0,00</td>
                        <td style="text-align: left;vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Jumlah semua sampai periode ini</td>
                        <td style="text-align: left;vertical-align: top;">0,00</td>
                        <td style="text-align: left;vertical-align: top;">0,00</td>
                        <td style="text-align: left;vertical-align: top;"></td>

                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Sisa Kas</td>
                        <td style="text-align: left;vertical-align: top;"></td>
                        <td style="text-align: left;vertical-align: top; "></td>
                        <td style="text-align: left;vertical-align: top;">0,00</td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Kas di Bendahara Pengeluaran - Tunai <b>Rp.
                                0,00</b></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap; font-style: italic;">(Nol rupiah)</td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title2">Mengetahui,</div>
                <div class="sub-title2"><b><?= $kepala_dinas['jabatan']; ?></b></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2">Pelaihari, <?= $tanggal_formatted; ?></div>
                <div class="sub-title2"><b><?= $bendahara_pengeluaran['jabatan']; ?></b></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 text-center">
                <?php if (!empty($kepala_dinas['file'])) : ?>
                    <img src="<?= base_url('uploads/ttd/' . $kepala_dinas['file']) ?>" alt="Gambar" width="100" height="100">
                <?php else : ?>
                    -
                <?php endif; ?>
            </div>
            <div class="col-md-6 text-center">
                <?php if (!empty($bendahara_pengeluaran['file'])) : ?>
                    <img src="<?= base_url('uploads/ttd/' . $bendahara_pengeluaran['file']) ?>" alt="Gambar" width="100" height="100">
                <?php else : ?>
                    -
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="sub-title2"><?= $kepala_dinas['nama']; ?></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2"><?= $bendahara_pengeluaran['nama']; ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="sub-title2">NIP. <?= $kepala_dinas['nip']; ?></div>
            </div>

            <div class="col-md-6">
                <div class="sub-title2">NIP. <?= $bendahara_pengeluaran['nip']; ?></div>
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