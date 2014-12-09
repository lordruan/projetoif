<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_voos extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('voos');
	}
}