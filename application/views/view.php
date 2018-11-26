<!DOCTYPE html>
<html>
<head>
	<title>Code igniter | Views</title>
</head>
<body>
	<h1>Desde la vista <?= $title ?></h1>
	<ul>
		<?php foreach ($colors as $item): ?>
			<li><?= $item ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>