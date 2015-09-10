<?php
require_once('File/Find.php');

$dir_gallery = 'cms/gallery';
$dir_images  = "$dir_gallery/images";
$dir_tn      = "$dir_gallery/tn";
$f_sort      = "$dir_gallery/sort.txt";

// 	$images = &File_Find::glob('/\.jpg$/i', $dir_images, 'perl');
$images = file($f_sort);

$xtpl = new XTemplate("$DIR_SECTION/main.tpl");

if (count($images) > 0) {
	/*
	foreach ($images as $image) {
		$xtpl->assign('SRC_TN', "$dir_tn/$image");
		$xtpl->assign('LNK_IMG', "/gallery/view/$image");
		$xtpl->parse('main.tn');
	}
	*/

	for ($i=0; $i<count($images); $i++) {
		$xtpl->assign('SRC_TN', "/$dir_tn/" . $images[$i]);
		$xtpl->assign('LNK_IMG', "/gallery/view/" . ($i + 1));
		$xtpl->parse('main.tn');
	}
}

$xtpl->parse("main");
$xtpl->out("main");
?>
