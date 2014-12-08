<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio extends MY_Controller {

	public function geral() {

		$geral = $this->model_relatorios->trazerTodos()->result();

		$dados = array(
					'titulo' => 'Sistema de Acamados',
					'tela' => 'relatorios/todos',
					'query' => $geral
				);		

				$this->load->view('index',$dados);

		}

	public function insporuni(){ /*traz a quantidade de insumos solicitado por unidade*/

			$insporuni = $this->model_relatorios->insumosPorUnidade()->result();

				$dados = array(
					'titulo' => 'Sistema de Acamados',
					'tela' => 'relatorios/insumoporunidade',
					'query' => $insporuni
				);		

				$this->load->view('index',$dados);

	}

	public function soliberada(){ /*traz a quantidade de insumos solicitado por unidade*/

			$solicitacoesLiberadas = $this->model_relatorios->solicitacoesLiberadas()->result();

				$dados = array(
					'titulo' => 'Sistema de Acamados',
					'tela' => 'relatorios/insumosliberados',
					'query' => $solicitacoesLiberadas
				);		

				$this->load->view('index',$dados);

	}

	}

?>