<?php
	require_once '../classes/Book.class.php';
	require_once '../classes/BookAuthors.class.php';
	require_once '../classes/BookContributors.class.php';
	require_once '../classes/BookAdditionalInfo.class.php';
	require_once '../classes/BookResources.class.php';

	require_once '../lib/log.php';
	require_once '../lib/errors.php';
	require_once '../lib/defs.php';

	MB_LOG(_LOG_LEVEL_DEBUG, "Initializing constants and basic variables needed", true);

	$error_code = _ERROR_ASSUMING_AN_ERROR_OCCURRED;


	define('_TEST_NAME', 'Book class test');

	/*============================================
	=            Object creation test            =
	============================================*/
	/**
	 *
	 * In tests where you find a _TEST_OBJECT definition you need to put the class name in the
	 * constant value and include the correct php file which contains its definition.
	 *
	 */
	$_TEST_OBJECT = "Book";

	$book_contributor_test_array = array();
	for ($i=0; $i <= _BOOK_CONTRIBUTORS_MAX_NUMBER_ACCEPTED; $i++) { 
		array_push($book_contributor_test_array, "Contributor$i");
	}
	
	$tests = array(
					[
					'test_description' => 'Basic Book class object creation',
					'expected_return_code' => _ERROR_NO_ERROR,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													new BookAuthors("Author1", "Author2"),
													"Journals",
													"123456A234B234",
													"resources/book_cover.png",
													"Description of the book",
													new BookContributors("Contributor 1","Contributor 2"),
													new BookAdditionalInfo("amazon_book_link", "www.test.etc"),
													"Book notes",
													new BookResources("PDF", "lol.pdf")
												]
					],
					[
					'test_description' => 'Basic Book class object creation; Wrong cover image path',
					'expected_return_code' => _ERROR_BOOK_COVER_DOES_NOT_EXISTS,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													new BookAuthors("Author1", "Author2"),
													"Journals",
													"123456A234B234",
													"resources/wrong_path",
													"Description of the book",
													new BookContributors("Contributor 1","Contributor 2"),
													new BookAdditionalInfo("amazon_book_link", "www.test.etc"),
													"Book notes",
													new BookResources("PDF", "lol.pdf")
												]
					],
					[
					'test_description' => 'Basic Book class object creation; Exceed max book number of authors',
					'expected_return_code' => _ERROR_MAX_NUMBER_OF_AUTHORS_REACHED,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													new BookAuthors(
														"Author1", "Author2","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN"
														),
													"Journals",
													"123456A234B234",
													"resources/book_cover.png",
													"Description of the book",
													new BookContributors("Contributor 1","Contributor 2"),
													new BookAdditionalInfo("amazon_book_link", "www.test.etc"),
													"Book notes",
													new BookResources("PDF", "lol.pdf")
												]
					],
					[
					'test_description' => 'Basic Book class object creation; Incorrect parameter type (array is passed instead of BookAuthors object)',
					'expected_return_code' => _ERROR_INCORRECT_PARAMETER_TYPE,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													[
														"Author1", "Author2","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
														"AuthorN","AuthorN","AuthorN","AuthorN"
													],
													"Journals",
													"123456A234B234",
													"resources/book_cover.png",
													"Description of the book",
													new BookContributors("Contributor 1","Contributor 2"),
													new BookAdditionalInfo("amazon_book_link", "www.test.etc"),
													"Book notes",
													new BookResources("PDF", "lol.pdf")
												]
					],
					[
					'test_description' => 'Basic Book class object creation; Exceed max book number of contributors',
					'expected_return_code' => _ERROR_MAX_NUMBER_OF_CONTRIBUTORS_REACHED,
					"book_object_parameters" => [
													"Test book",
													"Test book subt",
													new BookAuthors("Author1", "Author2"),
													"Journals",
													"123456A234B234",
													"resources/book_cover.png",
													"Description of the book",
													new BookContributors(...$book_contributor_test_array),
													new BookAdditionalInfo("amazon_book_link", "www.test.etc"),
													"Book notes",
													new BookResources("PDF", "lol.pdf")
												]
					],
				);

	MB_LOG(_LOG_LEVEL_DEBUG, "Constants and variables initialized to:", true);
	MB_LOG(_LOG_LEVEL_DEBUG, "\$error_code -> $error_code", true);
	MB_LOG(_LOG_LEVEL_DEBUG, "\$_TEST_OBJECT -> ".$_TEST_OBJECT, true);
	MB_LOG(_LOG_LEVEL_DEBUG, "_TEST_NAME -> "._TEST_NAME, true);

	MB_LOG(_LOG_LEVEL_INFO, "Starting test '"._TEST_NAME."'", true);
	MB_LOG(_LOG_LEVEL_INFO, "Number of tests: ".count($tests), true);
	
	$number_of_successful_tests = 0;

	foreach ($tests as $key => $test) {
		$test_number = $number_of_successful_tests + 1;

		MB_LOG(_LOG_LEVEL_INFO, "Running test no. ".$test_number." - ".$test["test_description"], true);

		/**
		
			TODO:
			- The way parameters are passed should be rewritten. At the moment for each test we have to rewrite the parameter sequence. Tried to look at argument unpacking but it unpacks all the array recursively and finding assocarrays it fails. We could also think about rewriting the basic class to have setter methods instead of a constructor. Ideas required here.
		 */
		$oTestObject = new $_TEST_OBJECT(...$test["book_object_parameters"]);

		$test_error_no = $oTestObject->getErrorNo();

		if(!($test['expected_return_code'] == $test_error_no)){
			$error_code = $test_error_no != _ERROR_NO_ERROR ? $test_error_no : _ERROR_TEST_ERROR_NUMBER_DIFFERENT_FROM_WHAT_EXPECTED;

			MB_LOG(_LOG_LEVEL_ERROR, "Test no. ".$test_number." failed.\nExpected error no.: ".$test['expected_return_code']."\nDetected error no.: ".$test_error_no."\nError no. ".$test_error_no." description: ".error_code_to_error_string($test_error_no)."\n Error no. ".$test_error_no." GitHub url: ".error_code_to_github_url($test_error_no)."\nAborting.\n", true);

			break;
		}

		$number_of_successful_tests += 1;
	}
	
	/*=====  End of Object creation test  ======*/

	$error_code = $error_code == _ERROR_ASSUMING_AN_ERROR_OCCURRED ? _ERROR_NO_ERROR : $error_code;

	MB_LOG(_LOG_LEVEL_INFO, "Number of successfully completed tests: ".$number_of_successful_tests, true);

	$exit_message = $error_code == _ERROR_NO_ERROR ? "Test '"._TEST_NAME."' executed successfully\n" : "Error(s) occurred while testing.\n";

	$log_level = $error_code == _ERROR_NO_ERROR ? _LOG_LEVEL_INFO : _LOG_LEVEL_ERROR;

	MB_LOG($log_level, $exit_message, true);

	exit($error_code);
?>