<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('voos/addVoos', $atriForm);
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
			echo form_label('Cidade de Origem:','origem',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'origem', 'id'=>'origem', 'class' => 'form-control',),set_value('origem'));
			echo "</div>";
			echo form_label('Cidade de Destino:','destino',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'destino', 'id'=>'destino', 'class' => 'form-control',),set_value('destino'));
			echo "</div>";
			echo form_label('Hora de Partida:','partida',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'partida', 'id'=>'partida', 'class' => 'form-control', 'type' => 'datetime-local'),set_value('partida'));
			echo "</div>";
			echo form_label('Assentos Disponiveis:','assentos_disponiveis',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'assentos_disponiveis', 'id'=>'assentos_disponiveis', 'class' => 'form-control',),set_value('assentos_disponiveis'));
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
				echo form_submit(array('name' => 'cadastrar','id' => 'cadastrar', 'class' => 'btn btn-primary form-control'),'Cadastrar');
			echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('voos/addVoos');
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
						<th class="span3">Cidade de Origem</th>
						<th class="span3">Cidade de Destino</th>
						<th class="span3">Hora de Partida</th>
						<th class="span3">Assentos Disponiveis</th>
						<th class="span3">Avião</th>
						<th class="span3" >Operacoes</th>
					</tr>
				</thead>
			<tbody>
		<?php
			$anchor_delete = array('class'=>"btn  btn-danger");
			$anchor_edit = array('class'=>"label label-warning");
			foreach ($voos as $linha) {
				$codigo = $linha->codigo;
				$origem = $linha->origem;
				$destino = $linha->destino;
				$partida = $linha->partida;
				$assentos_disponiveis = $linha->assentos_disponiveis;
				$sigla_aviao = $linha->sigla_aviao;
				$operacoes = anchor("voos/editar/$linha->codigo",'Editar',$anchor_edit).' <i class="icon-italic"></i> <a href="#MeuModal'.$linha->codigo.'" class="label  label-danger" data-toggle="modal">Deletar</a>';
				echo "<tr class='gradeA'>";
		        echo "<td><center>$codigo</center></td>";
				echo "<td><center>$origem</center></td>";
				echo "<td><center>$destino</center></td>";
				echo "<td><center>$partida</center></td>";
				echo "<td><center>$assentos_disponiveis</center></td>";
				echo "<td><center>$sigla_aviao</center></td>";
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
								'.anchor("voos/deletar/$linha->codigo",'Excluir',$anchor_delete).'
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