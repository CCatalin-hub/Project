<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Genre extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getGenres(){
		return $this
			->db
			->query("SELECT description FROM genre")
			->result();
	}
}