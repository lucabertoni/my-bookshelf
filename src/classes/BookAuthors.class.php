<?php
	require_once '../lib/errors.php';
	require_once '../lib/defs.php';
	
	/**
	* This defines the book authors context
	*/
	class BookAuthors
	{
		private $book_authors = array();

		private $error_no = _ERROR_NO_ERROR;

		function __construct(...$authors_names)
		{
			$this->addAuthors($authors_names);
		}

		/**
		 *
		 * It adds an author to the authors list.
		 * If the author list has reached its max number of elements an error code is properly setted to _ERROR_MAX_NUMBER_OF_AUTHORS_REACHED
		 * 
		 * author_name				->				string, author name to add to the list
		 * 
		 * Return					->				bool, true = Author added | false = Limit reached, author not added
		 */
		
		private function addAuthor($author_name)
		{
			$author_added = false;

			if((count($this->book_authors) + 1) <= _BOOK_AUTHORS_MAX_NUMBER_ACCEPTED){
				array_push($this->book_authors, $author_name);

				$author_added = true;
			}else{
				$this->error_no = _ERROR_MAX_NUMBER_OF_AUTHORS_REACHED;
			}

			return $author_added;

		}

		private function addAuthors($authors)
		{
			foreach ($authors as $author) {
				if(!($this->addAuthor($author))){
					if($this->error_no == _ERROR_MAX_NUMBER_OF_AUTHORS_REACHED){
						MB_LOG(_LOG_LEVEL_WARNING, "BookAuthors -> addAuthors -> Max number of authors reached for the book", true);
					}

					break;
				}
			}
		}

		public function getBookAuthors()
		{
			return $this->$book_authors;
		}

		public function getErrorNo(){
			return $this->error_no;
		}
	}