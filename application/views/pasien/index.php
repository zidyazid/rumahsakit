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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                        </div>
                        <br>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nik Pegawai</th>
                                        <th>Diagnosa</th>
                                        <th>Nama Obat</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($dataPasien as $v) : ?>
                                        <tr>
                                            <td><?= $v["nik"] ?></td>
                                            <td><?= $v["nama"] ?></td>
                                            <td><?= $v["diagnosa"] ?></td>
                                            <td><?= $v["nama_obat"] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- 
        </div> -->
                <!-- /.container-fluid -->

            </div>
    </section>
</div>
</div>