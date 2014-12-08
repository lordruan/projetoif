<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


class Model_relatorios extends CI_Model {

	public function trazerTodos() {

	return $this->db->query('SELECT U.nome_unidade, P.nome_paciente, SI.id_sol_insumos, SI.data_solicitacao, SI.data_liberacao, CI.nome_insumo, ISO.data_sol_ins 
	FROM unidade U inner join cad_pacientes P on U.id_unidade = P.id_unidade
	inner join solicitacao_insumos SI on SI.id_cad_pacientes_cad_pacientes = P.id_cad_pacientes
	inner join insumos_solicitados ISO on ISO.id_sol_insumos_solicitacao_insumos = SI.id_sol_insumos
	inner join cad_insumos CI on id_cad_insumos = ISO.id_cad_insumos_cad_insumos
	order by SI.id_sol_insumos;');

	}

	public function insumosPorUnidade() {

		return $this->db->query('SELECT U.nome_unidade, CI.nome_insumo, count(ISO.id_cad_insumos_cad_insumos)
		from solicitacao_insumos SI 
		inner join cad_pacientes CP on SI.id_cad_pacientes_cad_pacientes = CP.id_cad_pacientes
		inner join insumos_solicitados ISO on ISO.id_sol_insumos_solicitacao_insumos = SI.id_sol_insumos
		inner join cad_insumos CI on CI.id_cad_insumos = ISO.id_cad_insumos_cad_insumos
		inner join unidade U on U.id_unidade = CP.id_unidade
		group by CI.nome_insumo, U.nome_unidade;');

	}

	public function solicitacoesLiberadas() {
		return $this->db->query('SELECT U.nome_unidade, CP.nome_paciente, SI.id_sol_insumos, CI.nome_insumo, SI.status, SI.data_liberacao
		from unidade U inner join cad_pacientes CP on CP.id_unidade = U.id_unidade
		inner join solicitacao_insumos SI on SI.id_cad_pacientes_cad_pacientes = CP.id_cad_pacientes
		inner join insumos_solicitados ISO on ISO.id_sol_insumos_solicitacao_insumos = SI.id_sol_insumos
		inner join cad_insumos CI on CI.id_cad_insumos = ISO.id_cad_insumos_cad_insumos
		where status = \'Liberado\'
		order by U.nome_unidade;');
	}

}