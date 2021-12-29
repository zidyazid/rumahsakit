<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_pasien extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url("auth"));
        }

        $this->load->model('Pasien_model');
        $this->load->model('Pemeriksaan_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Apoteker_model');
    }

    public function index()
    {
        $judul['judul'] = 'Halaman Data Pasien';
        $data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        // join table diagnosa dan stok obat
        $this->db->select('*');
        $this->db->from('diagnosa');
        $this->db->join('pegawai', 'pegawai.nik = diagnosa.nik');
        $this->db->join('stok_obat', 'stok_obat.kode_obat = diagnosa.kode_obat');
        $data['dataPasien'] = $this->db->get()->result_array();


        // var_dump($query);
        // die;

        $this->load->view('templates/home_header', $judul);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/index', $data);
        $this->load->view('templates/home_footer', $data);
    }
}
