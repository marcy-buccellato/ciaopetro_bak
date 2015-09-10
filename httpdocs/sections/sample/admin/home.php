<?php
$xtpl = new XTemplate("$DIR_SECTION/home.tpl");

$f_main       = "$DIR_CMS/home/main.html";
$f_box        = "$DIR_CMS/home/box.html";
$f_meta       = "$DIR_CMS/home/meta.txt";

if (file_exists("$f_meta")) {
	$arr_meta = file("$f_meta");
	foreach ($arr_meta as $item) {
		preg_match("/^([^\:]+)\: (.+)$/", $item, $matches);
		$meta[$matches[1]] = $matches[2];
	}
}

$title = isset($meta['title']) ? $meta['title'] : ucfirst($SECTION);
$description = $meta['description'] ? $meta['description'] : "Thornwood Cabinetry is a small custom cabinet shop. We also do renovations and new construction with an emphasis on kitchens and baths. We are dedicated to providing the highest quality cabinetry, and woodwork needs.";
$keywords = $meta['keywords'] ? $meta['keywords'] : 'cabinetry,thornwood,carpentry,professional,environmental';

$xtpl->assign('CONTENT_MAIN', join("",file($f_main)));
$xtpl->assign('CONTENT_BOX', join("",file($f_box)));
$xtpl->assign('META_TITLE', $title);
$xtpl->assign('META_DESC', $description);
$xtpl->assign('META_KEYWORDS', $keywords);

// handle cms form
if ($_POST['save']) {
	$fh_main = fopen($f_main, 'w');
	$fh_box = fopen($f_box, 'w');
	$fh_meta = fopen($f_meta, 'w');
	fwrite($fh_main, $_REQUEST['content_main']);
	fwrite($fh_box, $_REQUEST['content_box']);
	fwrite($fh_meta, "title: " . $_REQUEST['meta_title'] . "\ndescription: " . $_REQUEST['meta_desc'] . "\nkeywords: " . $_REQUEST['meta_keywords']);
	header('Location: /admin/home');
}


$xtpl->parse("main");
$xtpl->out("main");

?>