<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Reservas extends MY_Controller {
	
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
	public function getOptClientes($codigo_clientes = 0)
	{
		$clientes = $this->model_clientes->get_all();
		$option = "<option value=''></option>";
		if ($codigo_clientes == 0) {	
			foreach($clientes -> result() as $linha) {
				$option .= "<option value='$linha->codigo'>$linha->nome</option>";
			}
			return $option;
		}else{
			foreach($codigo_clientes -> result() as $linha) {
				if ($clientes == $linha->codigo){
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
			'title' => 'Reservas',
			'tela' => '/reservas/reservas',
			'voos' => $this->getOptVoos(),
			'clientes' => $this->getOptClientes(),
			'reservas' => $this->model_reservas->get_all()->result(),
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
			$this->model_reservas->inserirReservas($dados);
		}
		$dados = array(
			'title' => 'Reservas',
			'tela' => '/reservas/reservas',
			'voos' => $this->getOptVoos(),
			'clientes' => $this->getOptClientes(),
			'reservas' => $this->model_reservas->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
}
