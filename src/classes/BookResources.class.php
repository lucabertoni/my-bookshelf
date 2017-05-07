<?php
	require_once '../lib/errors.php';
	require_once '../lib/defs.php';
	
	/**
	* This defines the book authors context
	*/
	class BookResources
	{
		private $book_resources = /*assoc*/array('PDF' => '', 'EPUB' => '', 'ZIP' => '','RAR' => '','TGZ' => '', 'PostScript' => '', 'RTF' => '');

		private $error_no = _ERROR_NO_ERROR;

		// [Format, url/path to resource, ...]
		function __construct(...$resources)
		{
			$this->addResources($resources);
		}

		/**
		 *
		 * It adds an resource to the resources list.
		 * If the resource list has reached its max number of elements an error code is properly setted to _ERROR_INVALID_BOOK_FORMAT
		 * 
		 * resource_format			->				string, format of the resource
		 * resource_location		->				string, location (path/url) of the resource
		 * 
		 * Return					->				bool, true = resource added | false = Limit reached, resource not added
		 */
		
		private function addResource($resource_format, $resource_location)
		{
			$resource_added = false;

			if(in_array($resource_format, _BOOK_FILE_FORMATS_SUPPORTED)){
				$book_resources[$resource_format] = $resource_location;
			}else{
				$this->error_no = _ERROR_INVALID_BOOK_FORMAT;
			}
			return $resource_added;

		}

		private function addResources($resources)
		{
			$end = count($resources);
			if(($end % 2) == 0){
				for ($i=0; $i < $end; $i+=2) { 
					if(!($this->addResource($resources[$i],$resources[$i + 1]))){
						if($this->error_no == _ERROR_INVALID_BOOK_FORMAT){
							MB_LOG(_LOG_LEVEL_ERROR, "BookResources -> addResources -> Invalid book format ".$resources[$i], true);
						}

						break;
					}
				}
			}else{
				MB_LOG(_LOG_LEVEL_ERROR, "BookAdditionalInfo -> addAdditionalInfos -> Invalid parameter format. The array should be defined as ['Book format','resource path/url']", true);

				$this->error_no = _ERROR_INCORRECT_PARAMETER_TYPE;
			}
		}

		public function getBookResources()
		{
			return $this->$book_authors;
		}

		public function getErrorNo(){
			return $this->error_no;
		}
	}