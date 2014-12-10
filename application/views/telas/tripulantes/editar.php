<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('tripulantes/editar/'.$tripulante->codigo, $atriForm);
			$attr_label = array(
		    	'class' => 'col-lg-2 control-label',
			);
			echo "<fieldset><div class=\"form-group\">";
			echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>','</div>');
			if ($this->session->flashdata('cadastrook')) {
				echo '<p>'. $this->session->flashdata('cadastrook').'</p>';	
			}
			echo form_label('Codigo:','codigo',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'codigo', 'id'=>'codigo', 'class' => 'form-control','disabled'=>''),set_value('codigo', $tripulante->codigo));
			echo "</div>";
			echo form_label('Nome:','nome',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'nome', 'id'=>'nome', 'class' => 'form-control',),set_value('nome', $tripulante->nome));
			echo "</div>";
			echo form_label('Endere�o:','endereco',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'endereco', 'id'=>'endereco', 'class' => 'form-control',),set_value('endereco', $tripulante->endereco));
			echo "</div>";
			echo form_label('Fun��o:','funcao',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'funcao', 'id'=>'funcao', 'class' => 'form-control',),set_value('funcao', $tripulante->funcao));
			echo "</div>";
			echo form_label('Nivel:','nivel',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'nivel', 'id'=>'nivel', 'class' => 'form-control',),set_value('nivel', $tripulante->nivel));
			echo "</div>";
			echo form_label('Experiencia:','experiencia',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'experiencia', 'id'=>'experiencia', 'class' => 'form-control',),set_value('experiencia', $tripulante->experiencia));
			echo "</div>";
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'cadastrar','id' => 'cadastrar', 'class' => 'btn btn-primary form-control'),'Alterar');
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('tripulantes/editar');
		 ?>
	</div>
</div>