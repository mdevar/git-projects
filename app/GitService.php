<?php

namespace App;

use Log;
use App\LanguageService;


class GitService {

	private $languageService;

	public function __construct(LanguageService $languageService) {
		$this->languageService = $languageService;
	}

	/*
	this function returns gitHub request results summarized by language
	*/
	public function getGitData() {	
		$gitResponse = $this->getGitProjects(600);
		return $this->languageService->summarizeLanguages($gitResponse);
	}

	/*
	this function makes api call to gitHub 
	*/
	private function getGitProjects($timeInterval) {		
		$callURL = "https://api.github.com/search/repositories";
		$callURL .= "?q=pushed:>" . $this->getTimeCutOff($timeInterval);
		$callURL .= "&sort=updated&order=desc&per_page=100";
		//ToDo: imlement functionality to react to rateLimit;
		//also add options for getting multiple pages and then combining results
		//wasn't able to do multiple pages due to rate limit	
		$gitResponse = $this->callAPI($callURL);
		return json_decode($gitResponse);
	}

	/*
	this function the time $seconds ago 
	*/
	private function getTimeCutOff($seconds) {
		$time_cut_off = time() - $seconds;
		return date("Y-m-d", $time_cut_off) . "T" . date("H:i:s", $time_cut_off);
		//ToDo: add time zone; for now my app timezone is set to UTC
	}

	/*
	helper method to call external API
	*/
	private function callAPI($url) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    		'User-Agent: mdevar'
        ));
		$curl_response = curl_exec($curl);
    	curl_close($curl);
		return $curl_response;
	}
}
?>