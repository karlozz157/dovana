<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', true);
require_once(APPPATH . 'core/paypal.class.php');
session_start();

class Cart extends CI_Controller {

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

	public function list_cart()
	{			
		$this->view('cart');
	}

	public function list_purchase()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{		
			$products = $this->commerce->getPurchase();
			$this->view('purchase', array('products' => $products));
		}
		else
		{
			redirect(base_url().'site/cart');
		}
	}

	public function purchase_view($id = null)
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{
			$data = $this->commerce->getPurchaseDetail($id);

			if(!$data['products'])
				show_404();

			$this->view('purchase_view.php', array('products' => $data['products'], 'address' => $data['address']));
		}
		else
		{
			redirect(base_url().'site/cart');
		}
	}
	
	public function addCart()
	{
		if(true === $this->input->is_ajax_request())
		{
			$user = $this->commerce->getLoggedUser();

			if(false === empty($user))
			{
				$this->commerce->removeCart();
				$items = json_decode(json_encode($_POST['items']), true);

				foreach($items as $item)
				{
					$product   = $item['productId'];
					$quantity  = $item['productQuantity'];
					$envoltura = $item['productEnvoltura'];

					if(true === $this->commerce->existenceProduct($product) AND true === ctype_digit($quantity))
					{
						$this->commerce->addCart($product, $quantity, $envoltura);
					}
					else
					{
						$return['hacking_attempt'] = true;
						echo json_encode($return);
						exit;
					}

				}
				$return['success_action'] = true;
			}
			else
			{
				$return['error_login'] = 'Debes iniciar sesion para poder comprar.';
			}

			echo json_encode($return);
		}
		else
		{
			show_404();
		}
	}

	public function process_checkout()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{			
			$this->view('process_checkout');
		}
		else
		{
			$this->session->set_flashdata('error_login_redirect_checkout', 'Debes iniciar sesion para poder comprar.');
			redirect(base_url().'site/cart');

		}
	}

	public function checkout()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))		
		{
			$config   = $this->commerce->getConfig();
			$products = $this->commerce->getCart();
			$sending  = $this->backend->getSendingActives(); 
			$this->view('checkout', array('products' => $products, 'sending' => $sending, 'config' => $config));
		}
		else
		{
			$this->session->set_flashdata('error_login_redirect_checkout', 'Debes iniciar sesion para poder comprar.');
			redirect(base_url().'site/cart');
		}
	}	

	public function paypal()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{

			$this->form_validation->set_rules('colonia', '', 'required');
			$this->form_validation->set_rules('codigo_postal', '', 'numeric|max_length[5]|required');
			$this->form_validation->set_rules('calle', '', 'required');
			$this->form_validation->set_rules('no_exterior', '', 'numeric|required');
			$this->form_validation->set_rules('no_interior', '', 'numeric');

			if(get_post('envoltura'))
			{
				$this->form_validation->set_rules('from_name', '', 'required');
				$this->form_validation->set_rules('from_second_name', '', 'required');
				$this->form_validation->set_rules('from_last_name', '', 'required');
				$this->form_validation->set_rules('to_name', '', 'required');
				$this->form_validation->set_rules('to_second_name', '', 'required');
				$this->form_validation->set_rules('to_last_name', '', 'required');
				$this->form_validation->set_rules('from_message', '', 'required');
			}

			if(true === $this->form_validation->run())
			{
				$address = array(
					'estado'        => get_post('estado'),
					'municipio'     => get_post('municipio'),
					'colonia'       => get_post('colonia'),
					'codigo_postal' => get_post('codigo_postal'),
					'calle'         => get_post('calle'),
					'no_exterior'   => get_post('no_exterior'),
					'no_interior'   => get_post('no_interior')
				);

				$message = array(
					'from_name'        => get_post('from_name'),
					'from_second_name' => get_post('from_second_name'),
					'from_last_name'   => get_post('from_last_name'),
					'to_name'          => get_post('to_name'),
					'to_second_name'   => get_post('to_second_name'),
					'to_last_name'     => get_post('to_last_name'),
					'from_message'     => get_post('from_message'),
				);

				$checkout = array(
					'products'     	=> json_encode($this->commerce->getCart()),
					'address'       => json_encode($address),
					'message'       => json_encode($message),
					'id_sending'    => get_post('sending'),
				);
	
				$_SESSION['checkout'] = json_encode($checkout);
				$user   = $this->commerce->getLoggedUser();
				$config = $this->commerce->getConfig();
				$amount = 0;
				
				foreach($this->commerce->getCart() as $cart)
				{
					$amount +=  (floatval($cart['envoltura']) + floatval($cart['price'])) * intval($cart['quantity']);
				}

				$sending = 0;

				if(0 != get_post('sending'))
				{
					$sql = sprintf('SELECT price FROM sending WHERE id = %d', get_post('sending'));
					$query = $this->commerce->executeQuery($sql);
					$sending = $query[0]['price'];
				}

				$amount += floatval($sending);

				if(null != get_post('factura'))
				{
					$iva = floatval($config['iva'])/100 * floatval($amount);
					$amount += $iva;
				}

				$paypal = new paypal_class();
				$paypal->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
				//$paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

				$paypal
					->add_field('amount', $amount)
					->add_field('business', $config['email'])
					->add_field('cancel_return', base_url().'cart/cancel')
					->add_field('currency_code', 'MXN')				
					->add_field('first_name', $user['name'])
					->add_field('item_name', 'Compra Dovana')
					->add_field('last_name', $user['first_name'].' '.$user['last_name'])
					->add_field('return', base_url().'cart/success')
	  				->submit_paypal_post()
	  			;
			}	
			else
			{
				$this->session->set_flashdata('checkout_error', 'La validación de los campos es incorrecta.');
				redirect(base_url().'cart/checkout');
			}
		}
		else
		{
			$this->session->set_flashdata('error_login_redirect_checkout', 'Debes iniciar sesion para poder comprar.');
			redirect(base_url().'site/cart');
		}
	}


	public function success()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{			
			if(isset($_POST['payer_id']) and $_POST['payer_id'] != null and isset($_POST['payment_date']) and $_POST['payment_date'] != null and isset($_POST['verify_sign']) and $_POST['verify_sign'] != null and isset($_POST['txn_id']) and $_POST['txn_id'] != null)
			{
				if($this->commerce->savePurchase())
				{
					$this->commerce->removeCart();
					$this->session->set_userdata('checkout', null);
					$config   = $this->commerce->getConfig();
					$array    = $this->commerce->getLastPurchase();
					$products = $array['products'];
					$address  = $array['address'];
					$user     = $array['user'];
					$this->view('success', array('products' => $products, 'user' => $user, 'address' => $address));
				


					$body = '<!DOCTYPE html><html lang="es"><head><meta charset="utf-8" /><style type="text/css">article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block}audio,canvas,video{display:inline-block}audio:not([controls]){display:none;height:0}[hidden],template{display:none}html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}a{background:0 0}a:focus{outline:thin dotted}a:active,a:hover{outline:0}h1{font-size:2em;margin:.67em 0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0}mark{background:#ff0;color:#000}code,kbd,pre,samp{font-family:monospace,serif;font-size:1em}pre{white-space:pre-wrap}q{quotes:"\201C" "\201D" "\2018" "\2019"}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:0}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0}button,input,select,textarea{font-family:inherit;font-size:100%;margin:0}button,input{line-height:normal}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}input[type=checkbox],input[type=radio]{box-sizing:border-box;padding:0}input[type=search]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}textarea{overflow:auto;vertical-align:top}table{border-collapse:collapse;border-spacing:0}#container-table{background:#fff;padding:25px 10px;margin-bottom:25px}#table-details-purchase{margin:auto;width:700px}.text{color:#333;font-size:13px}.text p{margin:10px 0}.details{border:1px solid #ccc;width:680px}span{color:#eb4d41}.details thead{background-color:#eb4d41}.details thead th{color:#fff;font-size:13px;font-weight:400;padding:7px 0}.details tbody td{font-size:12px;padding:7px 14px}.column-center{text-align:center}#list-product{margin-bottom:20px}</style></head><body><div id="container-table"><table id="table-details-purchase"><tr><td class="text"><p>Hola <span>'.ucwords($user['first_name']).' '.ucwords($user['last_name']).'</span></p></td></tr><tr><td class="text"><p>A continuación encontrarás todos los detalles de tu compra:</p></td></tr><tr><td><table id="list-product" class="details"><thead><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></thead><tbody>';

              
					foreach ($products as $product)
					{
						$body .= '<tr><td>'.$product['name'].'</td><td class="column-center">'.$product['quantity'].'</td><td class="column-center">$'.$product['unit_price'].'</td><td class="column-center">$'.$product['total_price'].'</td></tr>';
					}

					$body .= '</table></td></tr><tr><td><table class="details"><thead><th>Dirección de Envío:</th></thead><tbody>';
					$body .= '<tr><td>'.$user['first_name'].' '.$user['last_name'].'</td></tr><tr><td>México - '.$address['estado'].'</td></tr><tr><td>'.$address['municipio'].' - '.$address['colonia'].'</td></tr><tr><td>'.$address['codigo_postal'].'</td></tr><tr><td>'.$address['calle'].' - '.$address['no_exterior'].'</td></tr>';
					$body .= '</tbody></table></td></tr><tr><td class="text"><p>Muchas gracias por comprar en nuestra tienda!</p></td></tr></table></div></body></html>';

					$this->email->initialize(array('mailtype' => 'html', 'charset' => 'utf-8'));

					$this->email->from('karlozz157@gmail.com');
					$this->email->to($user['email']);
					$this->email->bcc($config['email']); 

					$this->email->subject('Tu compra ha sido confirmada');
					$this->email->message($body);	
					
					$this->email->send();


				}
				else
				{
					redirect(base_url().'cart/list_purchase');
				}
			}
			else
			{
				show_404();
			}
		}
		else
		{
			show_404();
		}
	}


	public function cancel()
	{
		$user = $this->commerce->getLoggedUser();

		if(false === empty($user))
		{		
			unset($_SESSION['checkout']);
			$this->commerce->removeCart();
			redirect(base_url().'cart/list_cart');
		}
		else
		{
			show_404();
		}
	}

}
