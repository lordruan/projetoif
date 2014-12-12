<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Voos extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$dados = array(
			'title' => 'Vôos',
			'tela' => '/voos/voos',
			'voos' => $this->model_voos->get_all()->result(),
			'avioes' => $this->getOptAvioes(),
		);
		$this->load->view('index',$dados);
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
			foreach($tripulantes -> result() as $linha) {
				if ($codigo_tripulantes == $linha->codigo){
					$option .= "<option selected=\"selected\" value=$linha->codigo>$linha->nome</option>";
				}else{
					$option .= "<option value='$linha->codigo'>$linha->nome</option>"; 
				}			
			}
			return $option;
		}
	}
	public function getOptAvioes($sigla_aviao = '')
	{
		$Avioes = $this->model_avioes->get_all();
		$option = "<option value=''></option>";
		if ($sigla_aviao == '') {	
			foreach($Avioes -> result() as $linha) {
				$option .= "<option value='$linha->sigla'>$linha->sigla</option>";
			}
			return $option;
		}else{
			foreach($Avioes -> result() as $linha) {
				if ($sigla_aviao == $linha->sigla){
					$option .= "<option selected=\"selected\" value=$linha->sigla>$linha->sigla</option>";
				}else{
					$option .= "<option value='$linha->sigla'>$linha->sigla</option>"; 
				}			
			}
			return $option;
		}
	}
	public function addVoos()
	{
		$this->form_validation->set_rules('origem','Cidade de Origem','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('destino','Cidade de Destino','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('partida','Hora de Partida','trim|required');
		$this->form_validation->set_rules('assentos_disponiveis','Hora de Partida','trim|required|max_length[5]|integer');
		$this->form_validation->set_rules('sigla_aviao','Avião','trim|required');
		if($this->form_validation->run()==TRUE){
			$tmp = str_replace('T', ' ', $_POST['partida']);
			$_POST['partida'] = $tmp;
			$dados = elements(
					array(
						'origem',
						'destino',
						'partida',
						'assentos_disponiveis',
						'sigla_aviao',
					),$this->input->post());
			$this->model_voos->inserirVoos($dados);
		}		
		$dados = array(
			'title' => 'Voos',
			'tela' => '/voos/voos',
			'voos' => $this->model_voos->get_all()->result(),
			'avioes' => $this->getOptAvioes(),
		);
		$this->load->view('index',$dados);
	}
	public function deletar()
	{
		$codigo = $this->uri->segment(3);
		if($this->model_voos->deletarVoos($codigo)) {
			$this->session->set_flashdata('aviso','Avião deletado com sucesso.');
			redirect('voos','refresh');
		} else {
			$this->session->set_flashdata('aviso','Não foi possível deletar a solicitacao');
			redirect('voos','refresh');
		}
	}
	public function editar()
	{
		$this->form_validation->set_rules('origem','Cidade de Origem','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('destino','Cidade de Destino','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('partida','Hora de Partida','trim|required');
		$this->form_validation->set_rules('assentos_disponiveis','Assentos Disponiveis','trim|required|max_length[5]|integer');
		$this->form_validation->set_rules('sigla_aviao','Avião','trim|required');
		if($this->form_validation->run()==TRUE){
			$tmp = str_replace('T', ' ', $_POST['partida']);
			$_POST['partida'] = $tmp;
			$dados = elements(
					array(
						'origem',
						'destino',
						'partida',
						'assentos_disponiveis',
						'sigla_aviao',
					),$this->input->post());
			if($this->uri->segment(3) != '')
			$this->model_voos->updateVoos($dados,$this->uri->segment(3));	
		}

		$codigo = $this->uri->segment(3);
		if ($codigo == '') {
			redirect('voos');
		}
		$voo = $this->model_voos->get_ById($codigo)->row();
		$tripulante = $this->model_tripulacao->get_AllByVoo($voo->codigo);
		$dados = array(
			'title' => 'Voos',
			'tela' => '/voos/editar',
			'voo' => $voo,
			'avioes' => $this->getOptAvioes($voo->sigla_aviao),
			'tripulantes' => $this->getOptTripulantes(),
			'tripulantesVoo' => $tripulante->result(),
		);
		$this->load->view('index',$dados);
		
	}
	public function addTripulante()
	{
		$codigo_voo =$_POST['codigo_voo'];
		$codigo_tripulantes =$_POST['codigo_tripulantes'];
		if(!empty($_POST['codigo_tripulantes'])){
			if(!empty($_POST['codigo_voo'])){
				$dados = array(
							'codigo_voo' => $_POST['codigo_voo'],
							'codigo_tripulantes' => $_POST['codigo_tripulantes'],
						);
				$this->model_tripulacao->inserirTripulacao($dados);
			}
		}
		$voo = $this->model_voos->get_ById($codigo_voo)->row();
		$tripulante = $this->model_tripulacao->get_AllByVoo($codigo_voo);
		$dados = array(
			'title' => 'Voos',
			'tela' => '/voos/editar',
			'voo' => $voo,
			'avioes' => $this->getOptAvioes($voo->sigla_aviao),
			'tripulantes' => $this->getOptTripulantes(),
			'tripulantesVoo' => $tripulante->result(),
		);
		$this->load->view('index',$dados);
	}
	public function deletarTripulante()
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