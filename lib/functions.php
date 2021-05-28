<?php


use Elgg\Database\QueryBuilder;

//--- added by pessek
function _elgg_rmdir($dir, $empty = false) {
	if (empty($dir)) {
		// realpath can return false
		_elgg_services()->logger->warning(__FUNCTION__ . ' called with empty $dir');
		return true;
	}
	if (!is_dir($dir)) {
		return true;
	}

	$files = array_diff(scandir($dir), ['.', '..']);
	
	foreach ($files as $file) {
		if (is_dir("$dir/$file")) {
			_elgg_rmdir("$dir/$file");
		} else {
			unlink("$dir/$file");
		}
	}

	if ($empty) {
		return true;
	}
	
	return rmdir($dir);
}
//--end pessek
