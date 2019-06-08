<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}

?>

<h1>MATERIAS</h1>
<td><a href="index.php?action=materias"><button class="success">Agregar Nueva Materia</button></a></td>
	<table id="table" border="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Maestro</th>
				 <th>Agregar Alumno</th>
			    <th>¿Detalles?</th>
				<th>¿Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			<?php

		$vistaMateria = new MvcController();
		$vistaMateria -> vistaMateriasController();
		$vistaMateria -> borrarMateriaController();

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


