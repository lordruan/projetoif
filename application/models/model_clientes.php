<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Model_clientes extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	public function get_all(){
		return $this->db->get('clientes');
	}
	public function inserirClientes($dados=null) {
		if($dados!=null){
			$this->db->insert('clientes',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('clientes/clientes');
		}
	}
	public function deletarClientes($codigo = NULL) {
		$this->db->where('codigo',$codigo);
		return $this->db->delete('clientes');
	}
	public function updateClientes($dados=NULL, $condicao=null){

		if($dados!=NULL && $condicao != null):

			$this->db->where('codigo',$condicao);
			$this->db->update('clientes',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("clientes");
		
		endif;
	}
	public function get_ById($id = NULL)
	{		
		return $this->db->query("SELECT * FROM clientes WHERE codigo=".$this->db->escape($id)." LIMIT 1");
	}
}