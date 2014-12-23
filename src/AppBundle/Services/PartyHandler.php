<?php

namespace AppBundle\Services;

use AppBundle\Entity\Party;

class PartyHandler
{
    public function checkActive(Party $party)
    {
        if($party->getUsers()->count() >= $party->getMembers()-1) {
            $party->setActive('false');
        }
    }
}
