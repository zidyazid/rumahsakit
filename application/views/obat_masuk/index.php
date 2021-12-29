  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $judul; ?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <a href="<?= base_url();  ?>obat_masuk/tambah" class="btn btn-primary"> Tambah Obat Masuk</a>
                </div>


              </div>
              <br>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead>



                    <tr>
                      <th>No.</th>
                      <th>Kode Transaksi</th>
                      <th>Kode Obat</th>
                      <th>Nama Obat</th>
                      <th>Tanggal Masuk</th>
                      <th>Jumlah Masuk</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($obat as $v) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $v["id_transaksi"] ?></td>
                        <td><?= $v["kode_obat"] ?></td>
                        <td><?= $v["nama_obat"] ?></td>
                        <td><?= $v["tanggal_masuk"] ?></td>
                        <td><?= $v["jumlah_masuk"] ?></td>
                        <td><?= $v["harga_perobat"] ?></td>
                        <td>
                          <a href="<?= base_url('obat_masuk/hapusObatMasuk/' . $v["id_transaksi"]) ?>" class="btn btn-danger btn-sm">delete</a>
                          <a href="<?= base_url('obat_masuk/updateObatMasuk/' . $v["id_transaksi"]) ?>" class="btn btn-warning btn-sm">ubah</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
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
        <!-- End of Main Content -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>