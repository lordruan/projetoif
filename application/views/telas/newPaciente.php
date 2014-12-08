<div class="col-lg-10 center">
	<div class="well bs-component">
<?php 
	$atriForm = array('class' => 'form-horizontal',);
	echo form_open('pacientes/newPaciente', $atriForm);
	$attr_label = array(
    'class' => 'col-lg-2 control-label',
	);
	echo "<fieldset>
	<div class=\"form-group\">";
	echo validation_errors('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>','</div>');
	if ($this->session->flashdata('cadastrook')) {
		echo '<p>'. $this->session->flashdata('cadastrook').'</p>';	
	}
	echo form_label('Nome de Usuario:','nome_paciente',$attr_label);
	echo "<div class=\"col-lg-10\">";
	echo form_input(array('name' => 'nome_paciente','id' => 'nome_paciente', 'class' => 'form-control', 'placeholder'=>"Nome do Paciente..."),set_value('nome_paciente'));
	echo "</div>";
	echo form_label('Data de Entrada:','campoData',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'dt_entrada', 'id'=> 'campoData', 'type' => 'text', 'class' => 'form-control'),set_value('dt_entrada'));
	echo "</div>";
	echo form_label('Data da Baixa:','campoData1',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'dt_baixa', 'id'=> 'campoData1', 'type' => 'text', 'class' => 'form-control'),set_value('dt_baixa'));
	echo "</div>";
	echo form_label('Data de Nascimento:','campoData2',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'dt_nascimento', 'id'=> 'campoData2', 'type' => 'text', 'class' => 'form-control'),set_value('dt_nascimento'));
	echo "</div>";
	echo form_label('Idade:','idade',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'idade','id' => 'idade', 'class' => 'form-control', 'placeholder'=>"Idade..."),set_value('idade'));
	echo "</div>";
	echo form_label('Peso:','peso',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'peso', 'id'=>'peso', 'class' => 'form-control', 'placeholder'=>"Peso..."),set_value('peso'));
	echo "</div>";
	echo form_label('Telefone:','campoTelefone',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'fone', 'id'=> 'campoTelefone', 'class' => 'form-control', 'placeholder'=>"______-______"),set_value('fone'));
	echo "</div>";
	echo form_label('Patologia:','patologia',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo form_input(array('name' => 'patologia','id' => 'patologia', 'class' => 'form-control', 'placeholder'=>"Patologia..."),set_value('patologia'));
	echo "</div>";	
	echo form_label('CIDs:','cids',$attr_label);
	echo "<div class=\"col-lg-4\">";
	echo '
			<select class="input-xxlarge form-control" name="cid" id="cids">
			'.$options_cids.'
			</select><br />
	';
	echo "</div>";
	echo form_label('Escolha a UBS:','ubs',$attr_label);
	echo "<div class=\"col-lg-10\">";
	echo '
	<select class="input-xlarge form-control" name="id_unidade" id="ubs" type="text" placeholder=".input-xxlarge">
		'.$options_ubs.'
	</select><br/>';
	echo "</div>";
	echo "<div class=\"col-lg-5\">";
	echo "</div>";
	echo "<div class=\"col-lg-2\">";
    echo form_submit(array('name' => 'cadastrar', 'class' => 'btn btn-primary aling-center form-control'),'Cadastrar');
	echo "</div>";
	echo "</fieldset></div>";
	form_close('pacientes/newPaciente');
?>
</div>
<br>
</div>
<script>
	jQuery(function($){
		$("#campoData").mask("99-99-9999");
		$("#campoData1").mask("99-99-9999");
		$("#campoData2").mask("99-99-9999");
		$("#campoTelefone").mask("99999-9999");
	});
</script>