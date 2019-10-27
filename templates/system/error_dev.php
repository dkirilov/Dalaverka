<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error <?= $ex->getCode(); ?></title>
</head>
<body>
<h2>Detailed error info page for developers</h2>
<p>
	<br><b>ERROR CODE:</b> <?= $ex->getCode() ?>
	<br><b>ERROR MESSAGE:</b> <?= $ex->getMessage() ?>
	<br><b>ERROR OCCURED IN FILE:</b> <?= $ex->getFile() ?>
	<br><b>ON LINE:</b> <?= $ex->getLine() ?>
</p>
</body>
</html>