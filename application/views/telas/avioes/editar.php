<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('excluirok').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('avioes/editar/'.$aviao->sigla, $atriForm);
			$attr_label = array(
		    	'class' => 'col-lg-2 control-label',
			);
			echo "<fieldset><div class=\"form-group\">";
			echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>','</div>');
			if ($this->session->flashdata('cadastrook')) {
				echo '<p>'. $this->session->flashdata('cadastrook').'</p>';	
			}	
			echo '<div class="row">';
			echo "<div class=\"col-lg-3\"><br />";
			echo "</div>";
			echo form_label('Sigla:',"sigla",$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'sigla', 'id'=>'sigla', 'class' => 'form-control'),set_value('sigla',$aviao->sigla));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-3\"><br />";
			echo "</div>";
			echo form_label('Quatidade de Assentos:','qtd_assentos',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'qtd_assentos', 'id'=>'qtd_assentos', 'class' => 'form-control',),set_value('qtd_assentos',$aviao->qtd_assentos));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-3\"><br />";
			echo "</div>";
			echo form_label('Cacarga_maxa Maxima:','carga_max',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'carga_max', 'id'=>'carga_max', 'class' => 'form-control',),set_value('carga_max',$aviao->carga_max));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'Alterar','id' => 'Alterar', 'class' => 'btn btn-primary form-control'),'Alterar');
			echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('avioes/editar');
		 ?>
	</div>
</div>