<?php

if($_POST['req'] && $_POST['req'] == "postdata"){
	$cod = date("YmdHis", time());
	$id = $_POST['id'];
	$text = $_POST['text'];
	$by = $_POST['by'];
	$myfile = fopen("newfile.txt", "aw") or die("Unable to open file!");
	$txt = '{"cod":"'.$cod.'","id":"'.$id.'","text":"'.$text.'","by":"'.$by.'"}'."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
}else if($_POST['req'] && $_POST['req'] == "getdata"){

	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	// Output one line until end-of-file
	$array = "";
	$first = true;
	while(!feof($myfile)) {
	  $ar = str_replace("\n","",fgets($myfile));
	  if($ar && strstr($ar,"{")){
	  	if(!$first)
			$array .= ",";
	  	$array .= $ar;
	  $first = false;
	  }
	}
	echo "[".$array."]";
	exit;
}else if($_POST['req'] && $_POST['req'] == "remdata"){

	$cod = $_POST['code'];
	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	// Output one line until end-of-file
	$array;
	while(!feof($myfile)) {
	  $ar = str_replace("\n","",fgets($myfile));
	  if($ar && strstr($ar,"{") && !strstr($ar,"\"cod:\":\"{$cod}\"")){
	  	$array [] = $ar;
	  }
	}
	fclose($myfile);
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	foreach ($array as $txt) {
		if(!strstr($txt, $cod))
			fwrite($myfile, $txt."\n");
	}

	fclose($myfile);
}else{
	echo "Merda!";
}