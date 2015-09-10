<?php
require_once('include/UploadImageMgr.class.php');
require_once('File/Find.php');
/*
$dir_images    = "$DIR_CMS/gallery/images";
$dir_image_tn  = "$DIR_CMS/gallery/tn";
$dir_image_txt = "$DIR_CMS/gallery/txt";
$f_images      = "$DIR_CMS/gallery/sort.txt";
*/
$dir_gallery = 'cms/gallery';
$dir_images  = "$dir_gallery/images";
$dir_tn      = "$dir_gallery/tn";
$dir_txt     = "$DIR_CMS/gallery/txt";
$f_sort      = "$DIR_CMS/gallery/sort.txt";

$image_width = 600;
$tn_width = 100;

$xtpl = new XTemplate("$DIR_SECTION/gallery.tpl");
$errs = array();
$msgs = array();

// handle form post
if ($_POST['upload']) {
	$upload_image = new UploadImageMgr('f_image', "$DIR_HTTP_ROOT/$dir_images");
	$upload_image_tn = new UploadImageMgr('f_image_tn', "$DIR_HTTP_ROOT/$dir_tn");
	$upload_f_name = false;
	
	// large image file
	if (!$upload_image->uploadExists()) {
		array_push($errs, "Oo! Couldn't find an uploaded image.  Do it again do it again!");
		
	} else if (($upload_f_name = $upload_image->saveImage(NULL, NULL, $image_width)) == false) {
		array_push($errs, "Shoot-a-maroot! Couldn't save the image!");

	} else {
		array_push($msgs, "Yay!  Saved uploaded image as $upload_f_name!");		

		// thumbnail
		if (!$upload_image_tn->uploadExists()) {
			if (!$upload_image->generateThumbnail("$DIR_HTTP_ROOT/$dir_tn"))
				array_push($msgs, "Hmm, no thumbnail...and we couldn't generate one...crap-a-marap!.");
			else 
				array_push($msgs, "Hmm, no thumbnail.  That's ok, we generated one!.");
		
		} else if (!$upload_image_tn->saveImage(NULL, NULL, $tn_width)) {
			array_push($errs, "Sheesh-a-mareesh!  Couldn't save the thumbnail!");
			
		} else {
			array_push($msgs, "Yay!  Saved uploaded thumnail!");		
		}
		
		if (count($errs) == 0) {
			// image saved successfully so append to sort file
			$fh = fopen($f_sort, 'a');
			if (!$fh) {
				array_push($errs, "Unable to write to sort file.");
			
			} else {
				fwrite($fh, "$upload_f_name\n");
				fclose($fh);
			}
		}
		
		// title and caption
		if (($_POST['title'] || $_POST['caption'])) {
			if (!$upload_image->saveImageNotes($dir_txt, $_POST['title'], $_POST['caption'])) {
				array_push($errs, "Oopsie daisy (just one daisy)!  Couldn't write title or caption.");
		
			} else {
				array_push($msgs, "Yay! Saved title/caption...and stuff!");
			}
		}
	}
}

// handle sort and delete
if ($_POST['save_sort']) {
	//print $_REQUEST['gallery_sort'];
	$fh = fopen($f_sort, 'w');
	fwrite($fh, $_REQUEST['gallery_sort'] . "\n");
	header('Location: /admin/gallery');
}

// display errors
if (count($errs) > 0) {
	foreach ($errs as $err) {
		$xtpl->assign("ERR", $err);
		$xtpl->parse("main.errs.err");
	}
	$xtpl->parse("main.errs");
}

// display messages
if (count($msgs) > 0) {
	foreach ($msgs as $msg) {
		$xtpl->assign("MSG", $msg);
		$xtpl->parse("main.msgs.msg");
	}
	$xtpl->parse("main.msgs");
}
// build sort gallery
$images = file($f_sort);
$xtpl->assign('LST_SORT', join("", $images));
if (count($images) > 0) {
	for ($i=0; $i<count($images); $i++) {
		$xtpl->assign('SRC_TN', "/$dir_tn/" . $images[$i]);
		$xtpl->assign('NAME_TN', $images[$i]);
		$xtpl->assign('LNK_IMG', "/gallery/view/" . ($i + 1));
		$xtpl->parse('main.tn');
	}
}

// build sort select box
/*$images = file($f_images);
$sel_images = "<select name=\"sel_images\" id=\"sel_images\" size=\"8\">\n";
foreach($images as $image) {
	$sel_images .= "\t<option value=\"$image\">$image</option>\n";
}
$sel_images .= "</select>\n";

$xtpl->assign("SEL_IMAGES", $sel_images);
*/
// render view
$xtpl->parse("main");
$xtpl->out("main");
?>
