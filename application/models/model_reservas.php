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
	public function deletarReservas($codigo_voo = NULL, $codigo_cliente = NULL) {
		return $this->db->query("DELETE FROM reservas WHERE codigo_cliente=".$this->db->escape($codigo_cliente)." and codigo_voo=".$this->db->escape($codigo_voo));
	}
	public function updateReserva($dados=NULL, $codigo_cliente = NULL, $codigo_voo = NULL){

		if($dados!=NULL && $codigo_cliente != NULL && $codigo_voo != NULL):
			$where = "codigo_cliente = ".$this->db->escape($codigo_cliente)." AND codigo_voo = ".$this->db->escape($codigo_voo).""; 
			$query= $this->db->update_string('reservas', $dados, $where);
			$this->db->query($query);
			$this->session->set_flashdata('aviso','Editado com sucesso');
			redirect("reservas");		
		endif;
	}
	public function get_ById($codigo_cliente = NULL, $codigo_voo = NULL)
	{		
		return $this->db->query("SELECT * FROM reservas WHERE codigo_cliente=".$this->db->escape($codigo_cliente)." and codigo_voo=".$this->db->escape($codigo_voo)." LIMIT 1");
	}
}