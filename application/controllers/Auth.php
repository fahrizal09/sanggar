<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->library('form_validation');
	}
	public function login()
	{
		$this->load->view('Auth/style/v_header');
		$this->load->view('Auth/page/v_login');
		$this->load->view('Auth/style/v_footer');
	}

	public function ceklogin()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Auth/style/v_header');
			$this->load->view('Auth/page/v_login');
			$this->load->view('Auth/style/v_footer');
		} else {
			$post = $this->input->post();
			$username = $post['username'];
			$password = $post['password'];
			$qry = $this->AuthModel->cekAuth($username, $password);
			if ($qry) {
				redirect('backoffice/dashboard');
			} else {
				echo ("Password Salah");
			}
		}
	}

	public function register()
	{
		$this->load->view('Auth/style/v_header');
		$this->load->view('Auth/page/v_register');
		$this->load->view('Auth/style/v_footer');
	}

	private function _sendEmail()
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'jiwanrizal5@gmail.com',
			'smtp_pass' => 'Jiwan123_',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => '\r\n',
		];
		$this->load->library('email', $config);
		$this->email->from('jiwanrizal5@gmail.com', 'Fahrizal Azi F');
	}
}
