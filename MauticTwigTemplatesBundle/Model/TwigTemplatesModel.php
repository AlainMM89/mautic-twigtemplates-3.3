<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Model;

use Mautic\CoreBundle\Model\AjaxLookupModelInterface;
use Mautic\CoreBundle\Model\FormModel;
use MauticPlugin\MauticRecommenderBundle\Entity\RecommenderTemplateRepository;
use MauticPlugin\MauticTwigTemplatesBundle\Entity\TwigTemplates;
use MauticPlugin\MauticTwigTemplatesBundle\Entity\TwigTemplatesRepository;
use MauticPlugin\MauticTwigTemplatesBundle\Event\TwigTemplatesEvent;
use MauticPlugin\MauticTwigTemplatesBundle\Form\Type\TwigTemplatesType;
use MauticPlugin\MauticTwigTemplatesBundle\TwigTemplatesEvents;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class TwigTemplatesModel extends FormModel implements AjaxLookupModelInterface
{

    /**
     * Retrieve the permissions base.
     *
     * @return string
     */
    public function getPermissionBase()
    {
        return 'twigTemplates:twigTemplates';
    }

    /**
     * {@inheritdoc}
     *
     * @return TwigTemplatesRepository
     */
    public function getRepository()
    {
        /** @var RecommenderTemplateRepository $repo */
        $repo = $this->em->getRepository('MauticTwigTemplatesBundle:TwigTemplates');

        $repo->setTranslator($this->translator);

        return $repo;
    }

    /**
     * Here just so PHPStorm calms down about type hinting.
     *
     * @param null $id
     *
     * @return null|TwigTemplates
     */
    public function getEntity($id = null)
    {
        if ($id === null) {
            return new TwigTemplates();
        }

        return parent::getEntity($id);
    }

    /**
     * {@inheritdoc}
     *
     * @param       $entity
     * @param       $formFactory
     * @param null  $action
     * @param array $options
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function createForm($entity, $formFactory, $action = null, $options = [])
    {
        if (!$entity instanceof TwigTemplates) {
            throw new \InvalidArgumentException('Entity must be of class Event');
        }

        if (!empty($action)) {
            $options['action'] = $action;
        }

        return $formFactory->create(TwigTemplatesType::class, $entity, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param $action
     * @param $entity
     * @param $isNew
     * @param $event
     *
     * @throws \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
    protected function dispatchEvent($action, &$entity, $isNew = false, \Symfony\Component\EventDispatcher\Event $event = null)
    {
        if (!$entity instanceof TwigTemplates) {
            throw new MethodNotAllowedHttpException(['TwigTemplates']);
        }

        switch ($action) {
            case 'pre_save':
                $name = TwigTemplatesEvents::PRE_SAVE;
                break;
            case 'post_save':
                $name = TwigTemplatesEvents::POST_SAVE;
                break;
            case 'pre_delete':
                $name = TwigTemplatesEvents::PRE_DELETE;
                break;
            case 'post_delete':
                $name = TwigTemplatesEvents::POST_DELETE;
                break;
            default:
                return null;
        }

        if ($this->dispatcher->hasListeners($name)) {
            if (empty($event)) {
                $event = new TwigTemplatesEvent($entity, $isNew);
                $event->setEntityManager($this->em);
            }

            $this->dispatcher->dispatch($name, $event);

            return $event;
        } else {
            return null;
        }
    }

    /**
     * @param        $type
     * @param string $filter
     * @param int    $limit
     * @param int    $start
     * @param array  $options
     *
     * @return array|mixed
     */
    public function getLookupResults($type, $filter = '', $limit = 10, $start = 0, $options = [])
    {
        $results = [];
        switch ($type) {
            case 'twigTemplates':
                $entities = $this->getRepository()->getSimpleList();

                foreach ($entities as $entity) {
                    $results[$entity['value']] = $entity['label'];
                }

                //sort by language
                ksort($results);

                break;
        }

        return $results;
    }

}
