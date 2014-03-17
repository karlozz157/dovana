<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

	public function checkSession()
	{
		var_dump($this->session->userdata('admin_username'));
		var_dump($this->session->userdata('admin_password'));
	}

	/**
	 *
	 * @return Array
	 */
	public function getCategories()
	{
		$categories = $this->commerce->getCategories();
		echo json_encode(array('categories' => $categories));
	}

	/**
	 *
	 * @return Array
	 */
	public function getProductsByCategory($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
		{
			echo json_encode(array('errors' => 'The parameters of the API is not valid.'));
			exit;
		}

		$products = $this->commerce->getProductsByCategory($id);
		echo json_encode(array('products' => $products));
	}

	/**
	 *
	 * @return Array
	 */
	public function getEstados()
	{
		$estados = $this->commerce->getEstados();	
		echo json_encode(array('estados' => $estados));
	}

	/**
	 *
	 * @param int $id
	 * @return Array
	 */
	public function getMunicipios($id = null)
	{
		if(is_null($id) || !ctype_digit($id))
			show_404();

		$locations = $this->commerce->getMunicipiosByEstado($id);
		echo json_encode(array('locations' => $locations));
	}

	/**
	 *
	 * @return Array
	 */
	public function notifications()
	{
		$notifications = $this->backend->getNotifications();
		echo json_encode(array('notifications' => $notifications));
	}

	/**
	 *
	 * @return Array
	 */
	public function getEnvolturas()
	{
		$envolturas = $this->backend->getEnvolturas();
		echo json_encode(array('envolturas' => $envolturas));
	}

}