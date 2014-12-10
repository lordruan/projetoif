<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('tripulantes/addTripulantes', $atriForm);
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
				echo form_input(array('name' => 'codigo', 'id'=>'codigo', 'class' => 'form-control','disabled'=>''),set_value('codigo'));
			echo "</div>";
			echo form_label('Nome:','nome',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'nome', 'id'=>'nome', 'class' => 'form-control',),set_value('nome'));
			echo "</div>";
			echo form_label('Endereço:','endereco',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'endereco', 'id'=>'endereco', 'class' => 'form-control',),set_value('endereco'));
			echo "</div>";
			echo form_label('Função:','funcao',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'funcao', 'id'=>'funcao', 'class' => 'form-control',),set_value('funcao'));
			echo "</div>";
			echo form_label('Nivel:','nivel',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'nivel', 'id'=>'nivel', 'class' => 'form-control',),set_value('nivel'));
			echo "</div>";
			echo form_label('Experiencia:','experiencia',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'experiencia', 'id'=>'experiencia', 'class' => 'form-control',),set_value('experiencia'));
			echo "</div>";
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'cadastrar','id' => 'cadastrar', 'class' => 'btn btn-primary form-control'),'Cadastrar');
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('tripulantes/addTripulantes');
		 ?>
	</div>
</div>
</div>
<div class="row">
<div class="col-lg-1">
</div>
<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('excluirok')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('excluirok').'</div>';	
			}
		?>
		<div id="tabs-1">
			<table class="display table table-striped table-hover table-condensed" id="consultar_usuarios">
				<thead> 
					<tr>
						<th class="span3">Codigo</th>
						<th class="span2">Nome</th>
						<th class="span2">Endereco</th>
						<th class="span3" >Função</th>
						<th class="span3" >Nivel</th>
						<th class="span3" >Experiencia</th>
						<th class="span3" >Operacoes</th>
					</tr>
				</thead>
			<tbody>
		<?php
			$anchor_delete = array('class'=>"btn  btn-danger");
			$anchor_edit = array('class'=>"label label-warning");
			foreach ($tripulantes as $linha) {
				$codigo = $linha->codigo;
				$nome = $linha->nome;
				$endereco = $linha->endereco;
				$funcao = $linha->funcao;
				$nivel = $linha->nivel;
				$experiencia = $linha->experiencia;
				$operacoes = anchor("tripulantes/editar/$linha->codigo",'Editar',$anchor_edit).' <i class="icon-italic"></i> <a href="#MeuModal'.$linha->codigo.'" class="label  label-danger" data-toggle="modal">Deletar</a>';
				
				echo "<tr class='gradeA'>";
		        echo "<td><center>$codigo</center></td>";
		        echo "<td><center>$nome</center></td>";
		        echo "<td><center>$endereco</center></td>";
				echo "<td><center>$funcao</center></td>";
				echo "<td><center>$nivel</center></td>";
				echo "<td><center>$experiencia</center></td>";
				echo "<td><center>$operacoes</center></td>";
				echo '<div id="MeuModal'.$linha->codigo.'" class="modal fade" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h3 id="meuModelLabel">Realmente deseja Excluir o cliente?</h3>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
								'.anchor("tripulantes/deletar/$linha->codigo",'Excluir',$anchor_delete).'
								</div>					
						</div>
					</div>
				</section>
				</div>';
			}
		?>
		</tbody>
		</table>
		</div>
		</div>
		<script>
		//Todos scripts dentro de Document.Ready são Jquery 
		$(document).ready(function() { 
			$('#consultar_usuarios').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"sDom": '<"H"Tlfr>t<"F"ip>',
				"oTableTools": {
					"sSwfPath": "/acamados/padrao/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
					"aButtons": [ 
						{ 
							"sExtends": "xls",
							"sButtonText": "Exportar para Excel",
							"sTitle": "Usuarios",
							"mColumns": [0, 1, 2, 3, 4,5]
						},
						{
							"sExtends": "pdf",
							"sButtonText": "Exportar para PDF",
							"sTitle": "Usuarios",
							"sPdfOrientation": "landscape",
							"mColumns": [0, 1, 2, 3, 4,5] 
						} 
					] 
				},
				"oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ registros por página",
					"sZeroRecords": "Nenhum registro encontrado",
					"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
					"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
					"sInfoFiltered": "(filtrado de _MAX_ registros)",
					"sSearch": "Pesquisar: ",
					"oPaginate": {
						"sFirst": "Início ",
						"sPrevious": " Anterior ",
						"sNext": " Próximo ",
						"sLast": " Último "
					}
				},
				"aaSorting": [[0, 'desc']],
				"aoColumnDefs": [
					{"sType": "num-html", "aTargets": [0]}
				]
			});
		});//fim jquery
		</script>
	</div>
</div>