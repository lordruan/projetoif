<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_voos extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('voos');
	}
	public function inserirVoos($dados=null) {
		if($dados!=null){
			$this->db->insert('voos',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('voos/voos');
		}
	}
	public function deletarVoos($codigo = NULL) {
		$this->db->where('codigo',$codigo);
		return $this->db->delete('voos');
	}
	public function updateVoos($dados=NULL, $condicao=null){

		if($dados!=NULL && $condicao != null):

			$this->db->where('codigo',$condicao);
			$this->db->update('voos',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("voos");
		
		endif;
	}
	public function get_ById($id = NULL)
	{		
		return $this->db->query("SELECT * FROM voos WHERE codigo=".$this->db->escape($id)." LIMIT 1");
	}
}