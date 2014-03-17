<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('cleanData'))
{
	/**
	 *
	 * @param String $var
	 */
	function cleanData($var)
	{
		return strip_tags(trim($_POST[$var]));
	}
}
