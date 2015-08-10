<?php
	namespace App;
	class LanguageService {

		public function summarizeLanguages($gitResponse){
			$result = $this->aggregateByLanguage($gitResponse->items);
			$result = $this->languageReduce($result, 3);
			return $this->mapLanguages($result);
		}

		/*
		this function accepts array of git response objects;
		it creates an associative array with languages as keys and counts as values 
		*/
		private function aggregateByLanguage($gitResponseItems) {
			$result = [];
			foreach($gitResponseItems as $item) { 
				if (property_exists($item, "language")) {
					$key = $item->language;
					if (is_null($key)) {
						$key = "No Language Specified";
					}
					if (isset($result[$key])) {
						$result[$key]++;
					} else {
						$result[$key] = 1;
					}
				}
			}
			return $result;
		}

		/*
		this function accepts associative array and returns a derived associative array,
		where values less than $otherThreshold are summed under 'Other' key
		*/
		private function languageReduce($languageArray, $otherThreshold) {
			$result = [];
			foreach ($languageArray as $key => $value) {
				$id = $key; //ToDo: revise this
				if ($value < $otherThreshold) {
					$id = "Other";
				}
				if (isset($result[$id])) {
					$result[$id]+= $value;
				} else {
					$result[$id] = $value;
				}
			}
			return $result;
		}

		/*
		this function converts associative array into the integer indexed array of arrays
		this is useful for data rendering on the front-end
		ToDo: consider using array_map funciton 
		*/
		private function mapLanguages($languageArray) {
			$result = [];
			ksort($languageArray);
			foreach ($languageArray as $key => $value) {
				$result[] = ["label" => $key, "value" => $value];
			}
			return $result;
		}
	}
?>