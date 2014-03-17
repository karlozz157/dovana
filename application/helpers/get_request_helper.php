<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_request'))
{
	/**
	 *
	 * @param String $var
	 */
	function get_request($var)
	{
		return isset($_GET[$var]) ? strip_tags(trim($_GET[$var])) : null;
	}
}
