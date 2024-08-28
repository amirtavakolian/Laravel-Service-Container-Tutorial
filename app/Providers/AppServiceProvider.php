<?php

namespace App\Providers;

use App\EmailService;
use App\GrammerCheckerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        $emailServicee = new EmailService('a simple title', new GrammerCheckerService()); // traditional way in php pure

        $emailService1 = resolve(EmailService::class, ['title' => 'a simple title']);

        /*
        in traditional form of pure php, we have to create an object from GrammerCheckerService manually
        and pass it to constructor of EmailService.

        but in laravel form, there is no need to pass anything for GrammerCheckerService.

        when laravel service container wants to create an object from EmailService,
        it checks that EmailService constructor has $title parameter & we have pas
        ['title' => 'a simple title'] for it in resolve ==> so, service container passes 'a simple title'
        to EmailService constructor.

        but, for the seconde parameter of EmailService construct, service container sees that it has type hint
        & we haven't pass anything in resolve

        so, first it checks the type of the class to find out if it's a class, interface or abstract
        and if it's a class, it does like this ==> resolve(GrammerCheckerService::class) and pass it to
        EmailService constructor.

        something like this ==> resolve(EmailService::class, ['title' => 'a simple title',
                                                              'grammerCheckerService' => resolve(grammerCheckerService::class)]);

        this process which service container checks EmailService construct's parameters
        and pass the parameters which we have defined in resolve() function,
        and checks the type hint and its type (class, interface, abstract) and create an object from that,
        is called reflection

        */

        // we can even do like this:
        $emailService2 = resolve(EmailService::class, ['title' => 'a simple title', 'grammerCheckerService' => new GrammerCheckerService()]);

        dd($emailService2 == $emailService1);

        // $emailService2 == $emailService1 ==> if objects are from one class and have same amount of properties, it gives true.
    }
}
