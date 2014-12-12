<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('voos/editar/'.$voo->codigo, $atriForm);
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
				echo form_input(array('name' => 'codigo', 'id'=>'codigo', 'class' => 'form-control','disabled'=>''),set_value('codigo',$voo->codigo));
			echo "</div>";
			echo form_label('Cidade de Origem:','origem',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'origem', 'id'=>'origem', 'class' => 'form-control',),set_value('origem',$voo->origem));
			echo "</div>";
			echo form_label('Cidade de Destino:','destino',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'destino', 'id'=>'destino', 'class' => 'form-control',),set_value('destino',$voo->destino));
			echo "</div>";
			echo form_label('Hora de Partida:','partida',$attr_label);
			echo "<div class=\"col-lg-4\">";
				$tmp = str_replace(' ', 'T', $voo->partida);
				echo form_input(array('name' => 'partida', 'id'=>'partida', 'class' => 'form-control', 'type' => 'datetime-local'),set_value('partida',$tmp));
			echo "</div>";
			echo form_label('Assentos Disponiveis:','assentos_disponiveis',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'assentos_disponiveis', 'id'=>'assentos_disponiveis', 'class' => 'form-control',),set_value('assentos_disponiveis',$voo->assentos_disponiveis));
			echo "</div>";
			echo form_label('Avião:','sigla_aviao',$attr_label);
			echo "<div class=\"col-lg-4\">";
			echo '
					<select class="input-large form-control" name="sigla_aviao" id="sigla_aviao">
					'.$avioes.'
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
	form_close('voos/editar'.$voo->codigo);
		 ?>
	</div>
</div>