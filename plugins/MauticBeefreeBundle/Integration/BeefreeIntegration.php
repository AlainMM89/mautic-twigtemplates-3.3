<?php
/**
 * @package     Mautic
 * @copyright   2020 Enguerr. All rights reserved
 * @author      Enguerr
 * @link        https://www.enguer.com
 * @license     GNU/AGPLv3 http://www.gnu.org/licenses/agpl.html
 */

namespace MauticPlugin\MauticBeefreeBundle\Integration;

use Doctrine\ORM\EntityManager;
use Mautic\CoreBundle\Helper\CacheStorageHelper;
use Mautic\CoreBundle\Helper\EncryptionHelper;
use Mautic\CoreBundle\Helper\PathsHelper;
use Mautic\CoreBundle\Model\NotificationModel;
use Mautic\LeadBundle\Model\CompanyModel;
use Mautic\LeadBundle\Model\DoNotContact as DoNotContactModel;
use Mautic\LeadBundle\Model\FieldModel;
use Mautic\LeadBundle\Model\LeadModel;
use Mautic\PluginBundle\Integration\AbstractIntegration;
use Mautic\CoreBundle\Form\Type\YesNoButtonGroupType;
use Mautic\CoreBundle\Helper\CoreParametersHelper;
use Mautic\PluginBundle\Model\IntegrationEntityModel;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\TranslatorInterface;



class BeefreeIntegration extends AbstractIntegration
{

    public function __construct(EventDispatcherInterface $eventDispatcher, CacheStorageHelper $cacheStorageHelper, EntityManager $entityManager, Session $session, RequestStack $requestStack, Router $router, TranslatorInterface $translator, Logger $logger, EncryptionHelper $encryptionHelper, LeadModel $leadModel, CompanyModel $companyModel, PathsHelper $pathsHelper, NotificationModel $notificationModel, FieldModel $fieldModel, IntegrationEntityModel $integrationEntityModel, DoNotContactModel $doNotContact)
    {
        parent::__construct($eventDispatcher, $cacheStorageHelper, $entityManager, $session, $requestStack, $router,
            $translator, $logger, $encryptionHelper, $leadModel, $companyModel, $pathsHelper, $notificationModel,
            $fieldModel, $integrationEntityModel, $doNotContact);
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'Beefree';
    }

    public function getIcon()
    {
        return 'plugins/MauticBeefreeBundle/Assets/img/icon.png';
    }

    /**
     * @return array
     */
    public function getFormSettings()
    {
        return [
            'requires_callback'      => false,
            'requires_authorization' => false,
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getAuthenticationType()
    {
        return 'none';
    }
    /**
     * {@inheritdoc}
     *
     * @param Form|\Symfony\Component\Form\FormBuilder $builder
     * @param array $data
     * @param string $formArea
     */
    public function appendToForm(&$builder, $data, $formArea)
    {
        if ($formArea == 'features') {
            $builder->add(
                'beefree_user_name',
                TextType::class,
                [
                    'label'      => 'mautic.beefree.config.username',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.api.key.tooltip',
                    ],
                    'empty_data' => ''
                ]
            );
            $builder->add(
                'beefree_api_key',
                TextType::class,
                [
                    'label'      => 'mautic.beefree.config.api.key',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.api.key.tooltip',
                    ],
                    'empty_data' => ''
                ]
            );

            $builder->add(
                'beefree_api_secret',
                TextType::class,
                [
                    'label'      => 'mautic.beefree.config.api.secret',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.api.secret.tooltip',
                    ],
                    'empty_data' => ''
                ]
            );
            $builder->add(
                'beefree_api_key_page',
                TextType::class,
                [
                    'label'      => 'mautic.beefree.config.page.api.key',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.page.api.key.tooltip',
                    ],
                    'empty_data' => ''
                ]
            );
            $builder->add(
                'beefree_api_secret_page',
                TextType::class,
                [
                    'label'      => 'mautic.beefree.config.page.api.secret.page',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.page.api.secret.tooltip',
                    ],
                    'empty_data' => ''
                ]
            );
            $builder->add(
                'beefree_image_get',
                YesNoButtonGroupType::class,
                [
                    'label'      => 'mautic.beefree.config.image.get',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.image.get.tooltip',
                    ],
                    'data' => isset($data['beefree_image_get']) ?
                        (bool) $data['beefree_image_get']
                        : false,
                    'empty_data' => false,
                    'required' => false,
                ]
            );


            $builder->add(
                'beefree_image_get',
                YesNoButtonGroupType::class,
                [
                    'label'      => 'mautic.beefree.config.image.get',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                        'tooltip' => 'mautic.beefree.config.image.get.tooltip',
                    ],
                    'data' => isset($data['beefree_image_get']) ?
                        (bool) $data['beefree_image_get']
                        : false,
                    'empty_data' => false,
                    'required' => false,
                ]
            );
        }
    }
}
