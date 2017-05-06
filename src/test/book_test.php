<?php
	require_once '../classes/Book.class.php';

	require_once '../lib/log.php';
	require_once '../lib/errors.php';

	$error_code = _ERROR_ASSUMING_AN_ERROR_OCCURRED;

	define('_TEST_NAME', 'Book class test');

	/*
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
	$tests = array(
					[
					'test_description' => 'Basic Book class object creation',
					'expected_return_code' => _ERROR_NO_ERROR,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													["Author1","Author2"],
													"Journals",
													"123456A234B234",
													"resources/book_cover.png",
													"Description of the book",
													["Contributor 1","Contributor 2"],
													["amazon_book_link" => "www.test.etc"],
													"Book notes",
													["PDF" => "lol.pdf"]
												]
					]
				);

	MB_LOG(_LOG_LEVEL_INFO, "Starting test '"._TEST_NAME."'", true);
	MB_LOG(_LOG_LEVEL_INFO, "Number of tests: ".count($tests), true);
	
	$number_of_successful_tests = 0;

	foreach ($tests as $key => $test) {
		MB_LOG(_LOG_LEVEL_INFO, "Running test no. ".(intval($number_of_successful_tests) + 1)." - ".$test["test_description"], true);

		$oBook = new Book(
									$test['book_object_parameters'][0],
									$test['book_object_parameters'][1],
									$test['book_object_parameters'][2],
									$test['book_object_parameters'][3],
									$test['book_object_parameters'][4],
									$test['book_object_parameters'][5],
									$test['book_object_parameters'][6],
									$test['book_object_parameters'][7],
									$test['book_object_parameters'][8],
									$test['book_object_parameters'][9],
									$test['book_object_parameters'][10]
								);

		$book_error_no = $oBook->getErrorNo();

		if(!($test['expected_return_code'] == $book_error_no)){
			$error_code = $book_error_no;

			MB_LOG(_LOG_LEVEL_ERROR, "Test no. ".$key." failed.\nExpected error no.: ".$test['expected_return_code']."\nDetected error no.: ".$book_error_no."\nError no. ".$book_error_no." description: ".error_code_to_error_string($book_error_no)."\n Error no. ".$book_error_no." GitHub url: ".error_code_to_github_url($book_error_no)."\nAborting.\n", true);

			break;
		}

		$number_of_successful_tests += 1;
	}

	$error_code = $error_code == _ERROR_ASSUMING_AN_ERROR_OCCURRED ? _ERROR_NO_ERROR : $error_code;

	MB_LOG(_LOG_LEVEL_INFO, "Number of successfully completed tests: ".$number_of_successful_tests, true);

	$exit_message = $error_code == _ERROR_NO_ERROR ? "Test '"._TEST_NAME."' executed successfully\n" : "Error(s) occurred while testing.\n";

	$log_level = $error_code == _ERROR_NO_ERROR ? _LOG_LEVEL_INFO : _LOG_LEVEL_ERROR;

	MB_LOG($log_level, $exit_message, true);

	exit($error_code);
?>