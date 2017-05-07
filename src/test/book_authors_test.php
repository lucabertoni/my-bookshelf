<?php
	require_once '../classes/BookAuthors.class.php';

	require_once '../lib/log.php';
	require_once '../lib/errors.php';

	MB_LOG(_LOG_LEVEL_DEBUG, "Initializing constants and basic variables needed", true);

	$error_code = _ERROR_ASSUMING_AN_ERROR_OCCURRED;


	define('_TEST_NAME', 'BookAuthors class test');

	/*============================================
	=            Object creation test            =
	============================================*/
	/**
	 *
	 * In tests where you find a _TEST_OBJECT definition you need to put the class name in the
	 * constant value and include the correct php file which contains its definition.
	 *
	 */
	$_TEST_OBJECT = "BookAuthors";
	
	$tests = array(
					[
					'test_description' => 'Basic BookAuthors class object creation',
					'expected_return_code' => _ERROR_NO_ERROR,
					"book_object_parameters" => [
													"Author1","Author2",
												]
					],
					[
					'test_description' => 'Basic BookAuthors class object creation; Exceeding max authors number: '._BOOK_AUTHORS_MAX_NUMBER_ACCEPTED.' Authors',
					'expected_return_code' => _ERROR_MAX_NUMBER_OF_AUTHORS_REACHED,
					"book_object_parameters" => [
													"Author1","Author2","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN","AuthorN",
												]
					],
					[
					'test_description' => 'Basic BookAuthors class object creation; Checking authors number limit: '._BOOK_AUTHORS_MAX_NUMBER_ACCEPTED.' Authors',
					'expected_return_code' => _ERROR_NO_ERROR,
					"book_object_parameters" => [
													"Author1","Author2","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN","AuthorN","AuthorN","AuthorN","AuthorN",
													"AuthorN","AuthorN",
												]
					]

				);

	MB_LOG(_LOG_LEVEL_DEBUG, "Constants and variables initialized to:", true);
	MB_LOG(_LOG_LEVEL_DEBUG, "\$error_code -> $error_code", true);
	MB_LOG(_LOG_LEVEL_DEBUG, "\$_TEST_OBJECT -> ".$_TEST_OBJECT, true);
	MB_LOG(_LOG_LEVEL_DEBUG, "_TEST_NAME -> "._TEST_NAME, true);

	MB_LOG(_LOG_LEVEL_INFO, "Starting test '"._TEST_NAME."'", true);
	MB_LOG(_LOG_LEVEL_INFO, "Number of tests: ".count($tests), true);
	
	$number_of_successful_tests = 0;

	foreach ($tests as $key => $test) {
		$test_number = intval($number_of_successful_tests) + 1;

		MB_LOG(_LOG_LEVEL_INFO, "Running test no. ".$test_number." - ".$test["test_description"], true);

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