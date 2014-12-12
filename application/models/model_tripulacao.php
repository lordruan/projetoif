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
			$this->db->insert('reservas',$dados);
			$this->session->set_flashdata('cadastrook','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button><p>Cadastro efetuado com sucesso</p></div>');
			redirect('reservas');
		}
	}
	public function deletarTripulacao($codigo_tripulantes = NULL, $codigo_voo = NULL) {
		$this->db->where('codigo_tripulantes',$codigo_tripulantes);
		$this->db->where('codigo_voo',$codigo_voo);
		return $this->db->delete('reservas');
	}
	public function updateTripulante($dados=NULL, $codigo_tripulantes = NULL, $codigo_voo = NULL){

		if($dados!=NULL && $codigo_tripulantes != NULL && $codigo_voo != NULL):
			$where = "codigo_tripulantes = ".$this->db->escape($codigo_tripulantes)." AND codigo_voo = ".$this->db->escape($codigo_voo).""; 
			$query= $this->db->update_string('reservas', $dados, $where);
			$this->db->query($query);
			$str = $this->db->last_query();
			$this->session->set_flashdata('aviso','Editado com sucesso');
			redirect("reservas");		
		endif;
	}
	public function get_ById($codigo_tripulantes = NULL, $codigo_voo = NULL)
	{		
		return $this->db->query("SELECT * FROM reservas WHERE codigo_tripulantes=".$this->db->escape($codigo_tripulantes)." and codigo_voo=".$this->db->escape($codigo_voo)." LIMIT 1");
	}
}