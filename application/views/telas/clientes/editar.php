<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('excluirok').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('clientes/editar/'.$cliente->codigo, $atriForm);
			$attr_label = array(
		    	'class' => 'col-lg-2 control-label',
			);
			echo "<fieldset><div class=\"form-group\">";
			echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>','</div>');
			if ($this->session->flashdata('cadastrook')) {
				echo '<p>'. $this->session->flashdata('cadastrook').'</p>';	
			}
			echo form_label('Codigo:',"codigo",$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'codigo', 'id'=>'codigo', 'class' => 'form-control','disabled'=>''),set_value('codigo',$cliente->codigo));
			echo "</div>";
			echo form_label('Nome:','nome',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'nome', 'id'=>'nome', 'class' => 'form-control',),set_value('nome',$cliente->nome));
			echo "</div>";
			echo form_label('R.G.:','rg',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'rg', 'id'=>'rg', 'class' => 'form-control',),set_value('rg',$cliente->rg));
			echo "</div>";
			echo form_label('Endereço:','endereco',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'endereco', 'id'=>'endereco', 'class' => 'form-control',),set_value('endereco',$cliente->endereco));
			echo "</div>";
			echo form_label('Telefones:','telefones',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'telefones', 'id'=>'telefones', 'class' => 'form-control',),set_value('telefones',$cliente->telefones));
			echo "</div>";
			echo form_label('Contato:','contato',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'contato', 'id'=>'contato', 'class' => 'form-control',),set_value('contato',$cliente->contato));
			echo "</div>";
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'Alterar','id' => 'Alterar', 'class' => 'btn btn-primary form-control'),'Alterar');
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('clientes/editar');
		 ?>
	</div>
</div>