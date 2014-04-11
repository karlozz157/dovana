<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

ini_set('display_errors', true);

class BackEnd extends MY_Crud{

	/**
	 *
	 * @return Boolean
	 */
	public function login()
	{
		$data = array('admin_username' => get_post('admin_username'), 'admin_password' => base64_encode($_POST['admin_password']));

		$this->setTable('admin');
		$result = $this->getSingleResult($data);

		if(!empty($result))
		{
			$_SESSION['admin_auth'] = $result;
			return true;
		}

		return false;
	}

	/**
	 *
	 * @param Date $start
	 * @param Date $end
	 * @return Array
	 */
	public function getSalesByRangeDate($start = null, $end = null)
	{
		$sql = sprintf('SELECT SUM(purchase_product.total_price) AS total FROM purchase
				INNER JOIN purchase_product
				ON purchase.id = purchase_product.id_purchase
				WHERE purchase.date >= "%s" AND purchase.date <= "%s"', $start, $end);

		$query = $this->executeQuery($sql);
		return $query[0];
	}

	/**
	*
	 * @param Date $start
	 * @param Date $end
	 * @return Array
	 */
	public function getPurchasesByRangeDate($start = null, $end = null)
	{
		$sql = sprintf('SELECT COUNT(*) AS count FROM purchase
				WHERE date >= "%s" AND date <= "%s"', $start, $end);

		$query = $this->executeQuery($sql);
		return $query[0];		
	}


	/**
	*
	 * @param Date $start
	 * @param Date $end
	 * @return Array
	 */
	public function getCountProductSaleByRangeDate($start = null, $end = null)
	{
		$sql = sprintf('SELECT SUM(pp.quantity) AS count
				FROM purchase
				INNER JOIN purchase_product AS pp
				ON purchase.id = pp.id_purchase
				INNER JOIN product
				ON pp.id_product = product.id
				WHERE purchase.date >= "%s" AND purchase.date <= "%s"', $start, $end);

		$query = $this->executeQuery($sql);	
		return $query[0]['count'];
	}

	/**
	*
	 * @param Date $start
	 * @param Date $end
	 * @return Array
	 */
	public function getProductSaleByRangeDate($start = null, $end = null)
	{
		$sql = sprintf('SELECT product.name, SUM(pp.quantity) AS count
				FROM purchase
				INNER JOIN purchase_product AS pp
				ON purchase.id = pp.id_purchase
				INNER JOIN product
				ON pp.id_product = product.id
				WHERE purchase.date >= "%s" AND purchase.date <= "%s"
				GROUP BY product.name', $start, $end);

		return $this->executeQuery($sql);	
	}

	/**
	 *
	 * @return Array
	 */
	public function getSliders($limit = null, $start = null)
	{
		$this->setTable('slider');
		return $this->getAllResults(array(), $limit, $start);
	}

	/**
	 *
	 * @param Int $id
	 * @return Array
	 */
	public function getSlider($id = null)
	{
		$this->setTable('slider');
		return $this->getSingleResult(array('id' => $id));
	}

	public function newSlider()
	{
		$data = array(
			'type' => isset($_POST['type']) ? $_POST['type']: 1,
			'url'  => get_post('url'),
		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}		

		$this->setTable('slider');
		$this->insert($data);
	}

	/**
	 *
	 * @param int $id
	 */
	public function updateSlider($id = null)
	{
		$data = array(
			'type' => isset($_POST['type']) ? $_POST['type']: 1,
			'url'  => get_post('url'),
		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}		

		$this->setTable('slider');
		$this->update($data, array('id' => $id));
	}	

	/**
	 *
	 * @param int $id
	 */
	public function deleteSlider($id)
	{
		$this->setTable('slider');
		$this->delete(array('id' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getCategories($limit = null, $start = null)
	{
		$this->setTable('category');
		return $this->getAllResults(array(), $limit, $start);
	}

	/**
	 *
	 * @param Int $id
	 * @return Array
	 */
	public function getCategory($id = null)
	{
		$this->setTable('category');
		return $this->getSingleResult(array('id' => $id));
	}


	public function newCategory()
	{
		$data = array(
			'sub_category' => $_POST['sub_category'],
			'name'         => get_post('name'),
			'description'  => get_post('description'),
			'active'       => isset($_POST['active']) ? 1 : 0,
			'show_price'   => isset($_POST['show_price']) ? 1 : 0,
		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}

		$this->setTable('category');
		$this->insert($data);
	}


	/**
	 *
	 * @param Int $id
	 */
	public function updateCategory($id = null)
	{
		$data = array(
			'sub_category' => $_POST['sub_category'],
			'name'         => get_post('name'),
			'description'  => get_post('description'),
			'active'       => isset($_POST['active']) ? 1 : 0,
			'show_price'   => isset($_POST['show_price']) ? 1 : 0,
		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}

		$this->setTable('category');
		$this->update($data, array('id' => $id));
	}

	/**
	 *
	 * @param Int $id
	 */
	public function deleteCategory($id = null)
	{
		$category = $this->getCategory($id);

		if($category['image'] != '')
			unlink(sprintf('assets/media/img/%s', $category['image']));

		$this->setTable('category');
		$this->delete(array('id' => $id));

		$this->setTable('product');
		$this->delete(array('category' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getProducts($limit = null, $start = null)
	{
		$this->setTable('product');
		return $this->getAllResults(array(), $limit, $start);
	}

	/**
	 *
	 * @return Array
	 */
	public function getProduct($id = null)
	{
		$this->setTable('product');
		return $this->getSingleResult(array('id' => $id));
	}

	public function newProduct()
	{
		$data = array(
			'category'    => get_post('category'),
			'name'        => get_post('name'),
			'description' => $_POST['description'],
			'sku'         => get_post('sku'),
			'price'       => get_post('price'),
			'active'      => isset($_POST['active']) ? 1 : 0,
			'lightbox'    => isset($_POST['lightbox']) ? 1 : 0,
			'highlight'   => isset($_POST['highlight']) ? 1: 0,
			'stock'       => get_post('stock'),
			'products_related' => json_encode(explode(',', get_post('products_related'))),
 		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}

		$this->setTable('product');
		$productId = $this->insert($data);

		if(isset($_FILES['images']['name']) AND count($_FILES['images']['name']) > 0)
		{
			foreach($_FILES['images']['name'] as $key => $image)
			{
				if(move_uploaded_file($_FILES['images']['tmp_name'][$key], 'assets/media/img/' . $image))
				{
					$this->setTable('images');
					$this->insert(array('name' => $image, 'id_product' => $productId));
				}
			}
		}
	}

	/**
	 *
	 * @param Int $id
	 */
	public function updateProduct($id = null)
	{
		$data = array(
			'category'    => get_post('category'),
			'name'        => get_post('name'),
			'description' => $_POST['description'],
			'sku'         => get_post('sku'),
			'price'       => get_post('price'),
			'active'      => isset($_POST['active']) ? 1 : 0,
			'lightbox'    => isset($_POST['lightbox']) ? 1 : 0,
			'highlight'   => isset($_POST['highlight']) ? 1: 0,
			'stock'       => get_post('stock'),
			'products_related' => json_encode(explode(',', get_post('products_related'))),
 		);

		if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] != '')
		{
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/media/img/'.$_FILES['image']['name']))
				$data['image'] = $_FILES['image']['name'];
		}

		$this->setTable('product');
		$this->update($data, array('id' => $id));

		if(isset($_FILES['images']['name']) AND count($_FILES['images']['name']) > 0)
		{
			foreach($_FILES['images']['name'] as $key => $image)
			{
				if(move_uploaded_file($_FILES['images']['tmp_name'][$key], 'assets/media/img/' . $image))
				{
					$this->setTable('images');
					$this->insert(array('name' => $image, 'id_product' => $id));
				}
			}
		}		
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getImagesByIdProduct($id = null)
	{
		$this->setTable('images');
		return $this->getAllResults(array('id_product' => $id));
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getImageProductById($id = null)
	{
		$this->setTable('images');
		return $this->getSingleResult(array('id' => $id));		
	}

	/**
	 *
	 * @param int $id
	 */
	public function deleteImageProductById($id = null)
	{
		$image = $this->backend->getImageProductById($id);
		unlink(sprintf('assets/media/img/%s', $image['name']));		
		$this->setTable('images');
		$this->delete(array('id' => $id));
	}


	/**
	 *
	 * @param Int $id
	 */
	public function deleteProduct($id = null)
	{
		$product = $this->getProduct($id);

		if($product['image'] != '')
			unlink(sprintf('assets/media/img/%s', $product['image']));

		$this->setTable('product');
		$this->delete(array('id' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getSendings($limit = null, $start = null)
	{
		$this->setTable('sending');
		return $this->getAllResults(array(), $limit, $start);
	}

	public function getSendingActives()
	{
		$this->setTable('sending');
		return $this->getAllResults(array('active' => 1));		
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getSending($id = null)
	{
		$this->setTable('sending');
		return $this->getSingleResult(array('id' => $id));
	}

	public function newSending()
	{
		$data = array(
			'name'   => get_post('name'),
			'price'  => get_post('price'),
			'active' => isset($_POST['active']) ? 1 : 0,
		);

		$this->setTable('sending');
		$this->insert($data);
	}

	/**
	 *
	 * @param int $id
	 */
	public function updateSending($id = null)
	{
		$data = array(
			'name'   => get_post('name'),
			'price'  => get_post('price'),
			'active' => isset($_POST['active']) ? 1 : 0,
		);

		$this->setTable('sending');
		$this->update($data, array('id' => $id));
	}

	/**
	 *
	 * @param Int $id
	 */
	public function deleteSending($id = null)
	{
		$this->setTable('sending');
		$this->delete(array('id' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getEnvolturas($limit = null, $start = null)
	{
		$this->setTable('envolturas');
		return $this->getAllResults(array(), $limit, $start);
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getEnvoltura($id = null)
	{
		$this->setTable('envolturas');
		return $this->getSingleResult(array('id' => $id));
	}

	public function newEnvoltura()
	{
		$data = array(
			'name'   => get_post('name'),
			'price'  => get_post('price'),
			'status' => isset($_POST['status']) ? 1 : 0,
		);

		$this->setTable('envolturas');
		$this->insert($data);
	}

	/**
	 *
	 * @param int $id
	 */
	public function updateEnvoltura($id = null)
	{
		$data = array(
			'name'   => get_post('name'),
			'price'  => get_post('price'),
			'status' => isset($_POST['status']) ? 1 : 0,
		);

		$this->setTable('envolturas');
		$this->update($data, array('id' => $id));
	}


	/**
	 *
	 * @param Int $id
	 */
	public function deleteEnvoltura($id = null)
	{
		$this->setTable('envolturas');
		$this->delete(array('id' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getUsers($limit = null, $start = null)
	{
		$this->setTable('user');
		return $this->getAllResults(array(), $limit, $start);		
	}
	/**
	 *
	 * @return Int $id
	 */	
	public function deleteUser($id = null)
	{
		$this->setTable('user');
		$this->delete(array('id' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getPurchase($limit = null, $start = null)
	{
		$sql = 	'SELECT purchase.id ,purchase.date, user.first_name, user.last_name, paypal.txn_id, SUM(purchase_product.total_price) AS total FROM purchase
				INNER JOIN paypal 
				ON purchase.id = paypal.id_purchase
				INNER JOIN purchase_product
				ON purchase.id = purchase_product.id_purchase
				INNER JOIN user
				ON purchase.id_user = user.id
				GROUP BY purchase.id ORDER BY purchase.id DESC';

		if(!is_null($limit) && !is_null($start))
			$sql .= sprintf(' LIMIT %d, %d', $start, $limit);

		return $this->executeQuery($sql);
	}

	/**
	 *
	 * @param int $id
	 */
	public function viewNotification($id = null)
	{
		$this->setTable('purchase');
		$this->update(array('view_admin' => 1), array('id' => $id));
	}

	public function getNotifications()
	{
		$sql = sprintf('SELECT purchase.id ,purchase.date, user.first_name, user.last_name, paypal.txn_id, SUM(purchase_product.total_price) AS total FROM purchase
				INNER JOIN paypal 
				ON purchase.id = paypal.id_purchase
				INNER JOIN purchase_product
				ON purchase.id = purchase_product.id_purchase
				INNER JOIN user
				ON purchase.id_user = user.id
				WHERE purchase.view_admin = %d
				GROUP BY purchase.id ORDER BY purchase.id DESC', 0);
		$notifications = $this->executeQuery($sql);

		$sql   = sprintf('SELECT COUNT(*) AS count FROM purchase WHERE view_admin = %d', 0);
		$count = $this->executeQuery($sql);

		return array('messages' => $notifications, 'count' => $count[0]['count']);
	}


	/**
	 * @param int $id
	 * @return Array
	 */
	public function getPurchaseById($id = null)
	{
		$sqlProduct = sprintf('SELECT product.name, pproduct.quantity, pproduct.unit_price, pproduct.total_price
			 	FROM purchase
				INNER JOIN purchase_product AS pproduct
				ON purchase.id = pproduct.id_purchase
				INNER JOIN product
				ON pproduct.id_product = product.id
				WHERE purchase.id = %d', $id);

		$sqlPayPal = sprintf('SELECT paypal.payment_date, paypal.verify_sign, paypal.txn_id FROM purchase
				INNER JOIN paypal
				ON purchase.id = paypal.id_purchase
				WHERE purchase.id = %d', $id);

		$sqlAddress = sprintf('SELECT estados.nombre AS estado, municipios.nombre AS municipio ,address.colonia, address.codigo_postal, address.calle, address.no_exterior, address.no_interior
				FROM purchase
				INNER JOIN purchase_address AS address
				ON purchase.id = address.id_purchase
				INNER JOIN estados
				ON address.estado = estados.id
				INNER JOIN municipios
				ON address.municipio = municipios.id
				WHERE purchase.id = %d',  $id);

		$sqlMessage = sprintf('SELECT pm.from_name, pm.from_second_name, pm.from_last_name, pm.to_name, pm.to_second_name, pm.to_last_name, pm.from_message
				FROM purchase_message AS pm
				INNER JOIN purchase
				ON pm.id_purchase = purchase.id
				WHERE purchase.id = %d', $id);

		$sqlUser = sprintf('SELECT user.name, user.first_name, user.last_name, user.email
							FROM purchase
							INNER JOIN user
							ON purchase.id_user = user.id
							WHERE purchase.id', $id);

		$products = $this->executeQuery($sqlProduct);
		$user     = $this->executeQuery($sqlUser);
		$address  = $this->executeQuery($sqlAddress);
		$paypal   = $this->executeQuery($sqlPayPal);
		$message  = $this->executeQuery($sqlMessage);

		return array('products' => $products, 'user' => $user[0], 'paypal' => $paypal[0], 'address' => $address[0], 'message' => $message[0]);
	}	

	public function getConfig()
	{
		$this->setTable('config');
		return $this->getSingleResult(array('id' => 1));
	}

	public function setConfig()
	{
		$this->setTable('config');
		$this->update(array('name'  => $this->input->post('name', true),'email' => $this->input->post('email', true)
			), array('id' => 1));
	}

}
