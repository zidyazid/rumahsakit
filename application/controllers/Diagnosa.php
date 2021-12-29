<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url("auth"));
        }

        $this->load->model('Obat_model');
        $this->load->model('Pasien_model');
        $this->load->model('m_id');
        $this->load->library('form_validation');
    }


    public function index($nik)
    {
        $judul['judul'] = 'Halaman Diagnosa';

        $data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['data_pegawai'] = $this->db->get_where('pegawai', ['delete_status' => 0])->result_array();
        $data['dataPegawai'] = $this->db->get_where('pegawai', ['nik' => $nik])->row_array();
        $data['listObat'] = $this->db->get('stok_obat')->result_array();

        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('namaPegawai', 'NamaPegawai', 'required');
        $this->form_validation->set_rules('diagnosa', 'diagnosa', 'required');
        $this->form_validation->set_rules('kode_obat', 'kode_obat', 'required');
        $this->form_validation->set_rules('riwayat', 'Riwayat', 'required');
        $this->form_validation->set_rules('jumlah_diambil', 'Jumlah_Diambil', 'required');
        $this->form_validation->set_rules('tanggal_pengambilan', 'Tanggal_Pengambilan', 'required');

        $stokObat = $this->db->get_where('stok_obat', ['kode_obat' => $this->input->post('kode_obat')])->row_array();
        $totalStok = $stokObat["total_stok"] - $this->input->post('jumlah_diambil');
        $kodeObat = $this->input->post('kode_obat');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/home_header', $judul);
            $this->load->view('templates/home_sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('diagnosa/index', $data);
            $this->load->view('templates/home_footer');
        } else {
            // var_dump($totalStok);
            // die;
            $this->Obat_model->saveDiagnosa();
            $this->Obat_model->updateStokWithIDTransaksi($totalStok, $kodeObat);
            redirect('data_pasien');
        }
    }
}
