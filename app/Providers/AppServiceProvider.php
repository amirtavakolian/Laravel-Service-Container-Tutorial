<?php

namespace App\Providers;

use App\EmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $emailService1 = new EmailService(); // traditional way of making object

        // resolve() ==> Resolve a service from the service container.

        $emailService2 = resolve(EmailService::class); // using service container to create an object

        $emailService3 = resolve('App\EmailService');

        // service container's responsibility is creating object (like a factory)
        // resolve() function asks the container for an object & return it

        /*
          Ex:
          a doctor asks his/her assistant (resolve()) to pas him a tool
          there is a box which contains several tools (service container)
          assistant checks the box and get the tool (object) and return it to the doctor
        */

        dd(
            $emailService1 == $emailService2
            &&
            $emailService2 == $emailService3
            &&
            $emailService1 == $emailService3
        );
    }
}
