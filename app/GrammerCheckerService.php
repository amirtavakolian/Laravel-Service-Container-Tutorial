<?php

namespace App;

class GrammerCheckerService
{
    public function __construct(private string $token, ChatgptService $chatgptService)
    {
    }
}
