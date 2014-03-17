<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('bugEmail'))
{
	/**
	 *
	 * @param String $message
	 */
	function bugEmail($message)
	{
		$this->email->from('debug@softwarepq2.com');
		$this->email->to('jocapequ@gmail.com'); 
		$this->email->bcc('karlozz157@gmail.com'); 

		$this->email->subject('Hacking Attempt');
		$this->email->message($message);	

		$this->email->send();

		echo $this->email->print_debugger();		
	}
}