<?php
	require_once '../lib/errors.php';
	require_once '../lib/defs.php';
	
	/**
	* This defines the book contributors context
	*/
	class BookContributors
	{
		private $book_contributors = array();

		private $error_no = _ERROR_NO_ERROR;

		function __construct(...$contributors_names)
		{
			$this->addContributors($contributors_names);
		}

		/**
		 *
		 * It adds an contributor to the contributors list.
		 * If the contributor list has reached its max number of elements an error code is properly setted to _ERROR_MAX_NUMBER_OF_CONTRIBUTORS_REACHED
		 * 
		 * contributor_name				->				string, contributor name to add to the list
		 * 
		 * Return					->				bool, true = contributor added | false = Limit reached, contributor not added
		 */
		
		private function addContributor($contributor_name)
		{
			$contributor_added = false;

			if((count($this->book_contributors) + 1) <= _BOOK_CONTRIBUTORS_MAX_NUMBER_ACCEPTED){
				array_push($this->book_contributors, $contributor_name);

				$contributor_added = true;
			}else{
				$this->error_no = _ERROR_MAX_NUMBER_OF_CONTRIBUTORS_REACHED;
			}

			return $contributor_added;

		}

		private function addContributors($contributors)
		{
			foreach ($contributors as $contributor) {
				if(!($this->addContributor($contributor))){
					if($this->error_no == _ERROR_MAX_NUMBER_OF_CONTRIBUTORS_REACHED){
						MB_LOG(_LOG_LEVEL_WARNING, "Bookcontributors -> addContributors -> Max number of contributors reached for the book", true);
					}

					break;
				}
			}
		}

		public function getBookcontributors()
		{
			return $this->$book_contributors;
		}

		public function getErrorNo(){
			return $this->error_no;
		}
	}