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

                  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.css'); ?>" />
                  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script> <!-- Load file jquery -->

                  <div class="card-body">
                    <h3><?php echo $ket; ?></h3>
                    <a target="_blank" href="<?php echo $url_cetak; ?>" class="btn btn-default"><i class="fa fa-print"></i>CETAK PDF</a>

                    <div class="box-body">
                      <table id="example2" class="table table-bordered table-striped ">
                        <thead style="text-align: center">
                          <tr>
                            <th>NO</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Masuk</th>
                            <th>Tanggal Masuk</th>
                            <!-- <th >Petugas</th>                     -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (!empty($obat_masuk)) {
                            $no = 1;
                            foreach ($obat_masuk as $data) {
                          ?>
                              <tr>
                                <td style="text-align: center;"><?php echo $no++ ?></td>
                                <td><?php echo $data['kode_obat']; ?></td>
                                <td><?php echo $data['nama_obat']; ?></td>
                                <!-- <td><?php echo 'Rp. ' . number_format($data->subtotal, 0, ',', '.') ?></td> -->
                                <td><?php echo $data['jumlah_masuk'] ?></td>
                                <td><?php echo $data['tanggal_masuk'] ?></td>
                              </tr>
                          <?php }
                          }
                          ?>
                        </tbody>

                        <script src="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
                        <script>
                          $(document).ready(function() { // Ketika halaman selesai di load

                            $('#form-tanggal, #form-tanggal2, #form-kd_rm, #form-kd_pasien').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

                            $('#filter').change(function() { // Ketika user memilih filter
                              if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                $('#form-tanggal2, #form-kd_resep').hide();
                                $('#form-tanggal').show(); // Tampilkan form tanggal
                                $('#form-tanggal2').show(); // Tampilkan form tanggal
                              } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                $('#form-tanggal, #form-tanggal2, #form-kd_pasien, #form-bulan').hide();
                                $('#form-kd_rm').show(); // Tampilkan form bulan dan tahun
                              } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                                $('#form-tanggal, #form-tanggal2, ##form-kd_rm').hide();
                                $('#form-kelas, #form-tahun').show(); // Tampilkan form bulan dan tahun
                              } else { // Jika filternya 3 (per tahun)
                                $('#form-tanggal, #form-tanggal2, #form-nis, #form-kelas, #form-tahun').hide();
                              }

                              $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                            })
                          })
                        </script>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.container-fluid -->