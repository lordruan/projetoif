<div class="col-lg-10 center">
	<div class="well bs-component">
		<?php 
			if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
			}
			$atriForm = array('class' => 'form',);
			echo form_open('avioes/addAvioes', $atriForm);
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
			echo form_label('Sigla:','sigla',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'sigla', 'id'=>'sigla', 'class' => 'form-control'),set_value('sigla'));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-3\"><br />";
			echo "</div>";
			echo form_label('Quantidade de Assentos:','qtd_assentos',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'qtd_assentos', 'id'=>'qtd_assentos', 'class' => 'form-control',),set_value('qtd_assentos'));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-3\"><br />";
			echo "</div>";
			echo form_label('Carga Maxima:','carga_max',$attr_label);
			echo "<div class=\"col-lg-4\">";
				echo form_input(array('name' => 'carga_max', 'id'=>'carga_max', 'class' => 'form-control',),set_value('carga_max'));
			echo "</div>";
			echo "</div>";
			echo '<div class="row">';
			echo "<div class=\"col-lg-5\"><br />";
			echo "</div>";
			echo "<div class=\"col-lg-2\"><br />";
				echo form_submit(array('name' => 'cadastrar','id' => 'cadastrar', 'class' => 'btn btn-primary form-control'),'Cadastrar');
			echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "<fieldset>";
	form_close('avioes/addAvioes');
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
						<th class="span3">Sigla</th>
						<th class="span2">Assentos</th>
						<th class="span2">Carga Maxima</th>
						<th class="span3" >Operacoes</th>
					</tr>
				</thead>
			<tbody>
		<?php
			$anchor_delete = array('class'=>"btn  btn-danger");
			$anchor_edit = array('class'=>"label label-warning");
			foreach ($avioes as $linha) {
				$sigla = $linha->sigla;
				$qtd_assentos = $linha->qtd_assentos;
				$carga_max = $linha->carga_max;
				$operacoes = anchor("avioes/editar/$linha->sigla",'Editar',$anchor_edit).' <i class="icon-italic"></i> <a href="#MeuModal'.$linha->sigla.'" class="label  label-danger" data-toggle="modal">Deletar</a>';
				echo "<tr class='gradeA'>";
		        echo "<td><center>$sigla</center></td>";
		        echo "<td><center>$qtd_assentos</center></td>";
		        echo "<td><center>$carga_max</center></td>";
				echo "<td><center>$operacoes</center></td>";
				echo '<div id="MeuModal'.$linha->sigla.'" class="modal fade" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h3 id="meuModelLabel">Realmente deseja Excluir o cliente?</h3>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
								'.anchor("avioes/deletar/$linha->sigla",'Excluir',$anchor_delete).'
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