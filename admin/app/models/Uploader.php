<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
final class Uploader extends Models {

	final public function __construct() {
		parent::__construct();
	}

	final public function danger(string $file) : bool {
		if (in_array(Fl::fext($file), ['php', 'php5', 'phtml', 'html', 'db', 'sql', 'json', 'js','css', 'xml'])) {
			return true;
		}

		return false;
	}

	final public function thumb(string $olddir, string $newdir, string $ext, int $s1 = 150, int $s2 = 150, int $v1 = 0, int $v2 = 0) {
		if (in_array($ext, ['jpg', 'JPG','JPEG', 'jpeg'])) {
			$original = imagecreatefromjpeg($olddir);
		}else if (in_array($ext, ['png', 'PNG'])) {
			$original = imagecreatefrompng($olddir);
		}else{
			$original = imagecreatefromgif($olddir);
		}

		$thumbnail = imagecreatetruecolor($s1, $s2);

		$w = imagesx($original);
		$h = imagesy($original);

		imagecopyresampled($thumbnail,$original, 0, 0, $v1, $v1, $w, $h, $w, $h);

		if (in_array($ext, ['jpg', 'JPG','JPEG', 'jpeg'])) {
			imagejpeg($thumbnail, $newdir . '.' . $ext, 95);
		}else if (in_array($ext, ['png', 'PNG'])) {
			imagepng($thumbnail, $newdir . '.' . $ext);
		}else{
			imagegif($thumbnail, $newdir . '.' . $ext);
		}
	}

	final public function __destruct(){
		parent::__destruct();
	}
}

?>