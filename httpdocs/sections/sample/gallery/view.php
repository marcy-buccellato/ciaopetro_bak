<?php
$xtpl = new XTemplate("$DIR_SECTION/view.tpl");

$d_gal  = "$DIR_CMS/gallery";
$f_sort = "$d_gal/sort.txt";
$f_idx  = $_REQUEST['p'] - 1;
$images = file($f_sort);


$f_idx_prev = $f_idx == 0 ? count($images) - 1 : $f_idx - 1;
$f_idx_next = $f_idx == count($images) - 1 ? 0 : $f_idx + 1;

$f_img  = rtrim($images[$f_idx]);
$f_txt  = substr($f_img, 0, strlen($f_img) - 3) . 'txt'; 

$f_prev = rtrim($images[$f_idx_prev]);
$f_next = rtrim($images[$f_idx_next]);

if (file_exists("$d_gal/txt/$f_txt")) {
	$lines = file("$d_gal/txt/$f_txt");
	$xtpl->assign('IMG_TITLE', '&nbsp; // ' . array_shift($lines));
	$xtpl->assign('CAPTION', join("\n", $lines));
}

$xtpl->assign('TN_PREV', "/cms/gallery/tn/$f_prev");
$xtpl->assign('TN_NEXT', "/cms/gallery/tn/$f_next");
$xtpl->assign('TN_PREV_LNK', "/gallery/view/" . ($f_idx_prev + 1));
$xtpl->assign('TN_NEXT_LNK', "/gallery/view/" . ($f_idx_next + 1));
$xtpl->assign('SRC_IMG', "/cms/gallery/images/$f_img");
$xtpl->parse("main");
$xtpl->out("main");
?>