<?php

class UploadMgr {
	protected $_input;
	protected $_name;
	protected $_tmp_name;
	protected $_dir_dest;
	
	public function __construct($input, $dir_dest) {
		$this->_input = $input;
		$this->_name  = basename($_FILES[$input]['name']);
		$this->_tmp_name = $_FILES[$input]['tmp_name'];
		$this->_dir_dest = $dir_dest;
	}
	
	public function getInput() {
		return $this->_input;	
	}
	
	public function getDirDest() {
		return $this->_dir_dest;
	}
	
	public function setDirDest($dir_dest) {
		$this->_dir_dest = $dir_dest;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function uploadExists() {
		return file_exists($this->_tmp_name);
	}
	
	public function getUploadSize() {
		return $_FILES[$this->_input]['size'];
	}
	
	public function saveUpload($dir=NULL, $f_name=NULL) {
		if (NULL === $dir) 
			$dir = $this->_dir_dest;
			
		if (NULL === $f_name)
			$f_name = preg_replace('/\s+/', '_', $this->_name);
			
		$f_path = "$dir/$f_name";
		
		if (move_uploaded_file($this->_tmp_name, $f_path)) {
			return $f_name;
		} else {
			return false;
		}
	}
	
	public function getError() {
		return $_FILES[$this->_input]['error'];
	}
}