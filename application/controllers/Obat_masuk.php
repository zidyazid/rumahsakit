<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_masuk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect(base_url("auth"));
		}
		$this->load->model('Pasien_model');
		$this->load->model('Pemeriksaan_model');
		$this->load->model('Apoteker_model');
		$this->load->model('Resep_model');
		$this->load->model('Obat_model');
		$this->load->model('m_id');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$judul['judul'] = 'Halaman Obat Masuk';
		$data['obat'] = $this->db->get_where('masuk_obat', ['delete_status' => 0])->result_array();
		$data['petugas_obat'] = $this->db->get_where('petugas_obat', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/home_header', $judul);
		$this->load->view('templates/home_sidebar');
		$this->load->view('templates/topbar_apoteker', $data);
		$this->load->view('obat_masuk/index', $data);
		$this->load->view('templates/home_footer');
	}

	public function tambah()
	{

		$judul['judul'] = 'Halaman Tambah Transaksi';
		$data['kodemasuk'] = $this->m_id->buat_kode_masuk();
		$kodemasuk = $this->m_id->buat_kode_masuk();
		$data['obat'] = $this->db->query("SELECT * FROM obat ORDER BY nama_obat ASC")->result();
		$data['masuk'] = $this->db->query("SELECT * FROM detail_masuk JOIN obat ON detail_masuk.kd_obat =obat.id_obat WHERE kd_masuk ='$kodemasuk'")->result();
		$data['subtotal'] = $this->Resep_model->hitung('detail_masuk', ['kd_masuk' => $this->m_id->buat_kode_masuk()]);
		$data['petugas_obat'] = $this->db->get_where('petugas_obat', ['username' => $this->session->userdata('username')])->row_array();


		$this->load->view('templates/home_header', $judul);
		$this->load->view('templates/home_sidebar');
		$this->load->view('templates/topbar_apoteker', $data);
		$this->load->view('obat_masuk/input', $data);
		$this->load->view('templates/home_footer');
	}



	function tambah_aksi()
	{
		$this->form_validation->set_rules('kode_obat', 'Kode_obat', 'required');
		$this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
		$this->form_validation->set_rules('jumlah_masuk', 'Jumlah_masuk', 'required');
		$this->form_validation->set_rules('harga_perobat', 'Harga_perobat', 'required');
		$this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl_masuk', 'required');

		$obat = $this->input->post('kode_obat');
		$jumlahMasuk = $this->input->post('jumlah_masuk');

		$jumlahObat = $this->db->get_where('stok_obat', ['kode_obat' => $obat])->row_array();

		$totalStok = $jumlahObat["total_stok"] + $jumlahMasuk;

		if ($this->form_validation->run() == FALSE) {
			redirect('obat_masuk/index');
			echo 'false';
		} else {
			$this->Obat_model->tambah_data();
			$this->Obat_model->updateStok($totalStok);
			redirect('obat_masuk/index');
		}
	}


	public function updateObatMasuk($id_transaksi)
	{
		$judul['judul'] = 'Halaman Tambah Transaksi';
		$data['petugas_obat'] = $this->db->get_where('petugas_obat', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('kode_obat', 'Kode_obat', 'required');
		$this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
		$this->form_validation->set_rules('jumlah_masuk', 'Jumlah_masuk', 'required');
		$this->form_validation->set_rules('harga_perobat', 'Harga_perobat', 'required');
		$this->form_validation->set_rules('nama_obat', 'Nama_obat', 'required');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl_masuk', 'required');

		$data['dataDipilih'] = $this->db->get_where('masuk_obat', ['id_transaksi' => $id_transaksi])->row_array();
		$obatDirubah = $this->db->get_where('masuk_obat', ['id_transaksi' => $id_transaksi])->row_array();
		$stok = $this->db->get_where('stok_obat', ['kode_obat' => $obatDirubah["kode_obat"]])->row_array();

		$totalStok = ($stok["total_stok"] - $obatDirubah["jumlah_masuk"]) + $this->input->post('jumlah_masuk');



		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/home_header', $judul);
			$this->load->view('templates/home_sidebar');
			$this->load->view('templates/topbar_apoteker', $data);
			$this->load->view('obat_masuk/ubah', $data);
			$this->load->view('templates/home_footer');
		} else {
			// var_dump($stok["total_stok"]);
			// var_dump($obatDirubah["jumlah_masuk"]);
			// var_dump($this->input->post('jumlah_masuk'));
			// var_dump($totalStok);
			// die;
			$this->Obat_model->updateObatMasuk($id_transaksi);
			$this->Obat_model->updateStok($totalStok);

			redirect('obat_masuk/index');
		}
	}

	public function hapusObatMasuk($idTransaksi)
	{
		$obatDirubah = $this->db->get_where('masuk_obat', ['id_transaksi' => $idTransaksi])->row_array();
		$stok = $this->db->get_where('stok_obat', ['kode_obat' => $obatDirubah["kode_obat"]])->row_array();
		$totalStok = $stok["total_stok"] - $obatDirubah["jumlah_masuk"];

		// var_dump($totalStok);
		// die;
		$this->Obat_model->updateStokWithIDTransaksi($totalStok, $obatDirubah["kode_obat"]);
		$this->db->delete('masuk_obat', ['id_transaksi' => $idTransaksi]);

		redirect('obat_masuk/index');
	}

	public function hapus($kd_masuk)
	{
		$this->Resep_model->hapus_data_masuk($kd_masuk);
		redirect('obat_masuk/index');
	}


	public function cek_obat()
	{
		$kd_obat = $this->input->post('kd_obat');
		$cek = $this->db->query("SELECT * FROM obat WHERE id_obat='$kd_obat'")->row();
		$data = array(
			'stok' => $cek->stok,
			'harga' => $cek->harga,
			'id_obat' => $cek->id_obat
		);
		echo json_encode($data);
	}



	function hapus_detail_masuk($kodemasuk)
	{
		$where = array('kd_masuk' => $kodemasuk);
		$this->Resep_model->hapus($where, 'detail_masuk');
		redirect('obat_masuk/index');
	}



	/*LAPORAN TRANSAKSI*/

	function laporan()
	{

		if (isset($_GET['filter']) && !empty($_GET['filter'])) {

			$filter = $_GET['filter'];

			if ($filter == '1') {
				$tanggal1 = $_GET['tanggal'];
				$tanggal2 = $_GET['tanggal2'];
				$ket = 'Data Obat Masuk dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
				$url_cetak = 'obat_masuk/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
				$obat_masuk = $this->Apoteker_model->view_by_date1($tanggal1, $tanggal2);
			} else if ($filter == '2') {
				$kd_masuk = $_GET['kd_masuk'];
				$ket = 'Data Obat Masuk ';
				$url_cetak = 'obat_masuk/cetak2?&kd_masuk=' . $kd_masuk;
				$obat_masuk = $this->Apoteker_model->view_by_kd_masuk1($kd_masuk);
			}
		} else {

			$ket = 'Semua Data Obat Masuk';
			$url_cetak = 'obat_masuk/cetak';
			$obat_masuk = $this->Apoteker_model->view_all();
		}

		$data['ket'] = $ket;
		$data['url_cetak'] = base_url($url_cetak);
		$data['obat_masuk'] = $obat_masuk;
		$data['kd_masuk'] = $this->Apoteker_model->kd_masuk();
		$data['judul'] = 'Laporan Data Obat Masuk';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/home_header', $data);
		$this->load->view('templates/home_sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('obat_masuk/laporan', $data);
		$this->load->view('templates/home_footer');
	}

	public function cetak()
	{

		$ket = 'Semua Data Obat Masuk';
		$alamat = 'Kp. Cibereum No.18 RT/RW 04/01 Tanjungjaya';

		ob_start();
		require('assets/pdf/fpdf.php');
		$data['obat_masuk'] = $this->Apoteker_model->view_all();
		$data['ket'] = $ket;
		$data['alamat'] = $alamat;
		$this->load->view('obat_masuk/preview', $data);
	}

	public function cetak1()
	{

		$tanggal1 = $_GET['tanggal1'];
		$tanggal2 = $_GET['tanggal2'];
		$ket = 'Data Obat Masuk dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
		$alamat = 'Kp. Cibereum No.18 RT/RW 04/01 Tanjungjaya';

		ob_start();
		require('assets/pdf/fpdf.php');
		$data['obat_masuk'] = $this->Apoteker_model->view_by_date1($tanggal1, $tanggal2);
		$data['ket'] = $ket;
		$data['alamat'] = $alamat;
		$this->load->view('obat_masuk/preview', $data);
	}

	public function cetak2()
	{

		$kd_masuk = $_GET['kd_masuk'];
		$ket = 'Kode Transaksi Obat Masuk   '   . $kd_masuk;
		$alamat = 'Kp. Cibereum No.18 RT/RW 04/01 Tanjungjaya';
		ob_start();
		require('assets/pdf/fpdf.php');
		$data['obat_masuk'] = $this->Apoteker_model->view_by_kd_masuk($kd_masuk);
		$data['ket'] = $ket;
		$data['alamat'] = $alamat;
		$this->load->view('obat_masuk/preview1', $data);
	}
}
