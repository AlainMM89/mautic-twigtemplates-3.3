<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'name'        => 'TwigTemplates',
    'description' => 'Twig templates for Mautic',
    'author'      => 'mtcextendee.com',
    'version'     => '1.0.0',
    'services'    => [
        'events'  => [
            'mautic.twigTemplates.asset.subscriber' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\EventListener\AssetSubscriber::class,
                'arguments' => [
                    'mautic.twigTemplates.integration.settings',
                ],
            ],
            'mautic.twigTemplates.builder.subscriber' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\EventListener\BuilderSubscriber::class,
                'arguments' => [
                    'mautic.twigTemplates.helper.token',
                    'mautic.lead.model.lead',
                    'mautic.twigTemplates.twig.render',
                    'mautic.page.model.trackable',
                    'mautic.page.model.redirect',
                    'mautic.helper.token_builder.factory',
                ],
            ],
        ],
        'forms'   => [
            'mautic.twigTemplates.form.campaign.type' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Form\Type\SqlListType::class,
                'arguments' => [
                ],
            ],
            'mautic.twigTemplates.form.list.type'     => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Form\Type\TwigTemplatesCampaignType::class,
                'arguments' => 'router',
                'alias'     => 'twigtemplates_list',
            ],
        ],
        'command' => [
        ],
        'other'   => [
            'mautic.twigTemplates.twig.render' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Service\TwigRender::class,
                'arguments' => [
                    'twig',
                ],
            ],

            'mautic.twigTemplates.contact.search'  => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Service\ContactSearch::class,
                'arguments' => [
                    'request_stack',
                    'mautic.helper.cookie',
                    'form.factory',
                    'router',
                    'mautic.lead.model.lead',
                ],
            ],

            'mautic.twigTemplates.helper.token'         => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Helper\TokenHelper::class,
                'arguments' => [
                    'mautic.twigTemplates.model.twigTemplates',
                ],
            ],
            'mautic.twigTemplates.integration.settings' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Integration\TwigTemplatesSettings::class,
                'arguments' => [
                    'mautic.helper.integration',
                ],
            ],
        ],

        'helpers'      => [],
        'models'       => [
            'mautic.twigTemplates.model.twigTemplates' => [
                'class' => \MauticPlugin\MauticTwigTemplatesBundle\Model\TwigTemplatesModel::class,
            ],
        ],
        'integrations' => [
            'mautic.integration.twigtemplates' => [
                'class'     => \MauticPlugin\MauticTwigTemplatesBundle\Integration\TwigTemplatesIntegration::class,
                'arguments' => [
                    'event_dispatcher',
                    'mautic.helper.cache_storage',
                    'doctrine.orm.entity_manager',
                    'session',
                    'request_stack',
                    'router',
                    'translator',
                    'logger',
                    'mautic.helper.encryption',
                    'mautic.lead.model.lead',
                    'mautic.lead.model.company',
                    'mautic.helper.paths',
                    'mautic.core.model.notification',
                    'mautic.lead.model.field',
                    'mautic.plugin.model.integration_entity',
                    'mautic.lead.model.dnc',
                ],
            ],
        ],
    ],
    'routes'      => [
        'main' => [
            'mautic_twigTemplates_index'  => [
                'path'       => '/twigTemplates/{page}',
                'controller' => 'MauticTwigTemplatesBundle:TwigTemplates:index',
            ],
            'mautic_twigTemplates_action' => [
                'path'       => '/twigTemplates/{objectAction}/{objectId}',
                'controller' => 'MauticTwigTemplatesBundle:TwigTemplates:execute',
            ],
        ],
        'api' => [
            'mautic_api_twigTemplatestandard' => [
                'standard_entity' => true,
                'name'            => 'twigTemplates',
                'path'            => '/twigTemplates',
                'controller'      => 'MauticTwigTemplatesBundle:Api\TwigTemplatesApi',
            ],
        ],
    ],
    'menu'        => [
        'main' => [
            'items' => [
                'mautic.twigTemplates' => [
                    'route'     => 'mautic_twigTemplates_index',
                    'priority'  => 49,
                    'iconClass' => 'fa fa-file-code-o',
                    'checks'    => [
                        'integration' => [
                            'TwigTemplates' => [
                                'enabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'categories'  => [
        'plugin:twigTemplates' => 'mautic.twigTemplates',
    ],
];
