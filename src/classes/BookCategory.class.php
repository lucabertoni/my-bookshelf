<?php
	require_once 'lib/errrors.php';
	require_once 'lib/defs.php';


	/**
	* This defines the structure of a bookshelf category.
	* The bookshelf contains an array of categories loaded from the filesystem
	* This class defines some category info like the category name, the number of books inside it and so on.
	* Categories are defined by folders which do not contain a file called BOOK_INFO.txt
	* A structure of the bookshelf could be:
	* /
	*	Categories/
	*		Informatics/
	*			Computer_Programming/
	*				My_Book/
	*					BOOK_INFO.txt
	*/
	class BookCategory
	{
		private $error_no = 0;
		public $category_name = "";
		public $category_fs_path = "";
		public $category_parent_category_object = NULL;
		private $subcategories = array();

		/**
		 *
		 * Initializes category details
		 * $category_name							->				string, name of the category
		 * $category_fs_path						->				string, path of the category on the filesystem
		 * $category_parent_category_object			->				BookCategory, object of the parent category, NULL if no parent
		 *
		 */
		
		function __construct($category_name, $category_fs_path, $category_parent_category_object)
		{
				if(($rc = $this->checkBookCategoryInfo($category_name, $category_fs_path, $category_parent_category_object) != _ERROR_NO_ERROR)){

					$this->error_no = $rc;

					return;
				}

				$this->category_name = trim($category_name);
				$this->category_fs_path = sanitize_directory_path($category_fs_path);
				$this->category_parent_category_object = $category_parent_category_object;
		}

		private function checkBookCategoryInfo($category_name, $category_fs_path, $category_parent_category_object)
		{
			if(empty(trim($category_name)))	return _ERROR_EMPTY_BOOK_CATEGORY;

			if(empty(trim($category_fs_path))) return _ERROR_EMPTY_BOOK_CATEGORY_FS_PATH;
			if(getDirectoryContent($category_fs_path) == false) return _ERROR_CATEGORY_DIRECTORY_IS_NOT_A_DIRECTORY;

			/* Checking parent category object */
			if(!($category_parent_category_object instanceof BookCategory)) return _ERROR_INCORRECT_PARAMETER_TYPE;

			$parent_book_category_object_error_no = $category_parent_category_object->getErrorNo();
			if($parent_book_category_object_error_no != _ERROR_NO_ERROR) return $parent_book_category_object_error_no;

			return _ERROR_NO_ERROR;
		}


		/**
		 *
		 * Load subcategories recursively for a max depth level of max_depth_level
		 *
		 * max_depth_level					->					int, max depth level, counting from 0 (i.e. 0 is the first level of subcategories). If -1 is define a max level of _MAX_CATEGORY_DEPTH_LEVEL is assumed. If a value gt _MAX_CATEGORY_DEPTH_LEVEL is passed, _MAX_CATEGORY_DEPTH_LEVEL is assumed
		 */
		public function loadSubCategoriesFromDisk($max_depth_level = -1){
			$category_obj = $this;

			$loading_level = 0;

			$max_depth_level = (($max_depth_level <= _MAX_CATEGORY_DEPTH_LEVEL) && ($max_depth_level >= 0)) ? $max_depth_level : _MAX_CATEGORY_DEPTH_LEVEL;

			if($dir_content = getDirectoryContent($category_obj->category_fs_path)){
				foreach ($dir_content as $key => $dir) {
					$sub_dir_content = getDirectoryContent($dir);

					$dir_is_a_directory = $sub_dir_content !== false;

					if($dir_is_a_directory){
						$dir_sanitized = replace_chr(array("_", "/", "<", ">", ".", ","));

						$subcategory_path = $category_obj->category_fs_path."/".$dir;

						$sub_category_object = new BookCategory($dir_sanitized, $subcategory_path, $category_obj);

						$rc = $sub_category_object->getErrorNo();

						if($rc != _ERROR_NO_ERROR){
							$this->error_no = $rc;

							MB_LOG(_LOG_LEVEL_ERROR,"Error occurred while loading subcategory '".$dir_sanitized."' with path '".$subcategory_path."'", false);

							break;
						}

						$sub_category_object->loadSubCategoriesFromDisk(($max_depth_level - 1));

						array_push($category_obj->subcategories, $sub_category_object);
					}
				}
			}
		}

		public function getErrorNo()
		{
			return $this->error_no;
		}
	}
