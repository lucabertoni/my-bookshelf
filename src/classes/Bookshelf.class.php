<?php
	require 'lib/common.php';
	require 'BookCategory.class.php';
	require 'Book.class.php';

	/**
	* That class manages the bookshelf and it's contents.
	* The bookshelf itself is identified by a filesystem structure like this one:
	* /
	*	Categories/
	*		Informatics/
	*			Computer_Programming/
	*				My_Book/
	*					BOOK_INFO.txt
	*/
	class Bookshelf
	{
		/**
		 *
		 * Initializes the object
		 *
		 * $main_bookshelf_categories_directory			->			string, path on the fs of the main directory of books categories,
		 *													ex: /var/www/data/books/categories/
		 */
		function __construct($main_bookshelf_categories_directory)
		{
			$this->aCategories = array();
			$this->loadCategories($main_bookshelf_categories_directory, NULL);
		}

		/**
		 *
		 * Load main categories in the array and subcategories in the main categories objects and build the tree structure of them based on the class BookCategory
		 * 
		 * $category_directory_path			->			string, path on the fs of the main category,
		 *													ex: /var/www/data/books/categories/
		 * $parent_category								->			object of type BookCategory that identifies the parent of the category currently analized. If NULL it is assumed as it is the main category currently scanned. When the method is called you have to pass NULL if you do not have a BookCategory object already initialized
		 */
		function loadCategories($category_directory_path, $parent_category = NULL){
			$category_directory_path = sanitize_directory_path($category_directory_path);

			if(($directory_content = getDirectoryContent($category_directory_path))){
				foreach ($directory_content as $directory_of_category) {
					$subcategory_path = $category_directory_path.$directory_of_category;

					$app = getDirectoryContent($subcategory_path);

					$is_directory_of_a_book = in_array(_BOOK_INFO_FILE_NAME, ($app == FALSE) ? array(_BOOK_INFO_FILE_NAME) : $app);

					print_r("trying to scan: ".$subcategory_path);
					print_r("<br>");
					var_dump(scandir($subcategory_path));
					print_r("<br>");
					var_dump($app);
					print_r("<br>");

					// Check that the directory is not a book directory
					if(!($is_directory_of_a_book)){
						/**
						 *
						 * category_name			->			string, name of the category
						 * $fs_path					->			string, path of the directory which identifies the category on the filesytem
						 * parent_category			->			BookCategory object, parent category reference
						 *
						 */					
						$oCategory = new BookCategory($directory_of_category, $subcategory_path, $parent_category);
						

						if(is_null($parent_category) && ($oCategory->error_no <= 0)){
							array_push($this->aCategories, $oCategory);
						}

						$this->loadCategories($subcategory_path, $oCategory);
					}
				}
			}
		}
	}
?>