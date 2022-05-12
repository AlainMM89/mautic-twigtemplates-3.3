<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Event;

use Mautic\CoreBundle\Event\CommonEvent;
use MauticPlugin\MauticTwigTemplatesBundle\Entity\TwigTemplates;

class TwigTemplatesEvent extends CommonEvent
{
    /**
     * TwigTemplatesEvent constructor.
     *
     * @param TwigTemplates $entity
     * @param bool                $isNew
     */
    public function __construct(TwigTemplates $entity, $isNew = false)
    {
        $this->entity = $entity;
        $this->isNew  = $isNew;
    }

    /**
     * @return TwigTemplates
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param TwigTemplates $entity
     */
    public function setEntity(TwigTemplates $entity)
    {
        $this->entity = $entity;
    }
}
