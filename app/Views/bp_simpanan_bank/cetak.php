<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKU PEMBANTU KAS TUNAI</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/kwitansi.css" rel="stylesheet">
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
    $tanggal_parts = explode('-', $bp_kas_tunai['tanggal']);
    $tanggal = (int)$tanggal_parts[2]; // Mengambil tanggal
    $bulan_index = (int)$tanggal_parts[1]; // Mengambil indeks bulan
    $tahun = $tanggal_parts[0]; // Mengambil tahun

    // Membuat format tanggal dengan nama bulan dalam bahasa Indonesia
    $tanggal_formatted = $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    ?>

    <div class="container">
        <a href="#" class="btn btn-sm btn-dark mb-2" id="printButton">Cetak</a>
        <div class="header">
            <img src="/assets/images/logo_tala.png" alt="Logo Tala" class="logo">
            <div>
                <div class="title">PEMERINTAH KABUPATEN TANAH LAUT</div>
                <div class="title">BUKU PEMBANTU KAS TUNAI</div>
                <div class="sub-title">BENDAHARA PENGELUARAN</div>
            </div>

        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-5 mb-3">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Urusan</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= $bp_kas_tunai['kode_urusan']; ?></td>
                        <td><?= $bp_kas_tunai['nama_urusan']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Bidang</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= $bp_kas_tunai['kode_urusan']; ?>.<?= $bp_kas_tunai['kode_bidang_urusan']; ?></td>
                        <td><?= $bp_kas_tunai['nama_bidang_urusan']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Unit Organisasi</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= $bp_kas_tunai['kode_urusan']; ?>.<?= $bp_kas_tunai['kode_bidang_urusan']; ?>.<?= $bp_kas_tunai['kode_program']; ?>
                        </td>
                        <td><?= $bp_kas_tunai['nama_program']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Sub Unit Organisasi</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top;">
                            <?= $bp_kas_tunai['kode_urusan']; ?>.<?= $bp_kas_tunai['kode_bidang_urusan']; ?>.<?= $bp_kas_tunai['kode_program']; ?>.<?= $bp_kas_tunai['kode_kegiatan']; ?>.<?= $bp_kas_tunai['kode_subkegiatan']; ?>
                            - <?= $bp_kas_tunai['nomenklatur_urusan_provinsi']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <label class="sub-title mb-2" style="text-align: Left;">KETERANGAN</label>
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
                        <?php $no = 1; ?>
                        <?php foreach ($bp_kas_tunai as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['no_bukti']; ?></td>
                            <td><?= $row['id_sub_rincian_objek']; ?></td>
                            <td><?= 'Rp ' . number_format($row['penerimaan'], 0, ',', '.'); ?></td>
                            <td><?= 'Rp ' . number_format($row['pengeluaran'], 0, ',', '.'); ?></td>
                            <td><?= 'Rp ' . number_format($row['saldo'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
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