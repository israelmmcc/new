<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";

//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/conexion.php:
class Datos extends Conexion{

	#INGRESO MAESTRO
	#-------------------------------------
	#Obtiene el email, contrasena, numero de empleado y nivel de los maestros.
	public function ingresoMaestroModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT email, password, num_empleado, nivel FROM $tabla WHERE email = :email");	
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetch();
		$stmt->close();
	}

	#VISTA MATERIAS MODEL
	#-------------------------------------
	#Obtiene los datos de todos las materias



	public function vistaMateriasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

	#VISTA GRUPOS MODEL
	#-------------------------------------
	#Obtiene los datos de todos los grupos

	public function vistaGruposModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}



			#REGISTRO DE MATERIA EN GRUPO
	#-------------------------------------
	public function registroMateriaXGrupoModel($datosModel){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO materias_grupos (idgrupo, idmateria) VALUES (:idgrupo,:idmateria)");	
		
		$stmt1->bindParam(":idgrupo", $datosModel["idgrupo"], PDO::PARAM_INT);
		$stmt1->bindParam(":idmateria",$datosModel["idmateria"], PDO::PARAM_INT);
		

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

		#REGISTRO DE ALUMNO EN MATERIA
	#-------------------------------------
	public function registroAlumnoXMateriaModel($datosModel){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO materias_alumnos (idmateria, idalumno) VALUES (:idmateria,:idalumno)");	
		
		$stmt1->bindParam(":idmateria", $datosModel["idmateria"], PDO::PARAM_INT);
		$stmt1->bindParam(":idalumno",$datosModel["matricula"], PDO::PARAM_INT);
		

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

		#BORRAR ALUMNOXMATERIA
	#------------------------------------
	public function borrarMateriaXGrupoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("DELETE FROM materias_grupos WHERE idgrupo=:idgrupo AND idmateria=:idmateria");

		$stmt->bindParam(":idgrupo", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idmateria", $datosModel["idmateria"], PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}

	
#vistaMateriasXGrupoModel
	#-------------------------------------
	#Obtiene las materias de toda la tabla
	public function vistaMateriasXGrupoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

		#vistaMateriasXCarreraModel
	#-------------------------------------
	#Obtiene las alumnos de toda la tabla
	public function vistaAlumnosXCarreraModel($idcarrera){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumnos where id_carrera=:id");
		$stmt->bindParam(":id", $idcarrera, PDO::PARAM_INT);
		if($stmt->execute())
			{echo "Correcto";}else{echo "incorrecto";}

		return $stmt->fetchAll();
	}

/////////////////////////////////////////////////////////////////////////////////////////

		#vistaMateriaAñadModel
	#-------------------------------------
	#Obtiene las alumnos de toda la tabla
	public function vistaMateriaAñadModel($idgrupo, $idmateria){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM materias_grupos where idgrupo=:idgrupo AND idmateria=:idmateria");

		$stmt->bindParam(":idgrupo", $idgrupo, PDO::PARAM_INT);
		$stmt->bindParam(":idmateria", $idmateria, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}


////////////////////////////////////////////////////////////////////////////////////////////

		#vistaMateriasXAlumnoModel
	#-------------------------------------
	#Obtiene las alumnos de toda la tabla
	public function vistaMateriaXAlumnoModel($idmateria, $idalumno){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM materias_alumnos where idmateria=:id AND idalumno=:matricula");

		$stmt->bindParam(":id", $idmateria, PDO::PARAM_INT);
		$stmt->bindParam(":matricula", $idalumno, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	#BORRAR ALUMNOXMATERIA
	#------------------------------------
	public function borrarAlumnoXMateriaModel($datosModel){
		$stmt = Conexion::conectar()->prepare("DELETE FROM materias_alumnos WHERE idalumno=:idalumno AND idmateria=:idmateria");

		$stmt->bindParam(":idalumno", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idmateria", $datosModel["idmateria"], PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}


			#REGISTRO DE GRUPO
	#-------------------------------------
	public function registroGruposModel($datosModel, $tabla){

		$carrera=(int)$datosModel["id_carrera"];
		
		
		$id=(int)$datosModel["id"];
		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (id, idcarrera) VALUES (:num_grupo,:idcarrera)");	
		
		$stmt1->bindParam(":num_grupo", $id);
		$stmt1->bindParam(":idcarrera", $carrera);
		

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}


	#ACTUALIZACION DE GRUPO
	#-------------------------------------
public function actualizarGrupoModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("UPDATE grupos SET idcarrera=:idcarrera WHERE id = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idcarrera", $datosModel["id_carrera"], PDO::PARAM_INT);

		// // var_dump($datosModel);
		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	
}

	#BORRAR GRUPO
	#-------------------------------------
	public function borrarGrupoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("DELETE FROM grupos WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}

	#VISTA MAESTROS MODEL
	#-------------------------------------
	#Obtiene los datos de todos los maestros
	public function vistaMaestrosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT m.num_empleado as num_empleado, m.nombre as nombre, m.email as email, c.nombre as nombre_carrera, m.nivel as nivel FROM $tabla as m inner join carrera as c on m.id_carrera=c.id");	
		$stmt->execute();
 
		return $stmt->fetchAll();

		$stmt->close();

	}


	#ACTUALIZACION DE LA MATERIA
	#-------------------------------------
	public function actualizarCarreraModel($datosModel, $tabla){
		var_dump($datosModel);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, idcarrera = :idcarrera, idmaestro=:idmaestro WHERE id=:id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);


		var_dump($datosModel);
		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	}

	public function ObtenerCarrera($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carrera where id=:id");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

//OBTENER MATERIA
	public function ObtenerMateria($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM materias where id=:id");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}
//OBTENER GRUPO
	public function ObtenerGrupo($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos where id=:id");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}



	public function ObtenerMaestro($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestros where num_empleado=:id");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

		#BORRAR MATERIA
	#-------------------------------------
	public function borrarMateriaModel($datosModel){
		$stmt = Conexion::conectar()->prepare("DELETE FROM materias WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}




		#REGISTRO DE MATERIA
	#-------------------------------------
	public function registroMateriasModel($datosModel, $tabla){

		$carrera=(int)$datosModel["id_carrera"];
		$maestro=(int)$datosModel["num_maestro"];
		$id=(int)$datosModel["id"];
		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, idcarrera, idmaestro) VALUES (:num_empleado,:nombre,:idcarrera,:idmaestro)");	
		
		$stmt1->bindParam(":num_empleado", $id);
		$stmt1->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt1->bindParam(":idcarrera", $carrera);
		$stmt1->bindParam(":idmaestro", $maestro);

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}


	#EDITAR MAESTRO
	#-------------------------------------
	#Se encarga de obtener los valores actuales de cierto empleado
	public function editarMaestroModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT num_empleado, nombre, email, password, id_carrera, nivel FROM $tabla WHERE num_empleado = :num_empleado");
		$stmt->bindParam(":num_empleado", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#OBTENER CARRERAS
	#-------------------------------------
	#Obtiene las carreras de toda la tabla
	public function obtenerCarrerasModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();
	}

		#OBTENER Maestros
	#-------------------------------------
	#Obtiene las carreras de toda la tabla
	public function obtenerMaestrosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_empleado, nombre FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	#OBTENER TUTORES
	#-------------------------------------
	#Obtiene las tutores de toda la tabla
	public function obtenerTutoresModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_empleado, nombre FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	#OBTENER ALUMNOS
	#-------------------------------------
	#Obtiene las alumnos de toda la tabla
	public function obtenerAlumnosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT matricula, nombre FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	#OBTENER ALUMNOS NIVEL
	#-------------------------------------
	#Obtiene los alumnos que tienen a cierto tutor
	public function obtenerAlumnosNivelModel($tabla, $id){
		$stmt = Conexion::conectar()->prepare("SELECT matricula, nombre FROM $tabla WHERE id_tutor=:id_tutor");
		$stmt->bindParam(":id_tutor", $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	#ACTUALIZAR MAESTRO
	#-------------------------------------
	#Permite realizar un update a la tabla de maestros
	public function actualizarMaestroModel($datosModel, $tabla){

		var_dump($datosModel);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password, id_carrera = :id_carrera WHERE num_empleado = :num_empleado");

		$stmt->bindParam(":num_empleado", $datosModel["num_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	}

	#BORRAR MAESTRO
	#------------------------------------
	public function borrarMaestroModel($datosModel, $tabla){

		
			
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_empleado = :num_empleado");
						$stmt->bindParam(":num_empleado", $datosModel, PDO::PARAM_STR);
			
						if($stmt->execute())
							return "success";
						else
							return "error";
			
						$stmt->close();
		
			
	}

	#REGISTRO DE MAESTROS
	#-------------------------------------
	public function registroMaestroModel($datosModel, $tabla){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (num_empleado, nombre, email, password, id_carrera, nivel) VALUES (:num_empleado,:nombre,:email,:password,:id_carrera,:nivel)");	
		
		$stmt1->bindParam(":num_empleado", $datosModel["num_empleado"], PDO::PARAM_STR);
		$stmt1->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt1->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt1->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt1->bindParam(":id_carrera", $datosModel["id_carrera"], PDO::PARAM_INT);
		$stmt1->bindParam(":nivel", $datosModel["nivel"], PDO::PARAM_INT);

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

	#REGISTRO DE ALUMNOS
	#-------------------------------------
	public function registroAlumnoModel($datosModel, $tabla){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula, nombre, id_carrera, id_tutor) VALUES (:matricula,:nombre,:id_carrera,:id_tutor)");	
		
		$stmt1->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_STR);
		$stmt1->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt1->bindParam(":id_carrera", $datosModel["id_carrera"], PDO::PARAM_INT);
		$stmt1->bindParam(":id_tutor", $datosModel["id_tutor"], PDO::PARAM_INT);
		
		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

	#VISTA ALUMNOS
	#-------------------------------------
	public function vistaAlumnoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT a.matricula as matricula, a.nombre as nombre, c.nombre as carrera, m.nombre as tutor from $tabla as a inner join carrera as c on c.id=a.id_carrera INNER JOIN maestros as m on m.num_empleado=a.id_tutor");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDICION DE ALUMNOS 
	#-------------------------------------
	public function editarAlumnoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT matricula, nombre, id_carrera, id_tutor FROM $tabla WHERE matricula = :matricula");
		$stmt->bindParam(":matricula", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZACION DE ALUMNOS 
	#-------------------------------------
	public function actualizarAlumnoModel($datosModel, $tabla){
		var_dump($datosModel);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_carrera = :id_carrera, id_tutor = :id_tutor WHERE matricula = :matricula");

		$stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_carrera", $datosModel["id_carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tutor", $datosModel["id_tutor"], PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarAlumnoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE matricula = :matricula");
		$stmt->bindParam(":matricula", $datosModel, PDO::PARAM_STR);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}


	#VISTA CARRERA
	#-------------------------------------
	public function vistaCarreraModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, nombre from $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#REGISTRO DE CARRERAS 
	#-------------------------------------
	public function registroCarreraModel($datosModel, $tabla){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");	
		
		$stmt1->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		
		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

	#EDICION DE LA CARRERA  
	#-------------------------------------
	public function editarCarreraModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZACION DE LA MATERIA
	#-------------------------------------
public function actualizarMateriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE materias SET nombre = :nombre,idmaestro=:idmaestro,idcarrera=:idcarrera WHERE id = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":idmaestro", $datosModel["num_maestro"], PDO::PARAM_INT);
		$stmt->bindParam(":idcarrera", $datosModel["id_carrera"], PDO::PARAM_INT);

		// var_dump($datosModel);
		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	
}
	#BORRAR TODO SOBRE LA CARRERA
	#------------------------------------
	public function borrarCarreraModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}

	#PERMITE REALIZAR UNA VISTA PARA TUTORIAS
	#-------------------------------------
	public function vistaTutoriasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}
	
	#VISTA DE LAS TUTORIAS POR NIVEL 
	#-------------------------------------
	#Muestra solo las tutorias que ha hecho el empleado, con el numero de maestro ingresado
	public function vistaTutoriasNivelModel($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where num_maestro=:num_maestro");	
		$stmt->bindParam(":num_maestro", $id, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

	#BORRAR DE LAS TUTORIAS 
	#-------------------------------------
	public function borrarTutoriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();

	}

	#BORRAR ALUMNOS TUTORIAS 
	#-------------------------------------
	public function borrarAlumnosTutoriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_sesion = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	}


	#REGISTRO DE TUTORIAS
	#-------------------------------------
	public function registroTutoriaModel($datosModel, $tabla){

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha, hora, tipo, tema, num_maestro) VALUES (:fecha,:hora,:tipo,:tema,:num_maestro)");	
		
		$stmt1->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt1->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt1->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
		$stmt1->bindParam(":tema", $datosModel["tema"], PDO::PARAM_STR);
		$stmt1->bindParam(":num_maestro", $datosModel["num_maestro"], PDO::PARAM_STR);
		
		var_dump($datosModel);

		if($stmt1->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt1->close();

	}

	#OBTENER ULTIMA TUTORIA
	#-------------------------------------
	public function ObtenerLastTutoria($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT max(id) FROM $tabla");
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#REGISTRO DE LOS ALUMNOS
	#-------------------------------------
	public function registroAlumnosTutoriaModel($datosModel, $id_sesion, $tabla){
		$datosModel_array =  explode(",",$datosModel);
		
		for($i=0;$i<sizeof($datosModel_array);$i++){
			$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula_alumno, id_sesion) VALUES (:matricula_alumno,:id_sesion)");	
			$stmt1->bindParam(":matricula_alumno", $datosModel_array[$i], PDO::PARAM_STR);
			$stmt1->bindParam(":id_sesion", $id_sesion, PDO::PARAM_INT);

			if(!$stmt1->execute())
				return "error";

		}
		
		return "success";		

		$stmt1->close();

	}

	#EDICION DE LA INTERFAZ
	#-------------------------------------
	public function editarTutoriaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, hora, fecha, tipo, tema, num_maestro FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#OBTENER LOS ALUMNOS DE LA TUTORIA
	#-------------------------------------
	public function obtenerAlumnosTutoriaModel($datosModel,$tabla){

		$stmt = Conexion::conectar()->prepare("SELECT st.matricula_alumno, a.nombre FROM $tabla as st INNER JOIN alumnos AS a ON a.matricula=st.matricula_alumno WHERE st.id_sesion=:id_sesion");
		$stmt->bindParam(":id_sesion", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}

	#ACTUALIZA EL TUTOR MUCHO MAS.
	#-------------------------------------
	public function actualizarTutoriaModel($datosModel, $tabla){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha, hora = :hora, tipo = :tipo, tema = :tema WHERE id = :id");

		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":tema", $datosModel["tema"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute())
			return "success";
		else
			return "error";

		$stmt->close();
	}


}

?>