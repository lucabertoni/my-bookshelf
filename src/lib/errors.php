<?php
	require_once 'defs.php';
	
	/**
	 *
	 * Some errors constants you could need to debug software
	 *
	 */
	define('_ERROR_NO_ERROR', 0);
	define('_ERROR_ASSUMING_AN_ERROR_OCCURRED', 1);
	define('_ERROR_EMPTY_BOOK_TITLE', 2);
	define('_ERROR_INVALID_BOOK_FORMAT', 3);
	define('_ERROR_BOOK_COVER_DOES_NOT_EXISTS', 4);
	define('_ERROR_MAX_NUMBER_OF_AUTHORS_REACHED', 5);	// That's a WARNING not a proper error
	define('_ERROR_INCORRECT_PARAMETER_TYPE', 6);
	define('_ERROR_MAX_NUMBER_OF_CONTRIBUTORS_REACHED', 7);	// That's a WARNING not a proper error
	define('_ERROR_TEST_ERROR_NUMBER_DIFFERENT_FROM_WHAT_EXPECTED', 8);
	define('_ERROR_MAX_NUMBER_OF_ADDITIONAL_INFO_REACHED', 9);	// That's a WARNING not a proper error
	define('_ERROR_INVALID_BOOK_LENGTH', 10);
	define('_ERROR_EMPTY_BOOK_CATEGORY', 11);
	define('_ERROR_EMPTY_BOOK_CATEGORY_FS_PATH', 12);
	define('_ERROR_CATEGORY_DIRECTORY_IS_NOT_A_DIRECTORY', 13);

	/**
	 *
	 * Errors texts list. It contains an error title and an error description for each error that is catched in the code.
	 * Array, format: [Title, Description]
	 *
	 */
	
	define('_ERRORS_TEXTS', array([
									"No error occurred",
	 								"No error occurred."
	 							],
								[
									"Assuming that an error occurred",
		 							"I'm assuming that an error occurred but no errors really occurred yet.\nThat is a safe check meaned to be a remind that there is always an error in the code and to avoid security falls or malfunctions we need to prevent to execute undesired parts of code."
		 						],
								[
									"Empty book title",
		 							"During the loading of books a book with an empty title was found."
		 						],
								[
									"Invalid book format",
		 							"The software found a book download url which links to an undefined book format. Supported book formats are the following: ".implode(", ",_BOOK_FILE_FORMATS_SUPPORTED)
		 						],
								[
									"Book cover does not exist on disk",
		 							"The book cover defined does not exists on disk (in future it will be possibile to retrive images from the internet and this error message will be fixed)"
		 						],
								[
									"Maximum number of authors for a book reached",
		 							"Too much authors for the book were specified so an error is raised. A book can have a max number of authors of "._BOOK_AUTHORS_MAX_NUMBER_ACCEPTED.". That is made to avoid eating all memory when we have a lot of books with a lot of authors. This is treated as a warning and not an error. A number of 20 authors is loaded, all the others are rejected"
		 						],
		 						[
									"Incorrect parameter type",
		 							"That's a code level error. A parameter with a wrong type was passed to a method or a function. See the error you get in log for more details."
		 						],
								[
									"Maximum number of contributors for a book reached",
		 							"Too much contributors for the book were specified so an error is raised. A book can have a max number of contributors of "._BOOK_CONTRIBUTORS_MAX_NUMBER_ACCEPTED.". That is made to avoid eating all memory when we have a lot of books with a lot of contributors. This is treated as a warning and not an error. A number of 1000 contributors is loaded, all the others are rejected"
		 						],
								[
									"The test error number is different from what the test was expecting",
		 							"The test returned an error code different from what the test was expecting."
		 						],
								[
									"Maximum number of additional info for a book reached",
		 							"Too much additional info for the book were specified so an error is raised. A book can have a max number of additional info of "._BOOK_ADDITIONAL_INFO_MAX_NUMBER_ACCEPTED.". That is made to avoid eating all memory when we have a lot of books with a lot of additional info. This is treated as a warning and not an error. A number of 1000 additional info is loaded, all the others are rejected"
		 						],
								[
									"Invalid book length",
		 							"An invalid book length was specified. Check your BOOK_INFO.txt file"
		 						],
								[
									"Empty book category name",
		 							"An empty value was passed to define a category which contains books"
		 						],
								[
									"Empty book category fs path",
		 							"An empty value was passed to define the path of the category on the filesystem"
		 						],
								[
									"Category directory is not a directory",
		 							"The category path passed to the category class is not a directory"
		 						],
		));

	/**
	 *
	 * Translates an error code into its string equivalent
	 * Returns				->				string, error code text. "" empty string in case of error
	 *
	 */
	function error_code_to_error_string($error_code){
		$error_text = "";

		if(($error_code >= 0) &&($error_code < count(_ERRORS_TEXTS))){
			$error_text = _ERRORS_TEXTS[$error_code][0]." - "._ERRORS_TEXTS[$error_code][1];
		}

		return $error_text;
	}

	/**
	 *
	 * Translates an error code into its github error url equivalent
	 * Returns				->				string, error code url. "" empty string in case of error
	 *
	 */
	function error_code_to_github_url($error_code){
		$github_error_url = "";

		if(($error_code >= 0) &&($error_code < count(_ERRORS_TEXTS))){
			// #error-code-0---assuming-that-an-error-occurred
			$github_error_url = _GITHUB_REPOSITORY_URL."#error-code-".$error_code."---".strtolower(str_replace(" ", "-", _ERRORS_TEXTS[$error_code][0]));
		}

		return $github_error_url;
	}