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
		if ($this->session->flashdata('aviso')) {
				echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('aviso').'</div>';	
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
			<table class="display table table-striped table-hover table-condensed" id="consultar_reservas">
				<thead> 
					<tr>
						<th class="span3">Vôo</th>
						<th class="span2">Cliente</th>
						<th class="span2">Assentos</th>
						<th class="span3" >Operacoes</th>
					</tr>
				</thead>
			<tbody>
		<?php
			$anchor_delete = array('class'=>"btn  btn-danger");
			$anchor_edit = array('class'=>"label label-warning");
			foreach ($reservas as $linha) {
				$voo = $linha->codigo_voo.'-'.$linha->destino;
				$cliente = $linha->nome;
				$assentos = $linha->assentos;
				$operacoes = anchor('reservas/editar/'.$linha->codigo_voo.'-'.$linha->codigo_cliente.'','Editar',$anchor_edit).'<i class="icon-italic"></i> <a href="#MeuModal'.$linha->codigo_voo.'-'.$linha->codigo_cliente.'" class="label  label-danger" data-toggle="modal">Deletar</a>';
				echo "<tr class='gradeA'>";
		        echo "<td><center>$voo</center></td>";
		        echo "<td><center>$cliente</center></td>";
		        echo "<td><center>$assentos</center></td>";
				echo "<td><center>$operacoes</center></td>";
				echo '<div id="MeuModal'.$linha->codigo_voo.'-'.$linha->codigo_cliente.'" class="modal fade" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h3 id="meuModelLabel">Realmente deseja Excluir esta reserva?</h3>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
								'.anchor('reservas/deletar/'.$linha->codigo_voo.'-'.$linha->codigo_cliente.'','Excluir',$anchor_delete).'
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
			$('#consultar_reservas').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"sDom": '<"H"Tlfr>t<"F"ip>',
				"oTableTools": {
					"sSwfPath": "/acamados/padrao/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
					"aButtons": [ 
						{ 
							"sExtends": "xls",
							"sButtonText": "Exportar para Excel",
							"sTitle": "Reservas",
							"mColumns": [0, 1, 2]
						},
						{
							"sExtends": "pdf",
							"sButtonText": "Exportar para PDF",
							"sTitle": "Reservas",
							"sPdfOrientation": "landscape",
							"mColumns": [0, 1, 2] 
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