<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tripulacao extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('reservas_view');
	}
	public function inserirTripulacao($dados=null)
	{
		if($dados!=null){
			$this->db->insert('tripulacao',$dados);
			$this->session->set_flashdata('aviso','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
		}
	}
	public function deletarTripulacao($condicao = NULL) {
		$this->db->where('codigo_tripulacao',$condicao);
		return $this->db->delete('tripulacao');
	}
	public function get_ById($codigo_tripulantes = NULL, $codigo_voo = NULL)
	{		
		return $this->db->query("SELECT * FROM reservas WHERE codigo_tripulantes=".$this->db->escape($codigo_tripulantes)." and codigo_voo=".$this->db->escape($codigo_voo)." LIMIT 1");
	}
	public function get_AllByVoo($codigo_voo = NULL)
	{
		return $this->db->query("SELECT * FROM tripulacao_view WHERE codigo_voo=".$this->db->escape($codigo_voo));
	}
}