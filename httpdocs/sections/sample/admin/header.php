<?php
$xtpl = new XTemplate("$DIR_SECTION/header.tpl");

$f_mission       = "$DIR_CMS/header/mission.txt";

$xtpl->assign('CONTENT_MISSION', join("",file($f_mission)));

// handle cms form
if ($_POST['save']) {
	$fh = fopen($f_mission, 'w');
	fwrite($fh, $_REQUEST['content_mission']);
	header('Location: /admin/header');
}


$xtpl->parse("main");
$xtpl->out("main");

?>