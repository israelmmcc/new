<H1>GRUPOS</H1>


<form method="post">
	<?php
		$registro = new MvcController();
		$registro -> registroBaseGruposController();
		$registro -> registroGruposController();
	?>
</form>