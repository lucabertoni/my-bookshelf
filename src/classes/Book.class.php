<?php
	require_once '../lib/errors.php';
	
	/**
	 *
	 * Where to find info about a book
	 *
	 */
	define('_BOOK_INFO_FILE_NAME', 'BOOK_INFO.txt');

	/**
	 *
	 * Admitted file extensions for the book cover image
	 *
	 */
	define('_BOOK_COVER_EXTENSIONS','jpg,jpeg,png');

	/**
	* This class defines how a books is identified by the app
	* That means that we have some properties and so on
	*/
	class Book
	{
		/**
		 * All this attributes are defined as public to avoid writing get methods for each of them and get easy access,
		 * they are not intended to be public to change their values. Be careful
		*/
		public $book_title = "";
		public $book_subtitle = "";
		public $book_authors = "";
		public $book_genre = "";
		public $book_code = "";
		public $book_cover_path = "";
		public $book_description = "";
		public $book_contributors = array();
		public $book_additional_info = /*assoc*/array();
		public $book_notes = "";
		public $book_resource_urls = /*assoc*/array('PDF' => '', 'EPUB' => '', 'ZIP' => '','RAR' => '','TGZ' => '', 'PostScript' => '', 'RTF' => '');

		private $error_no = _ERROR_NO_ERROR;

		/**
		 *
		 * Initializes the object.
		 * It doesn't check for security falls in book info like XSS and so on because there is no time to think about the problem of parsing a file created by an administrator to find something strange, tough the file was modified by an hacker who gained control of the machine
		 * book_title				->				string, title of the book
		 * book_subtitle			->				string, subtitle of the book
		 * book_authors				->				array, list of authors names
		 * book_genre				->				string, book genre
		 * book_code				->				string, book code, like ISBN and so on
		 * book_cover_path			->				string, path on the filesystem of the book cover path.
		 * book_description			->				string, description of the book
		 * book_contributors		->				array, list of book contributors except its authors
		 * book_additional_info		->				assocarray, list of additional book info, like:
		 												["amazon_link"] => "www.amazon.etcetc"
		 * book_notes				->				string, notes about the book, they could be anything else that is not 
		 											already been written down. For additional book info use book_additional_info above
		 * book_resource_urls		->				assocarray, list of book urls from where to download the book in different 												formats. For allowed formats see: _BOOK_FILE_FORMATS_SUPPORTED in lib/defs.php
		 */
		function __construct($book_title, $book_subtitle, $book_authors, $book_genre, $book_code, $book_cover_path, $book_description, $book_contributors, $book_additional_info, $book_notes, $book_resource_urls)
		{
			$error_code = $this->check_book_info($book_title, $book_resource_urls, $book_cover_path);

			if($error_code != _ERROR_NO_ERROR){
				$this->error_no = $error_code;
				return;
			}

			$this->book_title = trim($book_title);
			$this->book_subtitle = trim($book_subtitle);
			$this->book_authors = $book_authors;
			$this->book_genre = trim($book_genre);
			$this->book_code = trim($book_code);
			$this->book_cover_path = realpath(trim($book_cover_path));
			$this->book_description = trim($book_description);
			$this->book_contributors = $book_contributors;
			$this->book_additional_info = $book_additional_info;
			$this->book_notes = trim($book_notes);
		}

		/**
		 *
		 * It checks for book info validity
		 * Some book info are scanned and an appropriate error code is returned if something wrong is detected.
		 *
		 * book_title				->				string, title of the book
		 * book_resource_urls		->				assocarray, list of book urls from where to download the book in different 												formats. For allowed formats see: _BOOK_FILE_FORMATS_SUPPORTED in lib/defs.php
		 * Return					->				int, > 0 = An error occurred | <= 0 = No error occurred
		 */
		public static function check_book_info($book_title, $book_resource_urls, $book_cover_path)
		{
			if (empty($book_title)) return _ERROR_EMPTY_BOOK_TITLE;

			foreach ($book_resource_urls as $key => $value) {
				if(!(in_array($key, _BOOK_FILE_FORMATS_SUPPORTED))) return _ERROR_INVALID_BOOK_FORMAT;
			}

			/**
			
				TODO:
				- Give the possibility to retrive cover images from the internet
			 */
			if(!file_exists(realpath($book_cover_path))) return _ERROR_BOOK_COVER_DOES_NOT_EXISTS;

			return _ERROR_NO_ERROR;
		}

		public function getErrorNo()
		{
			return $this->error_no;
		}
	}