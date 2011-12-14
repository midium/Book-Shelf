<?php
try {
	$mongo	= new Mongo();
	$dbase	= $mongo->listDBs();
	echo '<pre>';
	print_r($dbase);
	$mongo->close();
} catch(MongoConnectionException $e) {
	die($e->getMessage());
}

?>