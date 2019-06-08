<?php

session_start();


if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}

?>

<h1>ALUMNOS EN MATERIA</h1>
<td></td>
	<table id="table" border="0">
		<thead>
			<tr>
				<th>Verificado</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Agregar</th>
				<th>Borrar</th>
			

			</tr>
		</thead>
		<tbody>
			<?php

		$vistaAgregarAlumno = new MvcController();
		$vistaAgregarAlumno -> vistaAgregarAlumnoController();
 
       // $vistaAgregarAlumno -> vistaEliminarAlumnoController();
		

			?>

		</tbody>
	</table>
<?php

if(isset($_GET["cambio"])){
	if($_GET["cambio"]=="Yes")
	{	
		$vistaAgregarAlumno -> registroAlumnoXMateriaController();
	}

	if($_GET["cambio"]=="No")
	{	
         $vistaAgregarAlumno -> borrarAlumnoXMateriaController();
	}
	
}

?>


