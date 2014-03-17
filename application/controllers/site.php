<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1);
session_start();

class Site extends CI_Controller {

	/**
	 * @param String $fileName
	 * @param Array $vars
	 */
	private function view($fileName, $vars = null)
	{
		$categories = $this->commerce->getCategoriesPrincipal();
		$config     = $this->commerce->getConfig();
		$logged     = $this->commerce->getLoggedUser();

		$this->load->view('site/header', array('config' => $config, 'categories' => $categories, 'logged' => $logged));
		$this->load->view(sprintf('site/%s', $fileName), $vars);
		$this->load->view('site/footer');		
	}

	public function search()
	{
		$products = $this->commerce->searchProducts(get_request('q'));
		$this->view('search', array('products' => $products));
	}	

	public function index()
	{
		$sliders     = $this->commerce->getSlider();
		$promociones = $this->commerce->getPromociones();
		$this->view('index', array('sliders' => $sliders, 'promociones' => $promociones));
	}

	/**
	 *
	 * @param Int $id
	 */
	public function category($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$products = $this->commerce->getProductsByCategory($id);
		$category = $this->commerce->getCategory($id);
		$sidebar  = $this->commerce->getParentCategoryByCategories($id);
		$this->view('category', array('id' => $id ,'category' => $category, 'products' => $products, 'sidebar' => $sidebar));
	}	

	/**
	 *
	 * @param Int $id
	 */
	public function product($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$product  = $this->commerce->getProduct($id);
		$images   = $this->backend->getImagesByIdProduct($id);

		if(!$product)
			show_404();

		$products = $this->commerce->getRelatedProducts($product['category'], $product['id']);
		$this->view('product', array('product' => $product, 'products' => $products, 'images' => $images));
	}

	public function contacto()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('email', '', 'valid_email|required');
		$this->form_validation->set_rules('message', '', 'required');

		if(false === $this->form_validation->run())
		{
			$this->view('contacto');
		}
		else
		{
			$config = $this->backend->getConfig();	
			$this->email->initialize(array('mailtype' => 'html', 'charset' => 'utf-8'));
			$this->email->to($config['email']);
			$this->email->from(get_post('email'));
			$this->email->subject('Forma de Contacto');
			$this->email->message(get_post('message'));
			$this->session->set_flashdata('contacto_success', 'Tu mensaje ha sido enviado, en breve nos pondremos en contacto con Usted. Gracias!');
			redirect(base_url() . 'site/contacto');
		}	
	}

	public function cart()
	{
		$user = $this->commerce->getLoggedUser();

		if(true === empty($user))
		{
			$this->view('login');
		}
		else
		{
			redirect(base_url().'cart/list_cart');
		}
	}

	public function login()
	{		
		$this->form_validation->set_rules('email', '', 'valid_email|required');
		$this->form_validation->set_rules('password', '', 'required');

		if(true === $this->form_validation->run())
		{
			$login = json_decode($this->commerce->login());

			if(isset($login->user_doesnt_exist) AND true === $login->user_doesnt_exist)
			{
				$this->session->set_flashdata('error', 'El email no existe.');
				redirect(base_url().'site/cart');
			}
			else if(isset($login->password_fail) AND true === $login->password_fail)
			{
				$this->session->set_flashdata('error', 'El password es incorrecto.');
				redirect(base_url().'site/cart');
			}
			else if(isset($login->login) AND true === $login->login)
			{

				if(isset($_POST['remember-data']))
				{
					setcookie('email-login', $_POST['email'], time()+60*60*24*364);
					setcookie('password-login', $_POST['password'], time()+60*60*24*364);
				}

				if(isset($_GET['redirect']))
					if('checkout' == $_GET['redirect'])
						redirect(base_url().'cart/process_checkout');	

				
				redirect(base_url().'cart/list_cart');	
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'La validación de los campos es incorrecta.');
			redirect(base_url().'site/cart');
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('email', '', 'required|valid_email');
		$this->form_validation->set_rules('email_conf', 'Password', 'required|valid_email|matches[email]');
		$this->form_validation->set_rules('password', '', 'required');
		$this->form_validation->set_rules('password_conf', 'Password', 'required|matches[password]');	
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('first_name', '', 'required');
		$this->form_validation->set_rules('last_name', '', 'required');
		$this->form_validation->set_rules('birthday', '', '');
		$this->form_validation->set_rules('telephone', '', 'required|numeric');
		$this->form_validation->set_rules('cellphone', '', 'required|numeric');


		if(true === $this->form_validation->run())
		{
			if(true === $this->commerce->register())
			{	
				if(isset($_GET['redirect']))
					if('checkout' == $_GET['redirect'])	
						redirect(base_url().'cart/process_checkout');

				redirect(base_url().'cart/list_cart');
			}else
			{
				$this->session->set_flashdata('error_register', 'El email ya esta registrado.');
				redirect(base_url().'site/cart');
			}
		}
		else
		{
			$this->session->set_flashdata('error_register', 'La validación de los campos es incorrecta.');
			redirect(base_url().'site/cart');			
		}
	}

	public function recover()
	{
		$this->form_validation->set_rules('email', '', '');

		if(false === $this->form_validation->run())
		{
			$this->view('recover');
		}
		else
		{
			$user = $this->commerce->recover(get_post('email'));

			if(false != $user)
			{
				$config = $this->backend->getConfig();
				$body = sprintf('Tu contraseña: %s', base64_decode($user['password']));

				$this->email->initialize(array('mailtype' => 'html', 'charset' => 'utf-8'));
				$this->email->to($config['email']);
				$this->email->from($user['email']);
				$this->email->subject('Recuperación de la contraseña');
				$this->email->message($body);	
				
				if($this->email->send())
					$this->session->set_flashdata('success_recover', 'Revisa en tu bandeja de entrada tu contraseña.');
				else
					$this->session->set_flashdata('error_recover', 'Inténtalo más tarde problemas con nuestro servidor.');
			}
			else
			{
				$this->session->set_flashdata('error_recover', 'Esta cuenta no existe.');
			}

			redirect(base_url().'site/recover');
		}
	}

	public function logout()
	{
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		unset($_SESSION['checkout']);
		unset($_SESSION['lastIdPurchase']);
		redirect(base_url().'site/index');
	}
}
