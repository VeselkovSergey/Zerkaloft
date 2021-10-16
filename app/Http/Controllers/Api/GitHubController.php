<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class GitHubController extends ApiController
{
    public function Push(Request $request)
    {
        shell_exec('git pull');
        echo 'git pull complete' . PHP_EOL;
    }
}
