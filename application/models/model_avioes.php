<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_avioes extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('avioes');
	}
	public function inserirAvioes($dados=null) {
		if($dados!=null){
			$this->db->insert('avioes',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('avioes/avioes');
		}
	}
	public function deletarAvioes($codigo = NULL) {
		$this->db->where('sigla',$codigo);
		return $this->db->delete('avioes');
	}
	public function updateAvioes($dados=NULL, $condicao=null){

		if($dados!=NULL && $condicao != null):

			$this->db->where('sigla',$condicao);
			$this->db->update('avioes',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("avioes");
		
		endif;
	}
	public function get_ById($id = NULL)
	{		
		return $this->db->query("SELECT * FROM avioes WHERE sigla=".$this->db->escape($id)." LIMIT 1");
	}
}