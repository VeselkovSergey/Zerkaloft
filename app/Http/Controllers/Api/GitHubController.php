<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class GitHubController extends ApiController
{
    public function Push(Request $request)
    {
        echo 'git pull start' . PHP_EOL;
        // chmod 600 /var/www/.ssh/ida_rsa
        echo shell_exec('git pull');
        echo 'git pull complete' . PHP_EOL;
    }
}
