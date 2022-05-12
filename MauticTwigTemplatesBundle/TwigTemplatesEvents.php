<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle;

final class TwigTemplatesEvents
{

    /**
     * The mautic.twigTemplates_pre_save event is thrown right before a asset is persisted.
     *
     * The event listener receives a
     * MauticPlugin\MauticTwigTemplatesBundle\Event\TwigTemplatesEvent instance.
     *
     * @var string
     */
    const PRE_SAVE = 'mautic.twigTemplates_pre_save';

    /**
     * The mautic.twigTemplates_post_save event is thrown right after a asset is persisted.
     *
     * The event listener receives a
     * MauticPlugin\MauticTwigTemplatesBundle\Event\TwigTemplatesEvent instance.
     *
     * @var string
     */
    const POST_SAVE = 'mautic.twigTemplates_post_save';

    /**
     * The mautic.twigTemplates_pre_delete event is thrown prior to when a asset is deleted.
     *
     * The event listener receives a
     * MauticPlugin\MauticTwigTemplatesBundle\Event\TwigTemplatesEvent instance.
     *
     * @var string
     */
    const PRE_DELETE = 'mautic.twigTemplates_pre_delete';

    /**
     * The mautic.twigTemplates_post_delete event is thrown after a asset is deleted.
     *
     * The event listener receives a
     * MauticPlugin\MauticTwigTemplatesBundle\Event\TwigTemplatesEvent instance.
     *
     * @var string
     */
    const POST_DELETE = 'mautic.twigTemplates_post_delete';

    /**
     * The mautic.twigTemplates.on_campaign_condition_trigger event is dispatched when the campaign sql condition is executed.
     *
     * The event listener receives a      * Mautic\CampaignBundle\Event\CampaignExecutionEvent
     *
     * @var string
     */
    const ON_CAMPAIGN_CONDITION_TRIGGER = 'mautic.twigTemplates.on_campaign_condition_trigger';

}
