<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

class Commerce extends MY_Crud{

	/**
	 *
	 * @return Array
	 */
	public function getLoggedUser()
	{
		$this->setTable('user');

		$user = $this->getSingleResult(array(
			'email'    => isset($_SESSION['email'])?$_SESSION['email']:null,
			'password' => isset($_SESSION['password'])?$_SESSION['password']:null,
		));

		return $user;
	}

	/*** Header ***/

	/**
	 *
	 * @param Array
	 */
	public function getConfig()
	{
		$this->setTable('config');
		return $this->getSingleResult(array('id' => 1));		
	}

	/**
	 *
	 * @return Array
	 */
	public function getCategoriesPrincipal()
	{
		$this->setTable('category');
		return $this->getAllResults(array('active' => 1, 'sub_category' => 0));
	}

	/**
	 *
	 * @param int $id
	 * @return Array 
	 */
	public function getSubCategories($id)
	{
		$this->setTable('category');
		return $this->getAllResults(array('active' => 1, 'sub_category' => $id));
	}

	/**
	 *
	 * @return Array
	 */
	public function getCategories()
	{
		$this->setTable('category');
		return $this->getAllResults(array('active' => 1));		
	}


	/**
	 *
	 * @param int $id
	 * @return Arrray
	 */
	public function getCategory($id = null)
	{
		$this->setTable('category');
		return $this->getSingleResult(array('active' => 1, 'id' => $id));
	}

	/*** Search ***/
	
	/**
	 *
	 * @param String $product
	 */
	public function searchProducts($product = null)
	{
		$sql = 'SELECT * FROM product WHERE name LIKE "%'.$product.'%"';
		return $this->executeQuery($sql);
	}

	/*** Index ***/

	/**
	 *
	 * @return Array
	 */
	public function getSlider()
	{
		$this->setTable('slider');
		return $this->getAllResults(array('type' => 1));
	}

	/**
	 *
	 * @return Array
	 */
	public function getPromociones()
	{
		$this->setTable('slider');
		return $this->getAllResults(array('type' => 2));
	}

	/*** Category ***/

	public function getParentCategoryByCategories($id = null)
	{
		$return = array();

		$sql = 'SELECT *
				FROM category ';

		$result = $this->executeQuery($sql . sprintf('WHERE id = %d', $id));
		$result = $result[0];

		if(0 == $result['sub_category'])
		{
			$return[]['parentCategory'] = $result;
		}
		else
		{
			$result = $this->executeQuery($sql . sprintf('WHERE id = %d', $result['sub_category']));
			$result = $result[0];
			$return[]['parentCategory'] = $result;
		}

		$result = $this->executeQuery($sql . sprintf('WHERE sub_category = %d', $result['id']));
		$return[]['subCategories'] = $result;

		return $return;
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getProductsByCategory($id = null)
	{
		$sql = sprintf('SELECT * 
				FROM product
				WHERE category = %d
				AND active = %d', $id, 1);

		return $this->executeQuery($sql);
	}

	/*** Product ***/

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getProduct($id = null)
	{
		$sql = sprintf('SELECT * FROM product WHERE id = %d', $id);
		$product = $this->executeQuery($sql);

		if(!empty($product))
			return $product[0];
		
	}

	/**
	 *
	 * @param int $category
	 * @return array
	 */
	public function getRelatedProducts($product)
	{
		$products = array();
		$count    = 0;

		$sql = sprintf('SELECT products_related AS products
			FROM product
			WHERE id = %d', $product);

		$productsRelated = $this->executeQuery($sql);
		$productsRelated = $productsRelated[0];



		if(!empty($productsRelated['products']))
		{
			foreach(json_decode($productsRelated['products']) as $sku)
			{
				$sql = sprintf('SELECT * 
					FROM product
					WHERE sku = "%s"', $sku);

				$result = $this->executeQuery($sql);
				
				$count++;

				if(!empty($result[0]) and $count < 6)
					$products[] = $result[0];
			}
		}

		return $products;
	}

	/*** Login ***/

	/**
	 *
	 * @return Array|Boolean
	 */
	public function login()
	{
		$email    = get_post('email');
		$password = get_post('password');
		$sql      = sprintf('SELECT * FROM user WHERE email = "%s"', $email);
		$query    = $this->executeQuery($sql);

		if(NULL == $query)
		{
			$json = array('user_doesnt_exist' => true);
		}
		else
		{
			$sql .= sprintf('AND password = "%s"', base64_encode($password));

			$result = $this->executeQuery($sql);

			if(NULL == $result)
			{
				$json = array('password_fail' => true);
			}
			else
			{
				$_SESSION['email']    = $result[0]['email'];
				$_SESSION['password'] = $result[0]['password'];
				$json = array('login' => true);
			}
		}

		return json_encode($json);
	}

	/*** Register ***/
	
	/**
	 *
	 * @return Boolean
	 */
	public function register()
	{
		$data = array(
			'email'      => get_post('email'),
			'password'   => base64_encode(get_post('password')),
			'name'       => get_post('name'),
			'first_name' => get_post('first_name'),
			'last_name'  => get_post('last_name'),
			'gender'     => get_post('gender'),
			'birthday'   => get_post('birthday'),
			'telephone'  => get_post('telephone'),
			'cellphone'  => get_post('cellphone'),
		);

		$sql = sprintf('SELECT id FROM user WHERE email = "%s"', $data['email']);
		$query = $this->executeQuery($sql);

		if(empty($query))
		{
			$this->setTable('user');
			$this->insert($data);
			$_SESSION['email']    = $data['email'];
			$_SESSION['password'] = $data['password'];
			return true;
		}

		return false;
	}

	/*** addCart ***/

	/**
	 *
	 * @param int $product
	 * @param int $quantity
	 */
	public function addCart($product, $quantity, $envoltura)
	{
		$user = $this->getLoggedUser();
		$this->setTable('cart');
		
		if(1 === $this->numRows(array('id_user' => $user['id'], 'id_product' => $product)))
		{
			$result   = $this->getSingleResult(array('id_user' => $user['id'], 'id_product' => $product));
			$quantity = $result['quantity'] + $quantity;

			$this->removeCart($product);
		}

		$this->insert(array('id_user' => $user['id'], 'id_product' => $product, 'quantity' => $quantity, 'envoltura' => $envoltura));
	}

	/**
	 *
	 * @param int $id
	 * @return Boolean
	 */
	public function existenceProduct($id = null)
	{
		$sql = sprintf('SELECT id FROM product
				WHERE id = %d
				AND active = %d', $id, 1);

		$query = $this->executeQuery($sql);

		if(!empty($query))
			return true;

		return false;
	}	

	/*** removeCart ***/

	public function removeCart()
	{
		$user = $this->getLoggedUser();

		$this->setTable('cart');
		$this->delete(array('id_user' => $user['id']));
	}

	/*** Checkout ***/	

	/**
	 *
	 * @return Array
	 */
	public function getCart()
	{
		$user = $this->getLoggedUser();

		$sql = sprintf('SELECT cart.id, cart.quantity, cart.id_product, cart.envoltura, product.name, product.image, product.sku, product.description, product.price 
				FROM cart
				INNER JOIN product
				ON cart.id_product = product.id
				WHERE cart.id_user = %d', $user['id']);

		return $this->executeQuery($sql);
	}


	/**** Success ***/

	/**
	 *
	 * @return Boolean
	 */
	public function savePurchase()
	{
		$paypal = array(
			'payer_id'     => get_post('payer_id'),
			'payment_date' => get_post('payment_date'),
			'verify_sign'  => get_post('verify_sign'),
			'txn_id'       => get_post('txn_id'),
		);

		$this->setTable('paypal');

		//check if de data paypal not exists
		if(0 === $this->numRows(array('verify_sign' => $paypal['verify_sign'], 'txn_id' => $paypal['txn_id'])))
		{
			//get logged user
			$user = $this->commerce->getLoggedUser();

			//remove last id purchase
			unset($_SESSION['lastIdPurchase']);



			//get checkout
			$checkout = $_SESSION['checkout'];
			$checkout = json_decode($checkout, true);

			//products checkout
			$products = json_decode($checkout['products'], true);


			//save purchase and save last id in a session
			$this->setTable('purchase');
			$this->insert(array('id_user' => $user['id'], 'date' => date('Y-m-d'), 'id_sending' => $checkout['id_sending']));
			$_SESSION['lastIdPurchase'] = $this->db->insert_id();

			//save payapal
			$paypal['id_purchase'] = $_SESSION['lastIdPurchase'];
			$this->setTable('paypal');
			$this->insert($paypal);
			

			//iterate for productos
			foreach($products as $product)
			{
				$purchaseProduct = array(
					'id_purchase' => $_SESSION['lastIdPurchase'],
					'id_product'  => $product['id_product'],
					'quantity'    => $product['quantity'],
					'unit_price'  => $product['price'],
					'total_price' => intval($product['quantity']) * floatval($product['price'])
				);
				
				//save purchase
				$this->setTable('purchase_product');
				$this->insert($purchaseProduct);
			
				//update stock
				$this->setTable('product');
				$product = $this->getSingleResult(array('id' => $purchaseProduct['id_product']));
				$this->update(array('stock' => ($product['stock'] - $purchaseProduct['quantity'])), array('id' => $purchaseProduct['id_product']));

			}

			//save address
			$address  = json_decode($checkout['address'], true); 
			$address['id_purchase'] = $_SESSION['lastIdPurchase'];
			$this->setTable('purchase_address');
			$this->insert($address);

			//save message
			$message  = json_decode($checkout['message'], true); 
			$message['id_purchase'] = $_SESSION['lastIdPurchase'];
			$this->setTable('purchase_message');
			$this->insert($message);

			return true;
		}
		return false;
	}

	/**
	 *
	 * @return Array
	 */
	public function getLastPurchase()
	{
		$user = $this->getLoggedUser();
		$date = date('Y-m-d');
		$id   = $_SESSION['lastIdPurchase'];

		$sqlProduct = sprintf('SELECT product.name, pproduct.quantity, pproduct.unit_price, pproduct.total_price
			 	FROM purchase
				INNER JOIN purchase_product AS pproduct
				ON purchase.id = pproduct.id_purchase
				INNER JOIN product
				ON pproduct.id_product = product.id
				WHERE purchase.id = %d
				AND purchase.id_user = %d
				AND purchase.date = "%s"', $id, $user['id'], $date);

		$sqlAddress = sprintf('SELECT estados.nombre AS estado, municipios.nombre AS municipio ,address.colonia, address.codigo_postal, address.calle, address.no_exterior, address.no_interior
				FROM purchase
				INNER JOIN purchase_address AS address
				ON purchase.id = address.id_purchase
				INNER JOIN estados
				ON address.estado = estados.id
				INNER JOIN municipios
				ON address.municipio = municipios.id
				WHERE purchase.id = %d
				AND purchase.id_user = %d
				AND purchase.date = "%s"',  $id, $user['id'], $date);


		$products = $this->executeQuery($sqlProduct);
		$address  = $this->executeQuery($sqlAddress);

		return array('products' => $products, 'user' => $user, 'address' => $address[0]);
	}

	public function getPurchase()
	{
		$user = $this->getLoggedUser();

		$sql = sprintf('SELECT purchase.id ,purchase.date, paypal.txn_id, SUM(purchase_product.total_price) AS total FROM purchase
				INNER JOIN paypal 
				ON purchase.id = paypal.id_purchase
				INNER JOIN purchase_product
				ON purchase.id = purchase_product.id_purchase
				WHERE purchase.id_user = %d
				GROUP BY purchase.id', $user['id']);

		return $this->executeQuery($sql);
	}

	/**
	 *
	 * @return Array
	 */
	public function getPurchaseDetail($id = null)
	{	
		$user = $this->getLoggedUser();

		$sql = sprintf('SELECT p.id_user, p.date, paypal.payer_id AS paypal, product.name, product.image, product.sku, pp.quantity, pp.unit_price, pp.total_price
				FROM purchase AS p
				INNER JOIN purchase_product AS pp
				ON p.id = pp.id_purchase
				INNER JOIN product
				ON pp.id_product = product.id
				INNER JOIN paypal
				ON p.id = paypal.id_purchase
				WHERE p.id_user = %d
				AND p.id = %d', $user['id'], $id);

		$products = $this->executeQuery($sql);

		$sql = sprintf('SELECT estados.nombre AS estado, municipios.nombre AS municipio, pa.colonia, pa.codigo_postal, pa.calle, pa.no_exterior, pa.no_interior
				FROM purchase AS p
				INNER JOIN purchase_address AS pa
				ON p.id = pa.id_purchase
				INNER JOIN estados 
				ON pa.estado = estados.id
				INNER JOIN municipios
				ON pa.municipio = municipios.id
				WHERE p.id_user = %d
				AND p.id = %d', $user['id'], $id);

		$address = $this->executeQuery($sql);

		return array(
			'products' => $products,
			'address'  => $address[0]
		);
	}	

	/*** recover ***/

	/**
	 *
	 * @param String $email
	 */
	public function recover($email)
	{
		$this->setTable('user');
		$user = $this->getSingleResult(array('email' => $email));
	
		if(!empty($user))
			return $user;
		
		return false;
	}


	/**
	 *
	 * @return Array
	 */
	public function getEstados()
	{
		$this->setTable('estados');
		return $this->getAllResults();
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getMunicipiosByEstado($id = null)
	{
		$this->setTable('municipios');
		return $this->getAllResults(array('estado_id' => $id));	
	}

	/**
	 *
	 * @return Array
	 */
	public function getProducts()
	{
		$this->setTable('product');
		return $this->getAllResults(array('active' => 1));	
	}

}
