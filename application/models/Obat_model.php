<?php

class Obat_model extends CI_Model
{

	public function getAllObat()
	{
		return $this->db->query('SELECT *
		 FROM  `obat` ORDER BY nama_obat ASC');
	}
	function tambah_data()
	{
		$data = [
			'kode_obat' => $this->input->post('kode_obat'),
			'nama_obat' => $this->input->post('nama_obat'),
			'jumlah_masuk' => $this->input->post('jumlah_masuk'),
			'after_update' => 0,
			'harga_perobat' => $this->input->post('harga_perobat'),
			'tanggal_masuk' => $this->input->post('tgl_masuk'),
			'delete_status' => 0,
		];

		$this->db->insert('masuk_obat', $data);
	}

	public function hapus_data($id_obat)
	{
		$this->db->where('id_obat', $id_obat);
		$this->db->delete('obat');
	}

	public function getObatById($id_obat)
	{
		return $this->db->get_where('obat', ['id_obat' => $id_obat])->row_array();
	}

	public function ubah_data()
	{
		$data = [
			'nama_obat' => $this->input->post('nama_obat'),
			'stok' => $this->input->post('stok'),
			'harga' => $this->input->post('harga')
		];

		$this->db->where('id_obat', $this->input->post('id_obat'));
		$this->db->update('obat', $data);
	}
	public function updateObatMasuk($idTransaksi)
	{
		$data = [
			'kode_obat' => $this->input->post('kode_obat'),
			'nama_obat' => $this->input->post('nama_obat'),
			'jumlah_masuk' => $this->input->post('jumlah_masuk'),
			'harga_perobat' => $this->input->post('harga_perobat'),
			'tanggal_masuk' => $this->input->post('tgl_masuk'),
			'delete_status' => 0,
		];

		$this->db->where('id_transaksi', $idTransaksi);
		$this->db->update('masuk_obat', $data);
	}
	public function updateStok($total)
	{
		$data = [
			'total_stok' => $total
		];

		$this->db->where('kode_obat', $this->input->post('kode_obat'));
		$this->db->update('stok_obat', $data);
	}
	public function updateStokWithIDTransaksi($total, $kodeobat)
	{
		$data = [
			'total_stok' => $total
		];

		$this->db->where('kode_obat', $kodeobat);
		$this->db->update('stok_obat', $data);
	}

	function getAllObatSortNama()
	{
		$query = "SELECT `obat`.`id_obat` , `obat`.`nama_obat`
		 FROM  `obat` ORDER BY nama_obat ASC ";
		$obat = $this->db->query($query);
		return $obat;
	}

	function jumlahobat()
	{
		$query = $this->db->get('obat');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}


	// fungsi yang digunakan
	public function saveDiagnosa()
	{
		$data = [
			'nik' => $this->input->post('nik'),
			'diagnosa' => $this->input->post('diagnosa'),
			'riwayat' => $this->input->post('riwayat'),
			'tanggal' => $this->input->post('tanggal_pengambilan'),
			'kode_obat' => '00' . $this->input->post('kode_obat')
		];

		$this->db->insert('diagnosa', $data);
	}
}
