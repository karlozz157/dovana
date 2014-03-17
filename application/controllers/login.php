<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', true);

session_start();

class Login extends CI_Controller {

	public function index()
	{
		if(false != $this->session->userdata('admin_username') AND false != $this->session->userdata('admin_password'))
		{
			redirect(base_url().'admin');
		}
		else
		{
			$this->form_validation->set_rules('admin_username', '', 'required');
			$this->form_validation->set_rules('admin_password', '', 'required');

			if(false === $this->form_validation->run())
			{
				$this->load->view('admin/login');
			}
			else
			{
				if(true === $this->backend->login())
				{
					redirect(base_url().'admin/dashboard');
				}
				else
				{
					$this->session->set_flashdata('error_login', 'El usuario y/o la contraseña con incorrectas.');
					redirect(base_url().'login');
				}
			}
		}
	}

	public function logout()
	{
		$_SESSION['admin_auth'] = null;
		redirect(base_url().'login');
	}
}