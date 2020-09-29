<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produksi_model');
        $this->load->model('User_model');
        $this->load->model(['Oee_model', 'Produk_model']);

        $departemen = $this->session->userdata('departemen');
        if (!$departemen) redirect('auth');
    }

    public function index()
    {
        $data['title'] = 'Menu Manajemen';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">New Menu Added</div>');
            redirect('menu');
        }
    }


    public function submenu()
    {
        $data['title'] = 'Sub Menu';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['npage'] = 'submenu';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">New Submenu Added</div>');
            redirect('menu/submenu');
        }
    }

    public function datauser()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->model('User_model', 'user');

        $data['dataUser'] = $this->user->getUser();
        $data['nm_departemen'] = $this->db->get('user_departemen')->result_array();
        $data['npage'] = 'm_datauser';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('departemen', 'Departemen', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/datauser', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptdatauser');
        } else {
            $action = $this->input->post('actions');
            $user_id = $this->input->post('user_id');
            $nama = $this->input->post('nama');
            $departemen = $this->input->post('departemen');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($action == "INSERT") {
                $this->User_model->tambahuser($nama, $departemen, $username, $password_hash);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New User Added</div>');
                redirect('menu/datauser');
            } else if ($action == "UPDATE") {
                $this->User_model->edituser($user_id, $nama, $departemen, $username, $password_hash);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User edited!</div>');
                redirect('menu/datauser');
            } else if ($action == "DELETE") {
                $this->User_model->deleteuser($user_id);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User deleted!</div>');
                redirect('menu/datauser');
            } else {
                echo "No direct script access allowed.";
            }
            
        }
    }

    public function dataproduk()
    {
        $data['title'] = 'Data Produk ';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['npage'] = 'm_dataproduk';


        $data['dataProduk'] = $this->db->get('data_produk')->result_array();


        $this->form_validation->set_rules('nama_produk', 'Nama_produk', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/dataproduk', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptdataproduk');
        } else {
            $action = $this->input->post('actions');
            $no_produk = $this->input->post('no_produk') ?? '';
            $data = [
                'nama_produk' => $this->input->post('nama_produk')
            ];

            if ($action == "INSERT") {
                $this->db->insert('data_produk', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Product Added</div>');
                redirect('menu/dataproduk');
            } else if ($action == "UPDATE") {
                $this->db->where('no_produk', $no_produk);
                $this->db->update('data_produk', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Updated!</div>');
                redirect('menu/dataproduk');
            } else if ($action == "DELETE") {
                $this->db->delete('data_produk', ['no_produk' => $no_produk]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Deleted!</div>');
                redirect('menu/dataproduk');
            } else {
                echo "No direct script access allowed.";
            }
        }
    }

    public function datastandar()
    {
        $data['title'] = 'Data Standar OEE';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['npage'] = 'm_datastandar';

        $data['dataStandar'] = $this->db->get('data_standaroee')->result_array();

        $this->form_validation->set_rules('tgl_standar', 'Tgl_standar', 'required');
        $this->form_validation->set_rules('availability', 'Availability', 'required');
        $this->form_validation->set_rules('performance', 'Performance', 'required');
        $this->form_validation->set_rules('quality', 'Quality', 'required');
        $this->form_validation->set_rules('oee', 'Oee', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/datastandar', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptdatastandar');
        } else {
            $action = $this->input->post('actions');
            $no_standar = $this->input->post('no_standar') ?? '';
            $data = [
                'tgl_standar' => $this->input->post('tgl_standar'),
                'availability' => $this->input->post('availability'),
                'performance' => $this->input->post('performance'),
                'quality' => $this->input->post('quality'),
                'oee' => $this->input->post('oee')
            ];

            if ($action == "INSERT") {
                $this->db->insert('data_standaroee', $data);
                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">New Product Added</div>');
                redirect('menu/datastandar');
            } else if ($action == "UPDATE") {
                $this->db->where('no_standar', $no_standar);
                $this->db->update('data_standaroee', $data);
                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Product '. $no_standar .' Updated!</div>');
                redirect('menu/datastandar');
            } else if ($action == "DELETE") {
                $this->db->delete('data_standaroee', ['no_standar' => $no_standar]);
                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Product '. $no_standar .' Deleted!</div>');
                redirect('menu/datastandar');
            } else {
                echo "No direct script access allowed.";
            }
        }
    }

    public function dataoee()
    {
        $data['title'] = 'Data Input OEE';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->model('Oee_model', 'oee');

        $data['dataOEE'] = $this->oee->getOee();
        $data['npage'] = 'm_dataoee';

        // $data['dataLap'] = $this->db->get('laporan_produksi')->result_array();
        $data['dataLap'] = $this->db->query('SELECT `laporan_produksi`.*, `data_produk`.`nama_produk` FROM `laporan_produksi`JOIN `data_produk` on `laporan_produksi`.`no_produk` = `data_produk`.`no_produk`')->result_array();

        $this->form_validation->set_rules('id_produksi', 'ID Produksi', 'required');
        $this->form_validation->set_rules('jam_kerja', 'Jam Kerja', 'required');
        $this->form_validation->set_rules('breakdown', 'Breakdown', 'required');
        $this->form_validation->set_rules('setup', 'Setup', 'required');
        $this->form_validation->set_rules('run_time', 'Run Time', 'required');
        $this->form_validation->set_rules('ideal_runtime', 'Ideal Run Time', 'required');
        $this->form_validation->set_rules('bad_count', 'Bad Count', 'required');
        $this->form_validation->set_rules('good_count', 'Good Count', 'required');
        $this->form_validation->set_rules('total_count', 'Total Count', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/dataoee', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptdataoee');
        } else {
            $action = $this->input->post('actions');
            $id_oee = $this->input->post('id_oee') ?? '';
            $data = [
                'id_produksi' => $this->input->post('id_produksi'),
                'tgl_oee' => $this->input->post('tgl_oee'),
                'jam_kerja' => $this->input->post('jam_kerja'),
                'breakdown' => $this->input->post('breakdown'),
                'setup' => $this->input->post('setup'),
                'run_time' => $this->input->post('run_time'),
                'ideal_runtime' => $this->input->post('ideal_runtime'),
                'bad_count' => $this->input->post('bad_count'),
                'good_count' => $this->input->post('good_count'),
                'total_count' => $this->input->post('total_count')
            ];

            if ($action == "INSERT") {
                $this->db->insert('input_oee', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Variabel OEE Added</div>');
                redirect('menu/dataoee');
            } else if ($action == "UPDATE") {
                $this->db->where('id_oee', $id_oee);
                $this->db->update('input_oee', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Updated!</div>');
                redirect('menu/dataoee');
            } else if ($action == "DELETE") {
                $this->db->delete('input_oee', ['id_oee' => $id_oee]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Deleted!</div>');
                redirect('menu/dataoee');
            } else {
                echo "No direct script access allowed.";
            }
            
        }
    }

    public function hasiloee()
    {
        $data['title'] = 'Data Hasil Perhitungan OEE';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['dataOEE'] = $this->db->get('input_oee')->result_array();

        $data['dataStandar'] = $this->db->get('data_standaroee')->result_array();
        $data['npage'] = 'hasiloee';

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/hasiloee', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scripthasiloee');
        } else {
        }
    }

    public function cekoee()
    {
        $id     = $this->input->post('id');
        $data   = $this->Oee_model->cekoee($id);
        echo json_encode($data);
    }

    public function inputproduksi()
    {
        $data['title'] = 'Laporan Produksi';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->model('Produksi_model', 'produksi');
        
        $data['dataLap'] = $this->produksi->getNmproduk();

        $data['nama_produk'] = $this->db->get('data_produk')->result_array();
        $data['npage'] = 'inputproduksi';


        //$this->form_validation->set_rules('id_produksi', 'Id_produksi', 'required');
        $this->form_validation->set_rules('nm_produk', 'Nm_produk', 'required');
        $this->form_validation->set_rules('tgl_produksi', 'Tgl_produksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/inputproduksi', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptdataoee');
        } else {
            $action = $this->input->post('actions');
            $id_produksi = $this->input->post('id_produksi') ?? '';
            $data = [
                'id_produksi' => $this->input->post('id_produksi'),
                'no_produk' => $this->input->post('nm_produk'),
                'tgl_produksi' => $this->input->post('tgl_produksi'),
            ];

            if ($action == "INSERT") {
                $this->db->insert('laporan_produksi', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Variabel OEE Added</div>');
                redirect('menu/inputproduksi');
            } else if ($action == "UPDATE") {
                $this->db->where('id_produksi', $id_produksi);
                $this->db->update('laporan_produksi', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Updated!</div>');
                redirect('menu/inputproduksi');
            } else if ($action == "DELETE") {
                $this->db->delete('laporan_produksi', ['id_produksi' => $id_produksi]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product Deleted!</div>');
                redirect('menu/inputproduksi');
            } else {
                echo "No direct script access allowed.";
            }
        }
    }

    public function hasilproduksi()
    {
        $data['title'] = 'Data Hasil Laporan Produksi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['dataLap'] = $this->db->get('laporan_produksi')->result_array();
        $data['dataOEE'] = $this->db->get('input_oee')->result_array();
        $data['row'] = $this->produksi_model->get()->result_array();
        $data['npage'] = 'hasilproduksi';

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menuproduction/hasilproduksi', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scripthasilproduksi');
        } else {
        }
    }

    public function cetakhasilproduksi($id_produksi)
    {
        // $query = $this->db->get_where('employee_master', array('emp_dept' => 'sales'));
        // Produces:
        // SELECT * FROM employee_master WHERE emp_dept= "sales";
        $data['row'] = $this->produksi_model->cetak($id_produksi)->row();
        $data['variable'] = $this->produksi_model->cetak($id_produksi)->result();
        $data['username'] = $this->session->userdata('username');
        // var_dump($data);exit;
        // $this->load->view('templates/header', $data);
        $this->load->view('menuproduction/cetakhasilproduksi', $data);
    }

    public function grafikoee()
    {
        // get data         
        $data['title'] = 'Grafik OEE';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['dataStandar'] = $this->db->get('data_standaroee')->result_array();
        $data['npage'] = 'grafikoee';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menuproduction/grafikoee', $data);
        $this->load->view('templates/footer', $data);
    }

    // Ajax Only

    public function ajax_grafik_oee($awal, $akhir)
    {
        // Last 7 days
        $data = $this->Oee_model->get_grafik_oee($awal, $akhir);
        

        $label = [];
        $oee = [];
        foreach ($data as $dt) {
            array_push($label, $dt->label_oee);
            array_push($oee, $dt->hasil_oee);
        }
        echo json_encode(['label' => $label, 'oee' => $oee]);
    }
}
