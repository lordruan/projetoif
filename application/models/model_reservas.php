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
	public function deletarReservas($codigo_cliente = NULL, $codigo_voo = NULL) {
		$this->db->where('codigo_cliente',$codigo_cliente);
		$this->db->where('codigo_voo',$codigo_voo);
		return $this->db->delete('reservas');
	}
	public function updateReservas($dados=NULL, $codigo_cliente = NULL, $codigo_voo = NULL){

		if($dados!=NULL && $condicao != null):
			$this->db->where('codigo_cliente',$codigo_cliente);
			$this->db->where('codigo_voo',$codigo_voo);
			$this->db->update('reservas',$dados);
			$this->session->set_flashdata('aviso','Edição efetuada com sucesso');
			redirect("reservas");
		
		endif;
	}
	public function get_ById($codigo_cliente = NULL, $codigo_voo = NULL)
	{		
		return $this->db->query("SELECT * FROM reservas WHERE codigo_cliente=".$this->db->escape($codigo_cliente)." and codigo_voo=".$this->db->escape($codigo_voo)." LIMIT 1");
	}
}