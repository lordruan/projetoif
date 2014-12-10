<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$dados = array(
			'title' => 'Clientes',
			'tela' => '/clientes/clientes',
			'clientes' => $this->model_clientes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function addClientes()
	{
		$this->form_validation->set_rules('nome','Nome','trim|required|max_length[50]');
		$this->form_validation->set_rules('rg','RG','trim|required|max_length[10]|integer');
		$this->form_validation->set_rules('endereco','Endereco','trim|required|max_length[120]');
		$this->form_validation->set_rules('telefones','Telefones','trim|required|max_length[60]|ucwords');
		$this->form_validation->set_rules('contato','Contato','trim|required|max_length[80]|ucwords');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'nome',
						'rg',
						'endereco',
						'telefones',
						'contato'
					),$this->input->post());
			$this->model_clientes->inserirClientes($dados);
		}		
		$dados = array(
			'title' => 'Clientes',
			'tela' => '/clientes/clientes',
			'clientes' => $this->model_clientes->get_all()->result(),
		);
		$this->load->view('index',$dados);
	}
	public function deletar()
	{
		$codigo = $this->uri->segment(3);
		if($this->model_clientes->deletarClientes($codigo)) {
			$this->session->set_flashdata('aviso','Solicitação deletada com sucesso, os insumos que foram
			solicitados também foram deletados.');
			redirect('clientes','refresh');
		} else {
			$this->session->set_flashdata('aviso','Não foi possível deletar a solicitacao');
			redirect('clientes','refresh');
		}
	}
	public function editar()
	{
		$this->form_validation->set_rules('nome','Nome','trim|required|max_length[50]');
		$this->form_validation->set_rules('rg','RG','trim|required|max_length[10]|integer');
		$this->form_validation->set_rules('endereco','Endereco','trim|required|max_length[120]');
		$this->form_validation->set_rules('telefones','Telefones','trim|required|max_length[60]|ucwords');
		$this->form_validation->set_rules('contato','Contato','trim|required|max_length[80]|ucwords');
		if($this->form_validation->run()==TRUE){
			$dados = elements(
					array(
						'nome',
						'rg',
						'endereco',
						'telefones',
						'contato'
					),$this->input->post());
			if($this->uri->segment(3) != null)
			$this->model_clientes->updateClientes($dados,$this->uri->segment(3));	
		}

		$codigo = $this->uri->segment(3);
		if ($codigo == null) {
			redirect('clientes');
		}
		$cliente = $this->model_clientes->get_ById($codigo)->row();
		$dados = array(
			'title' => 'Clientes',
			'tela' => '/clientes/editar',
			'cliente' => $cliente,
		);
		$this->load->view('index',$dados);
		
	}
}