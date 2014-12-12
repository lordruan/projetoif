<div class="col-lg-10 center">
	<div class="well bs-component">
<?php 
$atriForm = array('class' => 'form',);
echo form_open('reservas/addReserva', $atriForm);
$attr_label = array(
   	'class' => 'col-lg-2 control-label',
);
	echo "<fieldset>
	<div class=\"form-group\">";
		echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>','</div>');
		if ($this->session->flashdata('cadastrook')) {
			echo '<p>'. $this->session->flashdata('cadastrook').'</p>';	
		}
		echo "<div class=\"row\">";	
		echo "<div class=\"col-lg-3\">";
		echo "</div>";
		echo form_label('Vôo:','codigo_voo',$attr_label);
		echo "<div class=\"col-lg-4\">";
			echo '
					<select class="input-large form-control" name="codigo_voo" id="codigo_voo">
					'.$voos.'
					</select>
			';
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";	
		echo "<div class=\"col-lg-3\">";
		echo "</div>";
		echo form_label('Cliente:','codigo_cliente',$attr_label);
		echo "<div class=\"col-lg-4\">";
			echo '
					<select class="input-large form-control" name="codigo_cliente" id="codigo_cliente">
					'.$clientes.'
					</select>
			';
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";	
		echo "<div class=\"col-lg-3\">";
		echo "</div>";
		echo form_label('Numero de lugares:','assentos',$attr_label);
		echo "<div class=\"col-lg-4\">";
			echo form_input(array('name' => 'assentos', 'id' => 'assentos','class' => 'form-control'),set_value('assentos'));
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";		
		echo "<div class=\"col-lg-5\">";
		echo "</div>";
		echo "<div class=\"col-lg-2\"><br />";
			echo form_submit(array('name' => 'registrar','id' => 'registrar', 'class' => 'btn btn-primary form-control'),'Registrar');
		echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "<fieldset>";
form_close('reservas/addReserva');
?>
	</div>
</div>