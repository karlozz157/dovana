<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', true);

session_start();

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(empty($_SESSION['admin_auth']))
			redirect(base_url().'login');
	}

	/**
	 * @param String $fileName
	 * @param Array $vars
	 */
	private function view($fileName, $vars = null)
	{
		$this->load->view('admin/header', array('fullname' => $_SESSION['admin_auth']['admin_fullname']));
		$this->load->view(sprintf('admin/%s', $fileName), $vars);
		$this->load->view('admin/footer');		
	}

	/**
	 *
	 * @param Date $start
	 * @param Date $end
	 */
	public function dashboard($start = null, $end = null)
	{	
		$start = null === $start ? date('Y-m-d') : $start;
		$end   = null === $end ? date('Y-m-d') : $end;

		$sales    = $this->backend->getSalesByRangeDate($start, $end);
		$sales    = $sales['total'] ? $sales['total'] : 0;

		$purchase = $this->backend->getPurchasesByRangeDate($start, $end);
		$purchase = $purchase['count'] ? $purchase['count'] : 0;

		$products = $this->backend->getProductSaleByRangeDate($start, $end);
		$count    = $this->backend->getCountProductSaleByRangeDate($start, $end);

		$chartProduct  = array();

		foreach ($products as $product)
		{
			$chartProduct[] = array(
				'label'   => sprintf('%s [%d]', $product['name'], $product['count']),
				'data'    => $product['count'] / $count * 100,
				'ammount' => $product['count'],
			);

		}

		$this->view('index', array('start' => $start, 'end' => $end, 'sales' => $sales, 'purchase' => $purchase, 'chartProduct' => json_encode($chartProduct)));
	}

	public function slider_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getSliders())/ $limit);
		$sliders = $this->backend->getSliders($limit, $start);
		$this->view('slider_list', array('sliders' => $sliders, 'pages' => $pages));
	}	

	public function slider_new()
	{
		if(empty($_POST))
		{
			$this->view('slider_new');
		}
		else
		{
			$this->backend->newSlider();
			$this->session->set_flashdata('success', 'El slider fue agregado.');
			redirect(base_url().'admin/slider_list');			
		}
	}

	public function slider_edit($id = null)
	{
		if(empty($_POST))
		{
			$slider = $this->backend->getSlider($id);
			if(!$slider)
				show_404();

			$this->view('slider_edit', array('slider' => $slider));
		}
		else
		{
			$this->backend->updateSlider($id);
			$this->session->set_flashdata('success', 'El slider fue actualizado.');
			redirect(base_url().'admin/slider_list');			
		}
	}

	public function slider_delete($id = null)
	{
		$this->backend->deleteSlider($id);
		$this->session->set_flashdata('success', 'El slider fue eliminado.');
		redirect(base_url().'admin/slider_list');
	}

	public function category_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getCategories())/ $limit);
		$categories = $this->backend->getCategories($limit, $start);
		$this->view('category_list', array('categories' => $categories, 'pages' => $pages));
	}

	public function category_new()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		if(false === $this->form_validation->run())
		{
			$categories = $this->backend->getCategories();
			$this->view('category_new', array('categories' => $categories));
		}
		else
		{
			$this->backend->newCategory();
			$this->session->set_flashdata('success', 'La categoría fue agregada.');
			redirect(base_url().'admin/category_list');
		}
	}	

	/**
	 *
	 * @param Int $id
	 */
	public function category_edit($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		if(false === $this->form_validation->run())
		{
			$category   = $this->backend->getCategory($id);
			$categories = $this->backend->getCategories();

			if(!$category)
				show_404();

			$this->view('category_edit', array('category' => $category, 'categories' => $categories));
		}
		else
		{
			$this->backend->updateCategory($id);
			$this->session->set_flashdata('success', 'La categoría fue actualizada.');
			redirect(base_url().'admin/category_list');
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function category_delete($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->deleteCategory($id);
		$this->session->set_flashdata('success', 'La categoría fue eliminada.');
		redirect(base_url().'admin/category_list');
	}

	public function product_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getProducts())/ $limit);
		$products   = $this->backend->getProducts($limit, $start);
		$this->view('product_list', array( 'products' => $products, 'pages' => $pages));
	}

	public function product_new()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');
		$this->form_validation->set_rules('sku', '', 'required');

		if(false === $this->form_validation->run())
		{
			$categories = $this->backend->getCategories();
			$this->view('product_new', array('categories' => $categories));
		}
		else
		{
			$this->backend->newProduct();
			$this->session->set_flashdata('success', 'El producto fue agregado.');
			redirect(base_url().'admin/product_list');
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function product_edit($id)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');
		$this->form_validation->set_rules('sku', '', 'required');

		if(false === $this->form_validation->run())
		{
			$categories = $this->backend->getCategories();
			$product    = $this->backend->getProduct($id);
			$images     = $this->backend->getImagesByIdProduct($id);
			
			if(!$product)
				show_404();

			$this->view('product_edit', array('categories' => $categories, 'product' => $product, 'images' => $images));
		}
		else
		{
			$this->backend->updateProduct($id);
			$this->session->set_flashdata('success', 'El producto fue actualizado.');
			redirect(base_url().'admin/product_list');			
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function product_delete($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->deleteProduct($id);
		$this->session->set_flashdata('success', 'El producto fue eliminado.');
		redirect(base_url().'admin/product_list');
	}

	/**
	 *
	 * @param Int $id
	 */
	public function stock_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getProducts())/ $limit);
		
		if(isset($_GET['order']))
		{
			$this->db->order_by('stock', $_GET['order']);
		}		
		
		$products   = $this->backend->getProducts($limit, $start);
		$this->view('stock_list', array( 'products' => $products, 'pages' => $pages));
	}


	/**
	 *
	 * @param Int $id
	 */
	public function deleteImageProduct($id)
	{
		if(true === $this->input->is_ajax_request())
		{
			$this->backend->deleteImageProductById($id);
			echo json_encode(array('success' => true));
		}
		else
		{
			show_404();
		}
	}

	public function sending_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getSendings())/ $limit);
		$sendings = $this->backend->getSendings($limit, $start);
		$this->view('sending_list', array( 'sendings' => $sendings, 'pages' => $pages));
	}

	public function sending_new()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');

		if(false === $this->form_validation->run())
		{
			$this->view('sending_new');
		}
		else
		{
			$this->backend->newSending();
			$this->session->set_flashdata('success', 'El envío fue agregado.');
			redirect(base_url().'admin/sending_list');				
		}
	}

	public function sending_edit($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');

		if(false === $this->form_validation->run())
		{
			$sending = $this->backend->getSending($id);
			$this->view('sending_edit', array('sending' => $sending));
		}
		else
		{
			$this->backend->updateSending($id);
			$this->session->set_flashdata('success', 'El envío fue actualizado.');
			redirect(base_url().'admin/sending_list');				
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function sending_delete($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->deleteSending($id);
		$this->session->set_flashdata('success', 'El envío fue eliminado.');
		redirect(base_url().'admin/sending_list');		
	}

	public function envoltura_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getEnvolturas())/ $limit);
		$envolturas = $this->backend->getEnvolturas($limit, $start);
		$this->view('envoltura_list', array( 'envolturas' => $envolturas, 'pages' => $pages));
	}

	public function envoltura_new()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');

		if(false === $this->form_validation->run())
		{
			$this->view('envoltura_new');
		}
		else
		{
			$this->backend->newEnvoltura();
			$this->session->set_flashdata('success', 'La envoltura fue agregado.');
			redirect(base_url().'admin/envoltura_list');				
		}
	}

	public function envoltura_edit($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('price', '', 'numeric|required');

		if(false === $this->form_validation->run())
		{
			$envoltura = $this->backend->getEnvoltura($id);
			$this->view('envoltura_edit', array('envoltura' => $envoltura));
		}
		else
		{
			$this->backend->updateEnvoltura($id);
			$this->session->set_flashdata('success', 'La envoltura fue actualizado.');
			redirect(base_url().'admin/envoltura_list');				
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function envoltura_delete($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->deleteEnvoltura($id);
		$this->session->set_flashdata('success', 'La envoltura fue eliminada.');
		redirect(base_url().'admin/envoltura_list');		
	}	

	public function user_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getUsers())/ $limit);		
		$users = $this->backend->getUsers($limit, $start);
		$this->view('user_list', array('users' => $users, 'pages' => $pages));
	}

	/**
	 *
	 * @param Int $id
	 */
	public function user_delete($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->deleteUser($id);
		$this->session->set_flashdata('success', 'El usuario fue eliminado.');
		redirect(base_url().'admin/user_list');		
	}

	public function purchase_list($pag = 1)
	{
		$limit = 10;
		$start = 1 == $pag ? 0 : ($pag - 1) * $limit;
		$pages = ceil(count($this->backend->getPurchase())/ $limit);
		$purchase = $this->backend->getPurchase($limit, $start);
		$this->view('purchase_list', array('purchase' => $purchase, 'pages' => $pages));
	}

	public function purchase_view($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$this->backend->viewNotification($id);

		$data = $this->backend->getPurchaseById($id);
		$this->view('purchase_view', array('user' => $data['user'], 'paypal' => $data['paypal'], 'address' => $data['address'], 'products' => $data['products'], 'message' => $data['message']));
	}


	public function config()
	{
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('email', '', 'valid_email|required');

		if(false === $this->form_validation->run())
		{
			$config = $this->backend->getConfig();
			$this->view('config', array('config' => $config));
		}
		else
		{
			$this->backend->setConfig();
			redirect(base_url().'admin/config');
		}
	}

	public function thumbs($size)
	{
		$dirName = 'assets/media/img';

		$dir = opendir($dirName);

		while($images = readdir($dir))
		{
			if($images != '..' && $images != '.' && $images != '.DS_Store')
				if(is_file($dirName . '/' . $images))
					$this->makeThumb($dirName . '/' . $images, $size, $size, sprintf('_%dx%d', $size, $size));
		}
	}

  	private function makeThumb($image,$new_width,$new_height,$thum_name)
  	{
		$image = $image;
		list($width,$height) = getimagesize($image);
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		$new_name_image = substr($image,0,strpos($image, '.')) . $thum_name . '.' . $ext;
		$new_name_image = substr($new_name_image, 0, strrpos($new_name_image, '/')) . '/' . $new_width . 'x' . $new_height . substr($new_name_image, strrpos($new_name_image, '/'));

		if($ext=="jpg" || $ext=="jpeg")
		{
			$image_dst=imagecreatetruecolor($new_width,$new_height);
			$image_src=imagecreatefromjpeg($image);
			imagecopyresampled($image_dst,$image_src,0,0,0,0,$new_width,$new_height,$width,$height);
			imagejpeg($image_dst,$new_name_image);
		}else
		{
			$image_dst=imagecreatetruecolor($new_width,$new_height);
			$image_src=imagecreatefrompng($image);
			imagecopyresampled($image_dst,$image_src,0,0,0,0,$new_width,$new_height,$width,$height);
			imagepng($image_dst,$new_name_image);
		}
	}

}
