<?php

use Illuminate\Support\Facades\Route;


class Service
{
    public function run()
    {
        echo "service is running...";
    }
}


Route::get('/', function (Service $service) {
    dd($service);
});

// if you run above code, dd($service) will not give any error because
// service container will look at the parameter of the clouser and find out that it has a dependency to Service class

// so, service container, will create an instance/object from the Service class
// then inject it to the clouser (dependency injection)

// ====================================================================

$func = function (Service $service) {
    $service->run();
};

// if you run above code in pure php, you will get an error .
// because there is no service container in pure php by default

// so, you should directly/manually create an object from Service class
// then, inject it to the clouser manually.

// ==================================================================

/*
the clouser has only one dependency

imagin you have a class or method with 5 dependencies.
so you have to create object from them manually and inject them

but, what if you create objects manually in diffrent places in your proejct and then,
one of the dependencies changes?

when you need a pen, you get it from the factory - store,
you will not struggle with the process of creating a pen :D

----------------------------------------------

so, use service container and do not struggle with process of making objects

you can even put the process of making objects in service container,
then ask for the object from that (resolve)

*/

// this is only one of the things that we can do with Service Container.
