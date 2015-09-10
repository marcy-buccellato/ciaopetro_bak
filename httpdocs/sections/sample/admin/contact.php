<?php
$xtpl = new XTemplate("$DIR_SECTION/contact.tpl");

$f_main       = "$DIR_CMS/contact/main.html";
$f_box        = "$DIR_CMS/contact/box.html";

$xtpl->assign('CONTENT_MAIN', join("",file($f_main)));
$xtpl->assign('CONTENT_BOX', join("",file($f_box)));

// handle cms form
if ($_POST['save_sort']) {
	$fh_main = fopen($f_main, 'w');
	$fh_box = fopen($f_box, 'w');
	fwrite($fh_main, $_REQUEST['content_main']);
	fwrite($fh_box, $_REQUEST['content_box']);
	header('Location: /admin/contact');
}


$xtpl->parse("main");
$xtpl->out("main");

?>