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

	/**
	 *
	 * Errors texts list. It contains an error title and an error description for each error that is catched in the code.
	 * Array, format: [Title, Description]
	 *
	 */
	
	define('_ERRORS_TEXTS', array(["No error occurred","No error occurred."],
		["Assuming that an error occurred","I'm assuming that an error occurred but no errors really occurred yet.\nThat is a safe check meaned to be a remind that there is always an error in the code and to avoid security falls or malfunctions we need to prevent to execute undesired parts of code."],
		["Empty book title", "During the loading of books a book with an empty title was found."],
		["Invalid book format", "The software found a book download url which links to an undefined book format. Supported book formats are the following: ".implode(_BOOK_FILE_FORMATS_SUPPORTED)],
		["Book cover does not exist on disk", "The book cover defined does not exists on disk (in future it will be possibile to retrive images from the internet and this error message will be fixed)"],
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
			$github_error_url = _GITHUB_REPOSITORY_URL."#error-code-".$error_code."---".str_replace(" ", "-", _ERRORS_TEXTS[$error_code][0]);
		}

		return $github_error_url;
	}