<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Escalas extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$dados = array(
			'title' => 'Escalas',
			'tela' => '/escalas/escalas',
			'escalas' => $this->model_escalas->get_all()->result(),
			'voos' => $this->getOptVoos(),
		);
		$this->load->view('index',$dados);
	}
	public function getOptVoos($codigo_voo = '')
	{
		$voos = $this->model_voos->get_all();
		$option = "<option value=''></option>";
		if ($codigo_voo == '') {	
			foreach($voos -> result() as $linha) {
				$option .= "<option value='$linha->codigo'>$linha->codigo-$linha->destino</option>";
			}
			return $option;
		}else{
			foreach($voos -> result() as $linha) {
				if ($codigo_voo == $linha->codigo){
					$option .= "<option selected=\"selected\" value=$linha->codigo'>$linha->codigo-$linha->destino</option>";
				}else{
					$option .= "<option value='$linha->codigo'>$linha->codigo-$linha->destino</option>"; 
				}			
			}
			return $option;
		}
	}
	public function addEscalas()
	{
		$this->form_validation->set_rules('cidade','Cidade da Escala','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('chegada','Hora de Partida','trim|required');
		$this->form_validation->set_rules('codigo_voo','Avião','trim|required');
		if($this->form_validation->run()==TRUE){
			$tmp = str_replace('T', ' ', $_POST['chegada']);
			$_POST['chegada'] = $tmp;
			$dados = elements(
					array(
						'cidade',
						'chegada',
						'codigo_voo',
					),$this->input->post());
			$this->model_escalas->inserirEscalas($dados);
		}		
		$dados = array(
			'title' => 'Escalas',
			'tela' => '/escalas/escalas',
			'escalas' => $this->model_escalas->get_all()->result(),
			'voos' => $this->getOptVoos(),
		);
		$this->load->view('index',$dados);
	}
	public function deletar()
	{
		$codigo = $this->uri->segment(3);
		if($this->model_escalas->deletarEscalas($codigo)) {
			$this->session->set_flashdata('aviso','Avião deletado com sucesso.');
			redirect('escalas','refresh');
		} else {
			$this->session->set_flashdata('aviso','Não foi possível deletar a solicitacao');
			redirect('escalas','refresh');
		}
	}
	public function editar()
	{
		$this->form_validation->set_rules('cidade','Cidade da Escala','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('chegada','Hora de Partida','trim|required');
		$this->form_validation->set_rules('codigo_voo','Avião','trim|required');
		if($this->form_validation->run()==TRUE){
			$tmp = str_replace('T', ' ', $_POST['chegada']);
			$_POST['chegada'] = $tmp;
			$dados = elements(
					array(
						'cidade',
						'chegada',
						'codigo_voo',
					),$this->input->post());
			if($this->uri->segment(3) != '')
			$this->model_escalas->updateEscalas($dados,$this->uri->segment(3));	
		}

		$codigo = $this->uri->segment(3);
		if ($codigo == '') {
			redirect('escalas');
		}
		$escala = $this->model_escalas->get_ById($codigo)->row();
		$dados = array(
			'title' => 'Escalas',
			'tela' => '/escalas/editar',
			'escala' => $escala,
			'voos' => $this->getOptVoos($escala->codigo_voo),
		);
		$this->load->view('index',$dados);
		
	}
}