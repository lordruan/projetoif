<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Tripulacao extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	public function getOptVoos($codigo_voo = 0)
	{
		$voos = $this->model_voos->get_all();
		$option = "<option value=''></option>";
		if ($codigo_voo == 0) {	
			foreach($voos -> result() as $linha) {
				$option .= "<option value='$linha->codigo'>$linha->codigo-$linha->destino</option>";
			}
			return $option;
		}else{
			foreach($voos -> result() as $linha) {
				if ($codigo_voo == $linha->codigo){
					$option .= "<option selected=\"selected\" value=$linha->codigo>$linha->codigo-$linha->destino</option>";
				}else{
					$option .= "<option value='$linha->codigo'>$linha->codigo-$linha->destino</option>"; 
				}			
			}
			return $option;
		}
	}
	public function getOptTripulantes($codigo_tripulantes = 0)
	{
		$tripulantes = $this->model_tripulantes->get_all();
		$option = "<option value=''></option>";
		if ($codigo_tripulantes == 0) {	
			foreach($tripulantes -> result() as $linha) {
				$option .= "<option value='$linha->codigo'>$linha->nome</option>";
			}
			return $option;
		}else{
			foreach($codigo_tripulantes -> result() as $linha) {
				if ($tripulantes == $linha->codigo){
					$option .= "<option selected=\"selected\" value=$linha->codigo>$linha->nome</option>";
				}else{
					$option .= "<option value='$linha->codigo'>$linha->nome</option>"; 
				}			
			}
			return $option;
		}
	}
	public function index()
	{
		$dados = array(
			'title' => 'Tripulacao',
			'tela' => '/tripulacao/tripulacao',
			'voos' => $this->getOptVoos(),
			'tripulantes' => $this->getOptClientes(),
			'tripulacao' => $this->model_tripulacao->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function addReserva()
	{
		$this->form_validation->set_rules('codigo_voo','Vôo','trim|required|max_length[5]|integer');
		$this->form_validation->set_rules('codigo_cliente','Cliente','trim|required|max_length[5]|integer');
		$this->form_validation->set_rules('assentos','Numero de lugares','trim|required|max_length[5]|integer');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'codigo_voo',
						'codigo_cliente',
						'assentos',
					),$this->input->post());
			$this->model_tripulacao->inserirTripulacao($dados);
		}
		$dados = array(
			'title' => 'Tripulação',
			'tela' => '/tripulacao/tripulacao',
			'voos' => $this->getOptVoos(),
			'tripulantes' => $this->getOptClientes(),
			'tripulacao' => $this->model_tripulacao->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function editar()
	{
		$ids = explode('-', $this->uri->segment(3));
		if (!empty($ids[1])) {
		//$linha->codigo_voo.'-'.$linha->codigo_cliente
			$codigo_voo = $ids[0];
			$codigo_cliente = $ids[1];
			$assentos = $this->input->post('assentos');
			$reserva = $this->model_tripulacao->getReservaByID($codigo_voo,$codigo_cliente)->row();

			if(!empty($assentos)) {

				if(!$this->model_tripulacao->updateReserva($codigo_voo,$codigo_cliente,$assentos)){
					$this->session->set_flashdata('error','Erro ao atualizar!');
					redirect('tripulacao/editar/'.$codigo_voo.'-'.$codigo_cliente,'refresh');
				} else {
					$this->session->set_flashdata('success','Atualizado com sucesso!');
					redirect('solicitacoes/editarInsumo/'.$codigo_voo.'-'.$codigo_cliente,'refresh');
				}

			}
			if (!empty($reserva)) {
				$dados = array(
						'titulo' => 'Tripulação',
						'tela' => '/tripulacao/editar',
						'voos' => $this->getOptVoos($codigo_voo),
						'tripulantes' => $this->getOptClientes($codigo_cliente),
						'id_ref' =>$this->uri->segment(3),
						'reserva' => $reserva );
				$this->load->view('index',$dados);
			}
		}else{
			$this->session->set_flashdata('error','Explode error');
			$dados = array(
						'titulo' => 'Sistema de Acamados',
						'tela' => 'sol/editItemInsumo');
			$this->load->view('index',$dados);			
		}
	}
}
