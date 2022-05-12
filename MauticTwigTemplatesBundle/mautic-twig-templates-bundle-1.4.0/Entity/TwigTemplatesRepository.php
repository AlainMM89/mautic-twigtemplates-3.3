<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class TwigTemplatesRepository
 * @package MauticPlugin\MauticTwigTemplatesBundle\Entity
 */
class TwigTemplatesRepository extends CommonRepository
{
    /**
     * @param $alias
     *
     * @return object|null
     */
    public function findOneByAlias($alias)
    {
        return parent::findOneBy(['alias'=>$alias], null);
    }

    /**
     * Get a list of entities.
     *
     * @param array $args
     *
     * @return Paginator
     */
    public function getEntities(array $args = [])
    {
        $alias = $this->getTableAlias();

        $q = $this->_em
            ->createQueryBuilder()
            ->select($alias)
            ->from('MauticTwigTemplatesBundle:TwigTemplates', $alias, $alias.'.id');

        if (empty($args['iterator_mode'])) {
            $q->leftJoin($alias.'.category', 'c');
        }

        $args['qb'] = $q;

        return parent::getEntities($args);
    }

}
