<?php

namespace App\Http\Controllers;

use Log;
use App\GitService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GitController extends Controller{

	private $gitService;

	public function __construct(GitService $gitService){
		$this->gitService = $gitService;
	}

	public function getGitData(){	
		return $this->gitService->getGitData();
	}
}