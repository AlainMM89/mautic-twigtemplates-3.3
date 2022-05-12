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

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;
use Mautic\ApiBundle\Serializer\Driver\ApiMetadataDriver;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\FormEntity;


class TwigTemplates extends FormEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \Mautic\CategoryBundle\Entity\Category
     **/
    private $category;


    /**
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @var string
     */
    protected $name;

    /*
     * @vart string
     */
    protected $template;

    /**
     * @var string
     */
    protected $description;


    public function __construct()
    {
        $this->setDateAdded(new \DateTime());
    }

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata(ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('twig_templates')
            ->setCustomRepositoryClass(TwigTemplatesRepository::class);
        $builder->addIdColumns('name');
        $builder->addNamedField('template', Type::TEXT, 'template');
        $builder->addCategory();
    }


    /**
     * Prepares the metadata for API usage.
     *
     * @param $metadata
     */
    public static function loadApiMetadata(ApiMetadataDriver $metadata)
    {
        $metadata->setGroupPrefix('twigTemplates')
            ->addListProperties(
                [
                    'id',
                    'name',
                    'description',
                    'template',
                    'category',
                    'dateAdded',
                ]
            )
            ->build();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * Set dateAdded.
     *
     * @param \DateTime $dateAdded
     *
     * @return LeadEventLog
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded.
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }


    public function getCreatedBy()
    {

    }

    public function getHeader()
    {

    }

    public function getPublishStatus()
    {

    }

    /**
     * @param string $name
     *
     * @return TwigTemplates
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Mautic\CategoryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Mautic\CategoryBundle\Entity\Category $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param mixed $template
     *
     * @return TwigTemplates
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $description
     *
     * @return TwigTemplates
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
}

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
