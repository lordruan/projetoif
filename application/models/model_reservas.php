<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_reservas extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('reservas_view');
	}
	public function inserirReservas($dados=null)
	{
		if($dados!=null){
			$this->db->insert('reservas',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('reservas');
		}
	}
}