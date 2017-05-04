<?php
	define("_MAX_BOOKS_NUMBER_FOR_EACH_CATEGORY", 1000);

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
		/**
		 *
		 * category_name			->			string, name of the category
		 * $fs_path					->			string, path of the directory which identifies the category on the filesytem
		 * parent_category			->			BookCategory object, parent category reference
		 *
		 */
		function __construct($category_name, $fs_path, $parent_category)
		{
			/**
			
				TODO:
				- Implement error handling
			 */
			
			$this->error_no = 0;
			$this->subcategories = array();

			$this->category_name = "";
			$this->setCategoryName($category_name);

			$this->number_of_books = 0;
			$this->setNumberOfBooks(0);

			$this->number_of_subcategories = 0;
			$this->subcategories = array();

			$this->fs_path = ""; // path on the filesystem of the category
			$this->setParentCategory($parent_category);
		}

		/**
		 *
		 * Sets the category name
		 * Returns				:				Boolean, true = Name setted | false = error occure while setting the category name
		 *
		 */
		private function setCategoryName($category_name)
		{
			$category_tmp = trim($category_name);
			$category_tmp = strip_tags(str_replace("_", " ", $category_tmp));

			$empty_category_name = empty($category_tmp);

			$this->category_name = "";
			if (!($empty_category_name)){
				$this->category_name = $category_tmp;
			}

			return !(empty($category_tmp));
		}

		/**
		 *
		 * Sets the number of books in the category
		 * Returns				:				Boolean, true = setted | false = error occure while setting it
		 *
		 */
		private function setNumberOfBooks($number_of_books)
		{
			$number_of_books_correct = $number_of_books >= 0 and $number_of_books <= _MAX_BOOKS_NUMBER_FOR_EACH_CATEGORY;
			$this->number_of_books = 0;
			if ($number_of_books_correct){
				$this->number_of_books = $number_of_books;
			}

			return $number_of_books_correct;
		}

		/**
		 *
		 * Sets the fs path of the category
		 * Returns				:				Boolean, true = setted | false = error occure while setting it
		 *
		 */
		private function setFSPath($fs_path)
		{
			$fs_path_tmp = trim($fs_path);
			$fs_path_tmp = strip_tags(str_replace("_", " ", $fs_path_tmp));

			$empty_fs_path = empty($fs_path_tmp);

			$this->fs_path = "";
			if (!($empty_fs_path)){
				$this->fs_path = $fs_path_tmp;
			}

			return !(empty($fs_path_tmp));
		}

		/**
		 *
		 * Sets the parent category reference
		 * Returns				:				Boolean, true = setted | false = error occure while setting it
		 *
		 */
		private function setParentCategory($parent_category)
		{
			//$this->$parent_category = NULL;
			if (is_null($parent_category) || $parent_category instanceof BookCategory){
				$this->parent_category = $parent_category;
			}

			return !(is_null($this->$parent_category));
		}

		public function addSubCategory($subcategory)
		{
			$subcategory_is_correct = ($subcategory instanceof BookCategory);
			if ($subcategory_is_correct){
				$this->subcategories = $parent_category;
				array_push($this->subcategories, $subcategory);
				$this->number_of_subcategories += 1;
			}

			return !(is_null($this->$parent_category));
		}
	}

?>