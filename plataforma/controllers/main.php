<?php

	class Main extends CI_Controller {
		function __construct()
		{
			
			parent::__construct();
			
    	}
		function index()
		{
			$this->load->view('cabecera');
			$this->load->view('footer');
		}

		







		
}
?>
