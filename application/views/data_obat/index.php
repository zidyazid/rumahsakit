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
                  <a href="<?= base_url();  ?>data_obat/tambah" class="btn btn-primary"> Tambah Obat Baru</a>
                </div>


              </div>
              <br>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead>



                    <tr>
                      <th>No.</th>
                      <th>Nama Obat</th>
                      <th>Stok</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($obat as $v) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $v["nama_obat"] ?></td>
                        <td><?= $v["total_stok"] ?></td>
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