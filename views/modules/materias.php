<H1>MATERIAS</H1>


<form method="post">
	<?php
		$registro = new MvcController();
		$registro -> registroBaseMateriasController();
		$registro -> registroMateriasController();
	?>
</form>