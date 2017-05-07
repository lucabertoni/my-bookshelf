<?php
	require_once '../lib/errors.php';
	require_once '../lib/defs.php';

	
	/**
	* This defines the book additional_info_array_ context
	*/
	class BookAdditionalInfo
	{
		/* [["Additional_info_title1" => "Additional_info1"], ...] */
		private $book_additional_info_array = array();

		private $error_no = _ERROR_NO_ERROR;

		/*
			[Additional_info_title1, Additional_info1, Additional_info_title2, Additional_info2, ...]
		*/
		function __construct(...$additional_info_array_names)
		{
			$this->addAdditionalInfos($additional_info_array_names);
		}

		/**
		 *
		 * It adds an additional info to the additional_info_array_ list.
		 * If the additional info list has reached its max number of elements an error code is properly setted to _ERROR_MAX_NUMBER_OF_ADDITIONAL_INFO_REACHED
		 * 
		 * additional_info_title				->				string, additional_info title
		 * additional_info_description			->				string, additional_info description
		 * 
		 * Return					->				bool, true = additional_info added | false = Limit reached, additional_info not added
		 */
		private function addAdditionalInfo($additional_info_title, $additional_info_description)
		{
			$additional_info_added = false;

			if((count($this->book_additional_info_array) + 1) <= _BOOK_ADDITIONAL_INFO_MAX_NUMBER_ACCEPTED){
				array_push($this->book_additional_info_array, array($additional_info_title => $additional_info_description));

				$additional_info_added = true;
			}else{
				$this->error_no = _ERROR_MAX_NUMBER_OF_ADDITIONAL_INFO_REACHED;
			}

			return $additional_info_added;

		}

		private function addAdditionalInfos($additional_info_array)
		{
			$end = count($additional_info_array);

			if(($end % 2) == 0){
				for ($i=0; $i < $end; $i+=2) { 
					if(!($this->addAdditionalInfo($additional_info_array[$i],$additional_info_array[$i + 1]))){
						if($this->error_no == _ERROR_MAX_NUMBER_OF_ADDITIONAL_INFO_REACHED){
							MB_LOG(_LOG_LEVEL_WARNING, "BookAdditionalInfo -> addAdditionalInfos -> Max number of additional info reached for the book", true);
						}

						break;
					}
				}
			}else{
				MB_LOG(_LOG_LEVEL_ERROR, "BookAdditionalInfo -> addAdditionalInfos -> Invalid parameter format. The array should be defined as ['Additional info title','Additional info description']", true);

				$this->error_no = _ERROR_INCORRECT_PARAMETER_TYPE;
			}
		}

		public function getBookAdditionalInfo()
		{
			return $this->$book_additional_info_array;
		}

		public function getErrorNo(){
			return $this->error_no;
		}
	}