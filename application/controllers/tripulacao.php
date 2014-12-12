<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Tripulacao extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	public function addTripulante()
	{
		$codigo_voo =$_POST['codigo_voo'];
		redirect("voos/editar/$codigo_voo");
		if(!empty($_POST['codigo_tripulantes'])){
			if(!empty($_POST['codigo_voo'])){
				$dados = array(
							'codigo_voo' => $_POST['codigo_voo'],
							'codigo_tripulantes' => $_POST['codigo_tripulantes'],
						);
				$this->model_tripulacao->inserirTripulacao($dados);
			}
		}
	}
	public function deletar()
	{
		$ids = explode('-', $this->uri->segment(3));
		if (!empty($ids[1])) {
		//$linha->codigo_voo.'-'.$linha->codigo_cliente
			$codigo = $ids[0];
			$ref = $ids[1];
			if($this->model_tripulacao->deletarTripulacao($codigo)) {
				$this->session->set_flashdata('aviso','Tripulante deletado com sucesso.');
				redirect("/voos/editar/".$ref,'refresh');
			} else {
				$this->session->set_flashdata('aviso','Não foi possível deletar');
				redirect('voos','refresh');
			}
		}
	}
	
}
