<?php
	/**
	 *
	 * It gets the content of a directory except from the "." and ".."
	 * Returns					->			array if the directory content if the directory exists and is accessible
	 *										FALSE in case of errors
	 *
	 */
	function getDirectoryContent($dir_path)
	{
		$dir_content = scandir($dir_path);
		if($dir_content)
			return array_diff($dir_content, array('..', '.'));

		return FALSE;
	}

	/**
	 *
	 * It sanitizes the directory path
	 * 
	 * $dir_path			->			string, path of the directory to sanitize, ex: "/home/user"
	 * Returns				->			string, path or empty if errors occurred
	 */
	function sanitize_directory_path($dir_path){
		if(($dir_path = realpath($dir_path))){
			return $dir_path."/";
		}

		return "";
	}