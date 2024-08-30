<?php

namespace App;

class EmailService
{
    public function __construct(private IGrammerChecker $grammerCheckerService)
    {
    }

    public function send()
    {
        echo "sending email...";
    }
}
