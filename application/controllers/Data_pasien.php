<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect(base_url("auth"));
		}

		$this->load->model('Pasien_model');
		$this->load->model('m_id');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$judul['judul'] = 'Halaman Data Pegawai';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$data['data_pegawai'] = $this->db->get_where('pegawai', ['delete_status' => 0])->result_array();

		$this->load->view('templates/home_header', $judul);
		$this->load->view('templates/home_sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data_pasien/index', $data);
		$this->load->view('templates/home_footer');
	}


	public function tambah()
	{

		$judul['judul'] = 'Halaman Tambah Data Pasien';
		$data['kodeunik'] = $this->m_id->buat_kode();
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nik', 'Nik', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal_Lahir', 'required');
		$this->form_validation->set_rules('golongan', 'Golongan', 'required');
		$this->form_validation->set_rules('umur', 'Umur', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/home_header', $judul);
			$this->load->view('templates/home_sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data_pasien/input', $data);
			$this->load->view('templates/home_footer');
		} else {
			$this->Pasien_model->tambah_data();
			redirect('data_pasien/index');
		}
	}

	public function hapus($nik)
	{
		$this->Pasien_model->ubah_delete_status($nik);
		redirect('data_pasien/index');
	}


	public function ubah($nik)
	{

		$judul['judul'] = 'Halaman Ubah Data Pasien';
		$data['pasien'] = $this->Pasien_model->getPasienById($nik);
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nik', 'Nik', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal_Lahir', 'required');
		$this->form_validation->set_rules('golongan', 'Golongan', 'required');
		$this->form_validation->set_rules('umur', 'Umur', 'required');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/home_header', $judul);
			$this->load->view('templates/home_sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data_pasien/ubah', $data);
			$this->load->view('templates/home_footer');
		} else {
			$this->Pasien_model->ubah_data();
			redirect('data_pasien/index');
		}
	}



	/*LAPORAN TRANSAKSI*/

	function laporan()
	{

		if (isset($_GET['filter']) && !empty($_GET['filter'])) {

			$filter = $_GET['filter'];


			if ($filter == '1') {
				$kd_rm = $_GET['kd_rm'];
				$ket = 'Data Pasien ';
				$url_cetak = 'data_pasien/cetak2?&kd_rm=' . $kd_rm;
				$pasien = $this->Pasien_model->view_by_kd_rm($kd_rm);
			}
		} else {

			$ket = 'Semua Data Pasien';
			$url_cetak = 'data_pasien/cetak';
			$pasien = $this->Pasien_model->view_all();
		}

		$data['ket'] = $ket;
		$data['url_cetak'] = base_url($url_cetak);
		$data['pasien'] = $pasien;
		$data['kd_rm'] = $this->Pasien_model->kd_rm();



		$data['judul'] = 'Laporan Pasien';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/home_header', $data);
		$this->load->view('templates/home_sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data_pasien/laporan', $data);
		$this->load->view('templates/home_footer');
	}

	public function cetak()
	{

		$ket = 'Semua Data Pasien';
		$alamat = 'Kp. Cibereum No.18 RT/RW 04/01 Tanjungjaya';

		ob_start();
		require('assets/pdf/fpdf.php');
		$data['pasien'] = $this->Pasien_model->view_all();
		$data['ket'] = $ket;
		$data['alamat'] = $alamat;
		$this->load->view('data_pasien/preview', $data);
	}

	public function cetak1()
	{

		$ket = 'Data Pasien';
		$alamat = 'Kp. Cibereum No.18 RT/RW 04/01 Tanjungjaya';

		ob_start();
		require('assets/pdf/fpdf.php');
		$data['pasien'] = $this->Pasien_model->view_by_kd_rm();
		$data['ket'] = $ket;
		$data['alamat'] = $alamat;
		$this->load->view('data_pasien/preview1', $data);
	}
}
