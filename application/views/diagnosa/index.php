<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $judul; ?>
        </h1>
        <h1 class="h3 mb-4 text-gray-800">Selamat Datang <span><?= $admin['nama']; ?></span> </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <form action="<?= base_url('diagnosa/index/' . $dataPegawai["nik"]) ?>" method="post">
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="text" class="form-control" id="nik" value="<?= $dataPegawai["nik"] ?>" name="nik" placeholder="nama pegawai">
            </div>
            <div class="form-group">
                <label for="namaPegawai">Nama Pegawai</label>
                <input type="text" class="form-control" id="namaPegawai" value="<?= $dataPegawai["nama"] ?>" name="namaPegawai" placeholder="nama pegawai">
            </div>
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="riwayat">Riwayat Penyakit</label>
                <textarea class="form-control" id="riwayat" name="riwayat" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="kode_obat">Kode Obat</label>
                <select class="form-control" id="kode_obat" name="kode_obat">
                    <?php foreach ($listObat as $v) : ?>
                        <option value="<?= $v["kode_obat"] ?>"><?= $v["nama_obat"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_diambil">Jumlah Diambil</label>
                <input type="text" class="form-control" id="jumlah_diambil" name="jumlah_diambil" placeholder="nama pegawai">
            </div>
            <div class="form-group">
                <label for="tanggal_pengambilan">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" placeholder="nama pegawai">
            </div>

            <button type="submit" class="btn btn-primary">save</button>
        </form>

</div>
</section>
</div>
</div>