<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tripulantes extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$dados = array(
			'title' => 'Tripulantes',
			'tela' => '/tripulantes/tripulantes',
			'tripulantes' => $this->model_tripulantes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function addTripulantes()
	{
		$this->form_validation->set_rules('nome','Nome','trim|required|max_length[80]|ucwords');
		$this->form_validation->set_rules('endereco','Endereco','trim|required|max_length[120]');
		$this->form_validation->set_rules('funcao','Função','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('nivel','Nivel','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('experiencia','Experiencia','trim|required|max_length[5]|integer');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'nome',
						'endereco',
						'funcao',
						'nivel',
						'experiencia'
					),$this->input->post());
			$this->model_tripulantes->inserirTripulantes($dados);
		}		
		$dados = array(
			'title' => 'Clientes',
			'tela' => '/clientes/clientes',
			'tripulantes' => $this->model_tripulantes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function deletar()
	{
		$codigo = $this->uri->segment(3);
		if($this->model_tripulantes->deletarTripulantes($codigo)) {
			$this->session->set_flashdata('aviso','Deletado com sucesso.');
			redirect('tripulantes','refresh');
		} else {
			$this->session->set_flashdata('aviso','Não Foi possivel deletar');
			redirect('tripulantes','refresh');
		}
	}
	public function editar()
	{
		$this->form_validation->set_rules('nome','Nome','trim|required|max_length[80]|ucwords');
		$this->form_validation->set_rules('endereco','Endereco','trim|required|max_length[120]');
		$this->form_validation->set_rules('funcao','Função','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('nivel','Nivel','trim|required|max_length[50]|ucwords');
		$this->form_validation->set_rules('experiencia','Experiencia','trim|required|max_length[5]|integer');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'nome',
						'endereco',
						'funcao',
						'nivel',
						'experiencia'
					),$this->input->post());
			if($this->uri->segment(3) != null)
			$this->model_tripulantes->updateTripulantes($dados,$this->uri->segment(3));	
		}

		$codigo = $this->uri->segment(3);
		if ($codigo == null) {
			redirect('tripulantes');
		}
		$tripulante = $this->model_tripulantes->get_ById($codigo)->row();
		$dados = array(
			'title' => 'Clientes',
			'tela' => '/tripulantes/editar',
			'tripulante' => $tripulante,
		);
		$this->load->view('index',$dados);
		
	}
}