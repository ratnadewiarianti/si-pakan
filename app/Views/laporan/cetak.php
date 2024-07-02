<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SI SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/sispj.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <a href="#" class="btn btn-sm btn-dark mb-2" id="printButton">Cetak</a>
        <div class="row mt-2">
            <div class="col-md-6">
                <table class="table-borderless" style="text-align: right;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top; padding-right: 2"><b>Nama
                                Subkegiatan</b></td>
                        <td style="text-align: left;padding-right: 8px;"> : </td>
                        <td style="text-align: left;vertical-align: top;padding-right: 79px;"><?= $laporan[0]['nama_subkegiatan']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;"><b>Pagu Per Sub Kegiatan</b></td>
                        <td style="text-align: right;"> <b>:</b> </td>
                        <td style="vertical-align: top; white-space: nowrap;"><?= 'Rp ' . number_format($laporan[0]['jumlahdpa'], 0, ',', '.'); ?></td>
                        <td style="text-align: right;padding-right: 50px;"></td>
                        <td style="white-space: nowrap;vertical-align: top;"><b>Realisasi Sub Kegiatan</b></td>
                        <td style="text-align: right;"> <b>:</b></td>
                        <td style="vertical-align: top; white-space: nowrap;"><?= 'Rp ' . number_format($laporan[0]['realisasi'], 0, ',', '.'); ?></td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-bordered" style="text-align: left; border-color:black;">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th>Kode Rekening</th>
                            <th>Uraian</th>
                            <th>Pagu Rekening</th>
                            <th>Realisasi Per Rekening</th>
                            <th>Persen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($laporan as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kode_akun']; ?>.<?= $row['kode_kelompok']; ?>.<?= $row['kode_jenis']; ?>.<?= $row['kode_objek']; ?>.<?= $row['kode_rincian_objek']; ?>.<?= $row['kode_sub_rincian_objek']; ?>
                                </td>
                                <td><?= $row['uraian_sub_rincian_objek']; ?></td>
                            <td><?= 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'); ?></td>
                            <td><?= 'Rp ' . number_format($row['realisasi'], 0, ',', '.'); ?></td>
                            <td>
                                <?php 
                                     if ($row['jumlahdpa'] != 0) 
                                     {
                                        $persentase_realisasi = ($row['realisasi'] / $row['jumlahdpa']) * 100; 
                                        echo number_format($persentase_realisasi, 2) . '%';
                                    } else {
                                       echo 'N/A'; // Jika jumlah DPA adalah 0, maka tidak bisa dihitung
                                    }
                                ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data Laporan SI SPJ.</td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>





    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        document.getElementById("printButton").addEventListener("click", function () {
            window.print();
        });
    </script>
</body>

</html>