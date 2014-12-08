<div class="col-lg-10 center">
	<div class="well bs-docs-example">
<?php 
	if ($this->session->flashdata('excluirok')) {
		echo '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">x</button>'. $this->session->flashdata('excluirok').'</div>';	
	}
	$anchor_delete = array('class'=>"btn  btn-danger");
	$anchor_edit = array('class'=>"label label-warning");
?>
<div id="tabs-1">
	<table class="display table table-striped table-hover table-condensed" id="consultar_usuarios">
		<thead> 
			<tr>
				<th class="span3">Nome</th>
				<th class="span2">Entrada</th>
				<th class="span2">Nascimento</th>
				<th class="span2">Fone</th>
				<th class="span3" >UBS</th>
				<th class="span2">Operações</th>
			</tr>
		</thead>
	<tbody>
<?php
	foreach ($pacientes as $linha)
	{
		$u_user = $linha->nome_unidade;
		$fDateEntr = date("d-m-Y", strtotime($linha->dt_entrada));
		$fDateNasc = date("d-m-Y", strtotime($linha->dt_nascimento));
		$nome = $linha->nome_paciente;
		$entrada = $fDateEntr;
		$telefone = $linha->fone;
		//$u_user,
		$operacoes = anchor("pacientes/editar/$linha->id_cad_pacientes",'Editar',$anchor_edit).' <i class="icon-italic"></i> <a href="#MeuModal'.$linha->id_cad_pacientes.'" class="label  label-danger" data-toggle="modal">Deletar</a>';
		echo "<tr class='gradeA'>";
        echo "<td><center>$nome</center></td>";
        echo "<td><center>$entrada</center></td>";
        echo "<td><center>$fDateNasc</center></td>";
        echo "<td><center>$telefone</center></td>";
		echo "<td><center>$u_user</center></td>";
		echo "<td><center>$operacoes</center></td>";
		echo '
		<div id="MeuModal'.$linha->id_cad_pacientes.'" class="modal fade" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h3 id="meuModelLabel">Realmente deseja Excluir o usuario?</h3>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						'.anchor("pacientes/deletar/$linha->id_cad_pacientes",'Excluir',$anchor_delete).'
					</div>					
				</div>
			</div>
		</section>
		</div>';
		echo "</tr>"; 
	}
?>
	</tbody>
</table>
</div>
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
					"mColumns": [0, 1, 2, 3, 4]
				},
				{
					"sExtends": "pdf",
					"sButtonText": "Exportar para PDF",
					"sTitle": "Usuarios",
					"sPdfOrientation": "landscape",
					"mColumns": [0, 1, 2, 3, 4] 
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
