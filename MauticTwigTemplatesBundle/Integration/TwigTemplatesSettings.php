<?php

/*
 * @copyright   2020 MTCExtendee. All rights reserved
 * @author      MTCExtendee
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Integration;

use Mautic\PluginBundle\Helper\IntegrationHelper;

class TwigTemplatesSettings
{

    /**
     * @var bool|\Mautic\PluginBundle\Integration\AbstractIntegration
     */
    private $integration;

    private $enabled = false;

    /**
     * @var array
     */
    private $settings = [];

    /**
     * DolistSettings constructor.
     *
     * @param IntegrationHelper $integrationHelper
     */
    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integration = $integrationHelper->getIntegrationObject(TwigTemplatesIntegration::INTEGRATION_NAME);
        if ($this->integration instanceof TwigTemplatesIntegration && $this->integration->getIntegrationSettings(
            )->getIsPublished()) {
            $this->settings = $this->integration->mergeConfigToFeatureSettings();
            $this->enabled = true;
        }
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }


}
