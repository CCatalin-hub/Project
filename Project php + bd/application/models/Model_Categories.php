<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Categories extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getCategories(){
		return $this
			->db
			->query("SELECT description FROM category")
			->result();
	}

}