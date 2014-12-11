<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Avioes extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$dados = array(
			'title' => 'Aviões',
			'tela' => '/avioes/avioes',
			'avioes' => $this->model_avioes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function addAvioes()
	{
		$this->form_validation->set_rules('sigla','Sigla','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('qtd_assentos','Quantidade de Assentos','trim|required|max_length[10]|integer');
		$this->form_validation->set_rules('carga_max','Carga Maxima','trim|required|max_length[120]|integer');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'sigla',
						'qtd_assentos',
						'carga_max',
					),$this->input->post());
			$this->model_avioes->inserirAvioes($dados);
		}		
		$dados = array(
			'title' => 'Avioes',
			'tela' => '/avioes/avioes',
			'avioes' => $this->model_avioes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function deletar()
	{
		$codigo = $this->uri->segment(3);
		if($this->model_avioes->deletarAvioes($codigo)) {
			$this->session->set_flashdata('aviso','Avião deletado com sucesso.');
			redirect('avioes','refresh');
		} else {
			$this->session->set_flashdata('aviso','Não foi possível deletar a solicitacao');
			redirect('avioes','refresh');
		}
	}
	public function editar()
	{
		$this->form_validation->set_rules('sigla','Sigla','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('qtd_assentos','Quantidade de Assentos','trim|required|max_length[10]|integer');
		$this->form_validation->set_rules('carga_max','Carga Maxima','trim|required|max_length[120]|integer');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'sigla',
						'qtd_assentos',
						'carga_max',
					),$this->input->post());
			if($this->uri->segment(3) != '')
			$this->model_avioes->updateAvioes($dados,$this->uri->segment(3));	
		}

		$codigo = $this->uri->segment(3);
		if ($codigo == '') {
			redirect('avioes');
		}
		$aviao = $this->model_avioes->get_ById($codigo)->row();
		$dados = array(
			'title' => 'Avioes',
			'tela' => '/avioes/editar',
			'aviao' => $aviao,
		);
		$this->load->view('index',$dados);
		
	}
}