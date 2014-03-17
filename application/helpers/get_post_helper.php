<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_post'))
{
	/**
	 *
	 * @param String $var
	 */
	function get_post($var)
	{
		return isset($_POST[$var]) ? strip_tags(trim($_POST[$var])) : null;
	}
}
