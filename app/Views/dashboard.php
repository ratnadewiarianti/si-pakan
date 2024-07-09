<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Target dan Realisasi</p>

                        </div>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="sales-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Belanja</p>

                        </div>
                        <div id="dummy-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="dummy-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php if (!empty($berita)) : ?>
                                    <?php $isFirst = true; ?>
                                    <?php foreach ($berita as $row) : ?>
                                        <div class="carousel-item <?= $isFirst ? 'active' : ''; ?>">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-4">
                                                    <div class="ml-xl-4 mt-3">
                                                        <?php if (pathinfo($row['file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                                            <div style="width: 350px; height: 350px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center;">
                                                                <a href="<?= base_url('uploads/berita/' . $row['file']); ?>" target="_blank" style="display: block; text-align: center; color: #000;">
                                                                    <i class="ti-file" style="font-size: 5em;"></i>
                                                                    <p>PDF File</p>
                                                                </a>
                                                            </div>
                                                        <?php else : ?>
                                                            <a href="<?= base_url('uploads/berita/' . $row['file']); ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/berita/' . $row['file']); ?>" width="350" height="350" alt="<?= $row['judul']; ?>">
                                                            </a>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-xl-8">
                                                    <div class="mt-3">
                                                        <p class="text-muted"><i class="ti-time"></i> <?= date('d-m-Y', strtotime($row['created_at'])); ?></p>
                                                        <h2 class="text-primary"><?= $row['judul']; ?></h2>
                                                        <p style="text-align: justify;" class="mb-2 mb-xl-0"><?= $row['berita']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $isFirst = false; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <!-- Placeholder or message for empty berita -->
                                <?php endif; ?>

                            </div>
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
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
    // Ambil data dari PHP ke JavaScript
    var laporanData = <?= json_encode($laporan) ?>;
    var detailData = <?= json_encode($detailp) ?>;


    var labels = [];
    var paguData = [];
    var realisasiData = [];

    var labelDetail = [];
    var paguDetail = [];
    var realisasiDetail = [];

    detailData.forEach(function(row) {
        labelDetail.push(row.uraian);
        paguDetail.push(row.jumlahdpa);
        realisasiDetail.push(row.totalket);
    });
    // Loop data untuk mengisi array labels, paguData, dan realisasiData
    laporanData.forEach(function(row) {
        labels.push(row.bidang);
        paguData.push(row.jumlahdpa);
        realisasiData.push(row.realisasi);
    });

    var SalesChartCanvas = document.getElementById("sales-chart").getContext("2d");
    var SalesChart = new Chart(SalesChartCanvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Pagu',
                    data: paguData,
                    backgroundColor: '#98BDFF'
                },
                {
                    label: 'Realisasi',
                    data: realisasiData,
                    backgroundColor: '#4B49AC'
                }
            ]
        },
        options: {
            cornerRadius: 5,
            responsive: true,
            maintainAspectRatio: true,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 20,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        color: "#F2F2F2"
                    },
                    ticks: {
                        display: true,
                        min: 50000,
                        max: Math.max(...paguData, ...realisasiData) + 100, // Sesuaikan dengan nilai maksimum dari data
                        callback: function(value, index, values) {
                            return 'Rp' + value;
                        },
                        autoSkip: true,
                        maxTicksLimit: 10,
                        fontColor: "#6C7383"
                    }
                }],
                xAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#6C7383"
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                        display: false
                    },
                    barPercentage: 1
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        },
    });
    document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
    // DUMMY
    // SCRIPT
    var DummyChartCanvas = $("#dummy-chart").get(0).getContext("2d");
    var DummyChart = new Chart(DummyChartCanvas, {
        type: 'bar',
        data: {
            labels: labelDetail,
            datasets: [{
                    label: 'Pagu',
                    data: paguDetail,
                    backgroundColor: '#98BDFF'
                },
                {
                    label: 'Realisasi',
                    data: realisasiDetail,
                    backgroundColor: '#4B49AC'
                }
            ]
        },
        options: {
            cornerRadius: 5,
            responsive: true,
            maintainAspectRatio: true,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 20,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        color: "#F2F2F2"
                    },
                    ticks: {
                        display: true,
                        min: 50000,
                        max: Math.max(...paguDetail, ...realisasiDetail) + 100, // Sesuaikan dengan nilai maksimum dari data
                        callback: function(value, index, values) {
                            return 'Rp' + value;
                        },
                        autoSkip: true,
                        maxTicksLimit: 10,
                        fontColor: "#6C7383"
                    }
                }],
                xAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#6C7383"
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                        display: false
                    },
                    barPercentage: 1
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
    document.getElementById('dummy-legend').innerHTML = DummyChart.generateLegend();
</script>
<?= $this->endSection() ?>