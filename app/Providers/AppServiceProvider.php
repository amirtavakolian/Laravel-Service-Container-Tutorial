<?php

namespace App\Providers;

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
        One of the thing which we can do with service container (one of the features of service container)
        is creating objects.

        So whenever we need to create objects from any class, we can use service container.

        service container is a tool for managing the dependencies of the classes + performing dependency injection
        So we don't need to  inject the dependencies of the classes manually anymore.

        first, we should define a string
        then a class which we want to make object from it or a closure

        When we resolve that a string, that closure should be ran
        or an object from that class should be created

        so there is no need to use new keyword for making objects (creating objects manually)

        just like an object creation factory.
        ==> service container is the implementation of factory method design pattern

        we can even use the if, else, query to database & etc... before creating objects in the clousers

        ====================================================================

        # When to use service container?

        when u have a lot of dependecies in your project,
        for managing these dependecies, u can use service container.

        for not having duplicated codes
        and codes not get crowded we can use service container

        ---------------------------------------------------

        when making object from a class, needs several
        oprations before creating the object, u can use service container
        to prevent repeating this oprations.

        Ex: log something before making an object

*/
    }
}
