<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class GitHubController extends ApiController
{
    public function Push(Request $request)
    {
        echo 'Start git pull' . PHP_EOL;
        echo '<pre>'. shell_exec('git pull') .'</pre>';
        echo 'End git pull' . PHP_EOL;
    }

    //test
}
