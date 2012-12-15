<?php

$id = $_GET['id'];

header('Content-type: application/xml');
header('Content-Disposition: attachment; filename="slider-'. $id .'.xml"');

$file_path = "../xml/slider-$id.xml";

if (file_exists($file_path))
	readfile($file_path);
else
	echo "This slider doesn't have a saved XML file." . "\n" . "Open the slider, click on the 'Update Slider' button, and then try to export it again.";	
?>