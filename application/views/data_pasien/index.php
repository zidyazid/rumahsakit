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
              <div class="col-sd-4">
                <a href="<?= base_url();  ?>data_pasien/tambah" class="btn btn-primary"> Tambah Data Pegawai</a>
              </div>
            </div>
            <br>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Golongan</th>
                    <th>Umur</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($data_pegawai as $d) : ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td>
                        <a href="<?= base_url('diagnosa/index/' . $d['nik']) ?>"><?= $d['nik'] ?></a>
                      </td>
                      <td><?= $d['nama'] ?></td>
                      <td><?= $d['alamat'] ?></td>
                      <td><?= $d['tanggal_lahir'] ?></td>
                      <td><?= $d['golongan'] ?></td>
                      <td><?= $d['umur'] ?></td>
                      <td>
                        <a href="<?= base_url('data_pasien/hapus/' . $d['nik']);  ?>" class="btn btn-danger btn-small">delete</a>
                        <a href="<?= base_url('data_pasien/ubah/' . $d['nik']);  ?>" class="btn btn-warning btn-small">update</a>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 
        </div> -->
      <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->