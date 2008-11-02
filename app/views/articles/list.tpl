
<h1>Lista de articulos</h1>

<p><a href="<?=Support::createLinkURL("articles", "add")?>" title="Añadir nuevo artículo">Añadir</a></p>


<?php
	$table = new Table();
	$table->addColumn(new ColumnLink("title", Support::createLinkURL(Application::$currentController, "view")), "Título");
	$table->addColumn(new ColumnPreview("content"), "Contenido");
	$table->addColumn(new Column("creation"), "Fecha de Creación");
	$table->addColumn(new ColumnButtons("id", array(
		'edit' => Support::createLinkURL(Application::$currentController, "edit"),
		'delete' => Support::createLinkURL(Application::$currentController, "delete")
	)), "Actions");
	echo $table->render($articles["data"]);
?>



Paginacion: 
	<?php
		$paginator = new Paginator($pageSize, $articles['total_rows'], $currentPage);
		echo $paginator->render();
	?>

<p>Mostrando: <?=$articles['num_rows']; ?> de <?=$articles['total_rows']; ?> en <?=$articles['request_time']; ?> secs.</p>
<p><a href="<?=Support::createLinkURL("articles", "populate") ?>" title="Popuilar con mierda del Rincón del Manga">Popular con mierda del Rincón del Manga</a></p>