<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Model_ubs extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	public function retorna_ubs(){
		$consulta = $this->db->get("unidade");
		return $consulta;	
	}
}