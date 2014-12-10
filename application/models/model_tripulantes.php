<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tripulantes extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('tripulantes');
	}
	public function inserirTripulantes($dados=null) {
		if($dados!=null){
			$this->db->insert('tripulantes',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('tripulantes/tripulantes');
		}
	}
	public function deletarTripulantes($codigo = NULL) {
		$this->db->where('codigo',$codigo);
		return $this->db->delete('tripulantes');
	}
	public function updateTripulantes($dados=NULL, $condicao=null){

		if($dados!=NULL && $condicao != null):

			$this->db->where('codigo',$condicao);
			$this->db->update('tripulantes',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("tripulantes");
		
		endif;
	}
	public function get_ById($id = NULL)
	{		
		return $this->db->query("SELECT * FROM tripulantes WHERE codigo=".$this->db->escape($id)." LIMIT 1");
	}
}