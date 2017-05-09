<?php
	/**
	 *
	 * Some useful defines
	 * 
	 */
	define('_MY_BOOKSHELF_LOG_FILE', '/var/log/my-bookshelf/error.log');	// my-bookshelf log file path

	define('_DEBUG', 1);	// debug enabled or disabled

	define('_GITHUB_REPOSITORY_URL', 'https://github.com/lucabertoni/my-bookshelf');

	define('_BOOK_FILE_FORMATS_SUPPORTED', array('PDF','EPUB','ZIP','RAR','TGZ','PostScript','RTF')); // Supported book file formats
	define('_BOOK_AUTHORS_MAX_NUMBER_ACCEPTED', 20);	// Max number of authors acceptet in a book. If more are provided are lost
	define('_BOOK_CONTRIBUTORS_MAX_NUMBER_ACCEPTED', 1000);	// Max number of contributors acceptet in a book. If more are provided are lost

	define('_BOOK_ADDITIONAL_INFO_MAX_NUMBER_ACCEPTED', 50);	// Max number of contributors acceptet in a book. If more are provided are lost

	define('_MAX_CATEGORY_DEPTH_LEVEL', 10);