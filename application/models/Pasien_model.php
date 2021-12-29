<?php

class Pasien_model extends CI_Model
{

	public function getAllPasien()
	{
		return $this->db->query('SELECT *
		 FROM  `pasien` ORDER BY kd_rm DESC');
	}

	function tambah_data()
	{
		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'golongan' => $this->input->post('golongan'),
			'umur' => $this->input->post('umur'),
			'delete_status' => 0,
		];

		$this->db->insert('pegawai', $data);
	}

	public function hapus_data($kd_rm)
	{
		$this->db->where('kd_rm', $kd_rm);
		$this->db->delete('pasien');
	}

	public function getPasienById($nik)
	{
		return $this->db->get_where('pegawai', ['nik' => $nik])->row_array();
	}

	public function getPasienByTanggal()
	{
		$query = "SELECT `pasien`.`tanggal_lahir`
		          FROM  `pasien` 
		          ORDER BY `tanggal_lahir` DESC ";
		$tanggal = $this->db->query($query)->result_array();
		return $tanggal;
	}

	public function getAllPasienSortKd()
	{

		// $query = "SELECT `pasien`.`kd_pasien`
		// FROM `rekam_medis`
		// LEFT JOIN `pasien`
		// ON `pasien`.`id_pasien`=`rekam_medis`.`id_pasien`
		// ORDER BY `rekam_medis`.`id_rm`";
		// $pasien = $this->db->query($query)->result_array();
		//       return $pasien;

		$query = "SELECT `pasien`.`kd_rm` , `pasien`.`nama_pasien`
		 FROM  `pasien` ";
		$pasien = $this->db->query($query)->result_array();
		return $pasien;
	}

	public function ubah_data()
	{
		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'golongan' => $this->input->post('golongan'),
			'umur' => $this->input->post('umur'),
			'delete_status' => 0,

		];
		$this->db->where('nik', $this->input->post('nik'));
		$this->db->update('pegawai', $data);
	}
	public function ubah_delete_status($nik)
	{
		$data = [
			'delete_status' => 1,
		];
		$this->db->where('nik', $nik);
		$this->db->update('pegawai', $data);
	}

	function jumlahpasien()
	{
		$query = $this->db->get('pasien');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}



	public function kd_rm()
	{
		$this->db->select('*');
		$this->db->from('pasien');
		return $query = $this->db->get()->result();
	}

	public function kd_pasien()
	{
		$this->db->select('*');
		$this->db->from('pasien');
		return $query = $this->db->get()->result();
	}


	public function view_by_kd_rm($kd_rm)
	{
		$this->db->select('*');
		$this->db->from('pasien');
		$this->db->where('pasien.kd_rm', $kd_rm);
		$this->db->order_by('pasien.kd_rm');
		return $query = $this->db->get()->result_array(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function view_by_kd_pasien($kd_rm)
	{
		$this->db->select('*');
		$this->db->from('pasien');
		$this->db->where('pasien.kd_rm', $kd_rm);
		$this->db->order_by('pasien.kd_rm');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function view_by_year($tahun)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.nis = siswa.nis');
		$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
		$this->db->join('bulan', 'transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = transaksi.id_tahun');
		$this->db->join('user', 'transaksi.user_id = user.user_id');
		$this->db->where('transaksi.id_tahun="' . $tahun . '"');
		$this->db->order_by('transaksi.id_tahun');
		return $query = $this->db->get();
	}

	function view_all()
	{

		$this->db->select('*');
		$this->db->from('pasien');
		return $query = $this->db->get()->result_array();
	}
}
