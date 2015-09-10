<?php

require_once('UploadMgr.class.php');

class UploadImageMgr extends UploadMgr {
	protected $_allowed_exts = array('gif', 'jpeg', 'png');
	protected $_tn_width = 100;
	protected $_tn_height = 66;
	
	public function __construct($input, $dir_dest) {
		parent::__construct($input, $dir_dest);
	}
	
	public function getAllowedExtensions() {
		return $this->_allowed_exts;
	}
	

	public function hasAllowedExtension() {
		return true;
		
		// verify that image has an allowed extension
		$pattern = '/(' . join(')|(', $this->_allowed_exts) . ')/';
		return preg_match($pattern, substr($this->_name, -3));
	}
	
	public function saveImage($dir = NULL, $f_name = NULL, $new_width = NULL) {
		if (!$this->hasAllowedExtension($this->_name)) {
			return false;
			
		} else if (!parent::saveUpload($dir, $f_name)) {
			return false;
		
		} else if (NULL != $new_width && !$this->resizeImage($new_width)) {
			return false;		
		}
		
		return $this->_name;
	}
	
	public function saveImageNotes($dir_notes, $title = NULL, $caption = NULL) {
		if ($title !== NULL || $caption !== NULL) {
			$fh =  fopen("$dir_notes/" . substr($this->_name, 0, strlen($this->_name) - 3) . 'txt', 'w');
			
			if (!$fh) return false;

			$written = fwrite($fh, $_POST['title'] . "\n" . $_POST['caption']);
			fclose($fh);
			return $written;
		}
	}
	
	public function resizeImage($new_width, $new_height = NULL, $f_new_image = NULL, $tn = false) {
		$f_image = $this->_dir_dest . '/' . $this->_name;
		if (!file_exists($f_image))
			return false;
			
		if (NULL === $f_new_image)
			$f_new_image = $f_image;
		
		// print "<pre>found image</pre";
		
		list($width, $height) = getimagesize($f_image);
		if ($width != $new_width) {
			if ($new_height === NULL) $new_height = $new_width / $width * $height;

			$tmp_image = imagecreatefromjpeg($f_image);
			$new_image = imagecreatetruecolor($new_width, $new_height);
			
			// print "<pre>resampling image</pre";
			
			if ($tn && !imagecopyresized($new_image, $tmp_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
				return false;
			
			else if (!$tn && !imagecopyresampled($new_image, $tmp_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
				return false;
			
			else if (!imagejpeg($new_image, $f_new_image, 100))
				return false;
			
			imagedestroy($new_image);
			imagedestroy($tmp_image);
		}
		
		return true;
	}
	
	public function generateThumbnail($dir_tn) {
		$f_image = "$dir_tn/" . $this->_name;
		return $this->resizeImage($this->_tn_width, $this->_tn_height, $f_image, true);
	}
}
?>