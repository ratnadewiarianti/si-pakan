<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
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
                <div class="title">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
            </div>

        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-5 mb-3">
            <div class="col-md-8">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;">TAHUN ANGGARAN</td>
                        <td style="text-align: right;"> : </td>
                        <td>2023</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">PROGRAM</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= $program['kode_program']; ?> - <?= $program['nama_program']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">KEGIATAN</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top;"> <?= $kegiatan['kode_kegiatan']; ?> - <?= $kegiatan['nama_kegiatan']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">SUB. KEGIATAN</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top;"> <?= $detailpenatausahaan['kode_urusan']; ?>.<?= $detailpenatausahaan['kode_bidang_urusan']; ?>.<?= $detailpenatausahaan['kode_program']; ?>.<?= $detailpenatausahaan['kode_kegiatan']; ?>.<?= $detailpenatausahaan['kode_subkegiatan']; ?> - <?= $detailpenatausahaan['nomenklatur_urusan_provinsi']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">KODE REKENING</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top;"> <?= $detailpenatausahaan['kode_rekening']; ?> - <?= $detailpenatausahaan['uraian_sub_rincian_objek']; ?></td>
                    </tr>

                </table>
            </div>
            <div class="col-md-4">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;">NO. BK. UMUM</td>
                        <td style="text-align: right;"> : </td>
                        <td style="vertical-align: top; white-space: nowrap;"> <?= $detailpenatausahaan['no_bk_umum']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">NO. BK. PEMBANTU</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top; white-space: nowrap;"> <?= $detailpenatausahaan['no_bk_pembantu']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;">Asli I - II - III</td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top; white-space: nowrap;"> <?= $detailpenatausahaan['asli_123']; ?></td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="sub-header">
            <div>
                <div class="title">KWITANSI</div>
            </div>
        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;"><b>SUDAH TERIMA DARI</b></td>
                        <td style="text-align: right;"> : </td>
                        <td> <?= $detailpenatausahaan['sudah_terima_dari']; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>UANG SEBANYAK</b></td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td class="border-jajar-genjang">
                            <p style="text-align: center; margin: 10px;font-weight: bold; font-size: 14px;"><?= $detailpenatausahaan['uang_sebanyak']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>UNTUK PEMBAYARAN</b></td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td style="vertical-align: top;text-align: justify;">
                            <?= $detailpenatausahaan['untuk_pembayaran']; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <table class="table-borderless" style="text-align: left;">
                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;">Keterangan</td>
                        <td style="text-align: right;"> : </td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>Pajak Deaerah</b></td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= 'Rp ' . number_format($detailpenatausahaan['pajak_daerah'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;white-space: nowrap;"><b>PPH 21</b></td>
                        <td style="text-align: right;vertical-align: top;"> : </td>
                        <td> <?= 'Rp ' . number_format($detailpenatausahaan['pph21'], 0, ',', '.'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                <!-- kosong -->
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="garis-container">
                    <div class="garis-atas"></div>
                    <div class="content"><b>Terbilang Rp. </b> <span class="jajar-genjang"><b>
                                <td> <?= 'Rp ' . number_format($detailpenatausahaan['terbilang'], 0, ',', '.'); ?></td>
                            </b></span>
                    </div>
                    <div class="garis-bawah"></div>
                </div>

            </div>
            <div class="col-md-9">
                <!-- kosong -->
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="sub-title">Setuju dibayar</div>
                <div class="sub-title">Pengguna Anggaran</div>
            </div>
            <div class="col-md-4">
                <div class="sub-title">Telah dibayar lunas pada tanggal <?= $tanggal_formatted; ?></div>
                <div class="sub-title">Bendahara Pengeluaran</div>
            </div>
            <div class="col-md-4">
                <div class="sub-title">Pelaihari, <?= $tanggal_formatted; ?></div>
                <div class="sub-title">Tanda tangan yang menerima</div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 text-center">
                <?= !empty($penatausahaan['ttd_karyawan_1']) ? '<img src="' . base_url('uploads/ttd/' . $penatausahaan['ttd_karyawan_1']) . '" alt="Gambar" width="100" height="100">' : '-' ?>
            </div>
            <div class="col-md-4 text-center">
                <?= !empty($penatausahaan['ttd_karyawan_2']) ? '<img src="' . base_url('uploads/ttd/' . $penatausahaan['ttd_karyawan_2']) . '" alt="Gambar" width="100" height="100">' : '-' ?>
            </div>
            <div class="col-md-4 text-center">
                <?= !empty($penatausahaan['ttd_karyawan_3']) ? '<img src="' . base_url('uploads/ttd/' . $penatausahaan['ttd_karyawan_3']) . '" alt="Gambar" width="100" height="100">' : '-' ?>
            </div>
        </div>
        <div class="row mt-2 mb-3">
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $penatausahaan['nama_karyawan_1']; ?></u></b></div>
                <div class="sub-title"><?= $penatausahaan['nip_karyawan_1']; ?></div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $penatausahaan['nama_karyawan_2']; ?></u></b></div>
                <div class="sub-title"><?= $penatausahaan['nip_karyawan_2']; ?></div>
            </div>
            <div class="col-md-4 ">
                <table class="table-borderless table-centered" style="text-align: left;">
                    <tr>
                        <td style=" font-size:14px; white-space: nowrap;vertical-align: top;">Nama</td>
                        <td style=" font-size:14px; text-align: right;vertical-align: top;"> : </td>
                        <td style=" font-size:14px; vertical-align: top;white-space: nowrap"> <?= $penatausahaan['nama_karyawan_3']; ?></td>
                    </tr>
                    <tr>
                        <td style=" font-size:14px; white-space: nowrap;vertical-align: top;">NIP</td>
                        <td style=" font-size:14px; text-align: right;vertical-align: top;"> : </td>
                        <td style=" font-size:14px; vertical-align: top;"> <?= $penatausahaan['nip_karyawan_3']; ?></td>
                    </tr>
                    <tr>
                        <td style=" font-size:14px; white-space: nowrap;vertical-align: top;">Jabatan</td>
                        <td style=" font-size:14px; text-align: right;vertical-align: top;"> : </td>
                        <td style=" font-size:14px; vertical-align: top;"> <?= $penatausahaan['jabatan_karyawan_3']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="page-break mb-3"></div>
    <?php if (!empty($keterangan)) : ?>
        <div class="container">
            <div class="header">
                <img src="/assets/images/logodinas.jpg" alt="Logo Dinas" class="logo">
                <div>
                    <div class="title">PEMERINTAH KABUPATEN TANAH LAUT</div>
                    <div class="title">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
                </div>
            </div>
            <!-- Konten kwitansi -->
            <div class="row mt-4">
                <label class="sub-title mb-2" style="text-align: Left;">KETERANGAN</label>
                <div class="col-md-12">
                    <table class="table table-bordered" style="text-align: left; border-color:black;">
                        <thead>
                            <th>No</th>
                            <th>Keperluan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $total_semua = 0; ?> <!-- Variabel untuk menyimpan total -->
                            <?php foreach ($keterangan as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['keperluan']; ?></td>
                                    <td><?= 'Rp ' . number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td><?= 'Rp ' . number_format($row['total'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php $total_semua += $row['total']; ?> <!-- Menambahkan total pada setiap iterasi -->
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4"><b>Jumlah Total</b></td>
                                <td><b><?= 'Rp ' . number_format($total_semua, 0, ',', '.'); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php endif; ?>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>
</body>

</html>