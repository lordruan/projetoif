<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('escalas/editar/'.$escala->codigo, $atriForm);
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
				echo form_input(array('name' => 'codigo', 'id'=>'codigo', 'class' => 'form-control','disabled'=>''),set_value('codigo',$escala->codigo));
			echo "</div>";
			echo form_label('Cidade da Escala:','cidade',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'cidade', 'id'=>'cidade', 'class' => 'form-control',),set_value('cidade',$escala->cidade));
			echo "</div>";
			echo form_label('Hora da Escala:','chegada',$attr_label);
			echo "<div class=\"col-lg-4\">";
				$tmp = str_replace(' ', 'T', $escala->chegada);
				echo form_input(array('name' => 'chegada', 'id'=>'chegada', 'class' => 'form-control', 'type' => 'datetime-local'),set_value('chegada',$tmp));
			echo "</div>";
			echo form_label('Vôo:','codigo_voo',$attr_label);
			echo "<div class=\"col-lg-4\">";
			echo '
					<select class="input-large form-control" name="codigo_voo" id="codigo_voo">
					'.$voos.'
					</select>
			';
			echo "</div>";
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'cadastrar','id' => 'cadastrar', 'class' => 'btn btn-primary form-control'),'Alterar');
			echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('escalas/editar'.$escala->codigo);
		 ?>
	</div>
</div>