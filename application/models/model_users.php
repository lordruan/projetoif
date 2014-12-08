<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Users extends CI_Model {
	public function get_usuario($nome,$senha) {
		$this->db->get('usuarios');
		$this->db->where('codigo',$nome);
		$this->db->where('senha',$senha);
		$querylogin = $this->db->get('usuarios');
		return $querylogin->row(0);
	}

	public function login($options = array()) {
		$codigo = $this->get_usuario($options['codigo'],$options['senha']);
		if(!$nome) return false;
		return true;
	}

		public function alterarSenha($senha = null) /*Pensado para somente um usuário*/
	{
			$this->db->update('usuarios',$senha);
			return true;

	}
}
