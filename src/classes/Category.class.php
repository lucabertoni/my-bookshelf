<?php 
	/**
	* This defines the structure of a bookshelf category.
	* The bookshelf contains an array of categories loaded from the filesystem
	* This class defines some category info like the category name, the number of books inside it and so on.
	* Categories are defined by folders which do not contain a file called BOOK_INFO.txt
	* A structure of the bookshelf could be:
	* /
	*	Informatics/
	*		Computer_Programming/
	*			My_Book/
	*				BOOK_INFO.txt
	*/
	class BookCategory
	{
		function __construct(argument)
		{
			$this->category_name = "";
			$this->number_of_books = 0;
			$this->subcategories = array();
			$this->fs_path = ""; // path on the filesystem of the category
			$this->parent_category = NULL;
		}

		public function setCategoryName($value='')
		{
			# code...
		}
	}

?>