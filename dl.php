<?php
$urls = ''; # urls by \n
$root = $_SERVER['DOCUMENT_ROOT'];

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
$arrUrls = explode("\n", trim($urls));
foreach($arrUrls as $url){
    $url = trim($url);
	if(empty($url))
		continue;
    $file = file_get_contents($url, false, stream_context_create($arrContextOptions));
    $path = parse_url($url, PHP_URL_PATH);
	$arrPath = explode("/", trim($path));
	$filename = $arrPath[count($arrPath)-1];
	unset($arrPath[count($arrPath)-1]);
	if (!file_exists($root . implode("/",  $arrPath)))
		@mkdir($root . implode("/",  $arrPath), 0755, true);
	file_put_contents($root . implode("/",  $arrPath) . "/" . $filename, $file);
}
