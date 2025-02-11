<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Detail Penatausahaan</h4>
                        <form class="forms-sample" action="/detailpenatausahaan/store" method="post">

                            <input type="hidden" name="id_penatausahaan" value="<?= service('uri')->getSegment(3); ?>" class="form-control" required>

                            <div class="form-group">
                                <label>Subkegiatan</label>
                                <select class="form-control" name="id_detail_dpa" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($detaildpa as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama_subkegiatan']; ?>, <?= $key['uraian_sub_rincian_objek']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group" id="rincian-container">
                                <!-- Dynamic fields will be added here -->
                            </div>

                            <div class="form-group">
                                <label>Untuk Pembayaran</label>
                                <textarea name="untuk_pembayaran" required class="form-control" style="min-height:100px"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Apakah Memiliki pajak?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="berisi_pajak" value="Ya" required onclick="togglePajakOptions(true)"> Ya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="berisi_pajak" value="Tidak" required onclick="togglePajakOptions(false)"> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="pajak-options" style="display: none;">
                                <label>Pajak</label>
                                <div id="pajak-container"></div>
                                <button type="button" class="btn btn-primary mt-2" onclick="addPajakField()">Tambah Pajak</button>
                            </div>

                            <input type="text" name="sudah_terima_dari" value="BENDAHARA PENGELUARAN DINAS PERPUSTAKAAN DAN KEARSIPAN" class="form-control" hidden required>
                            <input type="text" name="status_verifikasi" value="MENUNGGU" class="form-control" hidden required>
                            <input type="text" name="verifikasi_bendahara" value="MENUNGGU" class="form-control" hidden required>
                            <input type="text" name="verifikasi_kasubbag" value="MENUNGGU" class="form-control" hidden required>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="/detailpenatausahaan/show/<?= service('uri')->getSegment(3); ?>" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Add any additional CSS here -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function togglePajakOptions(show) {
        var pajakOptions = document.getElementById('pajak-options');
        var pajakContainer = document.getElementById('pajak-container');

        if (show) {
            pajakOptions.style.display = 'block';
            // Add an initial tax field if none exists
            if (pajakContainer.children.length === 0) {
                addPajakField();
            }
        } else {
            pajakOptions.style.display = 'none';
            // Remove all children (tax fields)
            while (pajakContainer.firstChild) {
                pajakContainer.removeChild(pajakContainer.firstChild);
            }
        }
    }

    function addPajakField() {
        var container = document.getElementById('pajak-container');
        // Check if there are already 2 fields
        if (container.children.length >= 2) {
            alert("Anda Hanya Bisa Menambahkan Maksimal 2 Pajak");
            return;
        }

        var div = document.createElement('div');
        div.className = 'pajak-entry form-group';
        div.style.display = 'flex';
        div.style.alignItems = 'center';
        div.style.marginBottom = '10px';

        var select = document.createElement('select');
        select.name = 'id_pajak[]';
        select.className = 'form-control js-example-basic-single w-100';
        select.required = true;
        select.style.marginRight = '10px';
        select.innerHTML = `<option selected disabled>Pilih Pajak</option>
                            <?php foreach ($pajak as $key) : ?>
                                <option value="<?= $key['id']; ?>"><?= $key['nama_pajak']; ?> </option>
                            <?php endforeach; ?>`;

        var input = document.createElement('input');
        input.type = 'number';
        input.name = 'jumlah_p[]';
        input.className = 'form-control';
        input.placeholder = 'Jumlah Pajak';
        input.required = true;
        input.style.marginRight = '10px';

        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger';
        button.innerText = 'Hapus';
        button.onclick = function() {
            container.removeChild(div);
        };

        div.appendChild(select);
        div.appendChild(input);
        div.appendChild(button);

        container.appendChild(div);
    }
</script>

<script>
    function loadRincian(id) {
        if (id) {
            $.ajax({
                url: `/detailpenatausahaan/selectrincian/${id}`,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    let rincianContainer = document.getElementById('rincian-container');
                    rincianContainer.innerHTML = ''; // Clear existing options

                    if (data.length > 0) {
                        addRincianField(data);
                        let addButton = document.getElementById('add-rincian-btn');
                        if (!addButton) {
                            addButton = document.createElement('button');
                            addButton.type = 'button';
                            addButton.className = 'btn btn-primary mt-2';
                            addButton.id = 'add-rincian-btn';
                            addButton.innerText = 'Tambah Rincian';
                            addButton.onclick = function() {
                                addRincianField(data);
                            };
                            rincianContainer.appendChild(addButton);
                        }
                    }
                },
                error: function() {
                    alert('Gagal memuat rincian.');
                }
            });
        }
    }

    function addRincianField(data) {
        var container = document.getElementById('rincian-container');

        var div = document.createElement('div');
        div.className = 'rincian-entry form-group';
        div.style.display = 'flex';
        div.style.alignItems = 'center';
        div.style.marginBottom = '10px';

        var label = document.createElement('label');
        label.innerText = 'Rincian';
        label.style.marginRight = '10px';
        div.appendChild(label);

        var select = document.createElement('select');
        select.name = 'id_detail_dpa_subkegiatan[]';
        select.className = 'form-control js-example-basic-single w-100';
        select.required = true;
        select.style.marginRight = '10px';

        select.innerHTML = `<option selected disabled>Pilih Rincian</option>`;
        data.forEach(function(item) {
            select.innerHTML += `<option value="${item.id}">${item.uraian}, koefisien: ${item.koefisien}, satuan: ${item.satuan}, harga: ${item.harga}</option>`;
        });

        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger';
        button.innerText = 'Hapus';
        button.onclick = function() {
            container.removeChild(div);
        };

        div.appendChild(select);
        div.appendChild(button);

        container.insertBefore(div, container.querySelector('#add-rincian-btn') || null);
    }

    document.querySelector('[name="id_detail_dpa"]').addEventListener('change', function() {
        loadRincian(this.value);
    });
</script>



<?= $this->endSection() ?>