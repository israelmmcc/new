<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}

?>

<h1>GRUPOS</h1>
<td><a href="index.php?action=grupos"><button class="success">Agregar Nuevo Grupo</button></a></td>
	<table id="table" border="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Carrera</th>
			     <th>Agregar Materia</th>
			    <th>¿Detalles?</th>
				<th>¿Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			<?php

		$vistaGrupo = new MvcController();
		$vistaGrupo -> vistaGruposController();
		$vistaGrupo -> borrarGrupoController();

			?>

		</tbody>
	</table>
<?php

if(isset($_GET["action"])){
	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}

?>


