<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_session'))
{
	/**
	 *
	 * @param String $var
	 */
	function get_session($var)
	{
		$this->session->userdata($var);
	}
}
