<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Party;

class UniqueExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('unique', array($this, 'uniqueFilter')),
        );
    }

    /**
     * @param Party[] $parties
     * @return array
     */
    public function uniqueFilter(array $parties)
    {
        return array_map(function (Party $party) {
            return $party->getCity();
        }, $parties);
    }

    public function getName()
    {
        return 'unique_extension';
    }
}