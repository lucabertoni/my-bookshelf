<?php
	
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
		 * All this attributes are defined as public to avoid writing get methods for each of them,
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

		/**
		 *
		 * Initializes the object.
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
		 * book_notes				->				string, notes about the book, they could be anything else that is not already been written down. For additional book info use book_additional_info above
		 */
		function __construct($book_title,$book_subtitle,$book_authors,$book_genre,$book_code,$book_cover_path,$book_description,$book_contributors,$book_additional_info,$book_notes)
		{
			
		}
	}