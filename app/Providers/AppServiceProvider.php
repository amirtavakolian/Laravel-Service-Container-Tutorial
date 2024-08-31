<?php

namespace App\Providers;

use App\ChatgptGrammerCheckerService;
use App\EmailService;
use App\IGrammerChecker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        if you have classes which get parameter from string or should read data from config,

        Ex: $user, $pass from constructor
            read token from config or ENV for connecting to sms or payment gateway
            query to database to get data
            & etc...

        here we should pass clouser to function ==> write the codes of getting data from database
        or read data from config, ENV etc... in that clouser
        finally we create an object and return it.

        */

        app()->bind('chatgpt', function (){
            // read from config
            // query to database
            // read from env
            // etc...
            return new ChatgptGrammerCheckerService('random-token');
        });

        app()->singleton('chatgpt', function (){
            return new ChatgptGrammerCheckerService('random-token');
        });

        dd(resolve('chatgpt'));

        // imagine you have wrote 5 6 lines of code to get an object from a class
        // and you have repeated it several times in your codes
        // you can put those 5 6 lines of code in above clouser and just resolve it.

    }
}
