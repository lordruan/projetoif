<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_escalas extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('escalas');
	}
	public function inserirEscalas($dados=null) {
		if($dados!=null){
			$this->db->insert('escalas',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('escalas/escalas');
		}
	}
	public function deletarEscalas($codigo = NULL) {
		$this->db->where('codigo',$codigo);
		return $this->db->delete('escalas');
	}
	public function updateEscalas($dados=NULL, $condicao=null){

		if($dados!=NULL && $condicao != null):

			$this->db->where('codigo',$condicao);
			$this->db->update('escalas',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("escalas");
		
		endif;
	}
	public function get_ById($id = NULL)
	{		
		return $this->db->query("SELECT * FROM escalas WHERE codigo=".$this->db->escape($id)." LIMIT 1");
	}
}