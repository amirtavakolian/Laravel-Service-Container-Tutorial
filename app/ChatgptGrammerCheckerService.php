<?php

namespace App;

class ChatgptGrammerCheckerService implements IGrammerChecker
{

    public function __construct(private string $token = "")
    {
        echo 'hello';
    }

    public function spellChecker()
    {
        echo "checking spell";
    }
}
