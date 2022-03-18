<?php
$urls = ''; # urls by \n
$root = $_SERVER['DOCUMENT_ROOT']; # root folder start
$arrUrls = explode("\n", trim($urls));
foreach($arrUrls as $url){
    $url = trim($url);
    $file = file_get_contents($url);
    $path = parse_url($url, PHP_URL_PATH);
	$arrPath = explode("/", trim($path));
	$filename = $arrPath[count($arrPath)-1];
	unset($arrPath[count($arrPath)-1]);
	if (!file_exists($root . implode("/",  $arrPath)))
		@mkdir($root . implode("/",  $arrPath), 0755, true);
	file_put_contents($root . implode("/",  $arrPath) . "/" . $filename, $file);
}
