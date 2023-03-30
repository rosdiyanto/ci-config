<?php
// controller
public function action()
{
	$this->form_validation->set_rules('username', 'Username', 'trim|required');
	$this->form_validation->set_rules('password', 'Password', 'trim|required');
	$this->form_validation->set_error_delimiters('<p style="padding-left: 4px;" class="help-block text-white bg-danger">', '</p>');
	if ($this->form_validation->run() == FALSE) {
		$this->index();
	} else {
		$data = array(
			'user' => $this->input->post('username', TRUE),
			'pass'=> md5($this->input->post('password', TRUE)) 
		);

		$cek = $this->M_setting->cek_login($data)->num_rows();
		$data_login = $this->M_setting->cek_login($data)->row();
		if ($cek > 0) {
			$data_sesi = array(
				'usernema' => $data_login->user,
				'key' => md5('9299@93#2222$%'),
				);
			$this->session->set_userdata($data_sesi);
			redirect('pegawai','refresh');
		}else{
			$data['pesan'] = '<p class="help-block text-white bg-danger" style="padding-left: 4px;">Username atau password salah !</p>';
			$this->load->view('login/v_login', $data);
		}
	}
}

// model
public function cek_login($data)
{
  	return $this->db->get_where($this->table, $data);
}

// auth
public function __construct()
{
	parent::__construct();
	if ($this->session->userdata('key') != md5('9299@93#2222$%')) {
		redirect('login','refresh');
	}
}

// view
<?php if(isset($pesan)){echo $pesan;} ?>