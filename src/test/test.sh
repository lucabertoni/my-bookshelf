#!/bin/bash

log_file_path="/var/log/my-bookshelf/error.log"
github_repo_url="https://github.com/lucabertoni/my-bookshelf"

clear

printf "! my-bookshelf Test script !"
printf "\- Starting tests\nLogs can be found in $log_file_path. Please check that the user who is executing this tests has read/write permissions on that file.\n"

number_of_tests=$( ls *_test.php | wc -l)

number_of_executed_tests=0

for test_file in $( ls *_test.php ); do
	number_of_test=$((number_of_executed_tests+1))

    printf "\nRunning test "\'$test_file\'" ($number_of_test/$number_of_tests)\n"

    php $test_file

    rc=$?
    if [[ rc -ne 0 ]]; then
    	printf "Error occurred while testing $test_file. Error code: $rc. Check documentation at $github_repo_url#error-codes\n"
    	break
    fi
    
	number_of_executed_tests=$((number_of_executed_tests+1))
    
done

printf "I'm done.\nTotal number of tests: $number_of_tests\nNumber of successfully executed tests: $number_of_executed_tests\n"