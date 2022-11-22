<?php

namespace App\Service;

use App\Entity\Agent;

class DuplicateService
{
    public function handleAgent(Agent $agent) {
        $newAgent = clone $agent;
        return $newAgent;
    }
}