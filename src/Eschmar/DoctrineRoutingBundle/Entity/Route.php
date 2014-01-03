<?php

namespace Eschmar\DoctrineRoutingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity
 */
class Route
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="defaults_controller", type="string", length=255)
     */
    private $defaultsController;

    /**
     * @var string
     *
     * @ORM\Column(name="defaults_format", type="string", length=255, nullable=true)
     */
    private $defaultsFormat;

    /**
     * @var string
     *
     * @ORM\Column(name="req_format", type="string", length=255, nullable=true)
     */
    private $reqFormat;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set defaultsController
     *
     * @param string $defaultsController
     * @return Route
     */
    public function setDefaultsController($defaultsController)
    {
        $this->defaultsController = $defaultsController;

        return $this;
    }

    /**
     * Get defaultsController
     *
     * @return string 
     */
    public function getDefaultsController()
    {
        return $this->defaultsController;
    }

    /**
     * Set defaultsFormat
     *
     * @param string $defaultsFormat
     * @return Route
     */
    public function setDefaultsFormat($defaultsFormat)
    {
        $this->defaultsFormat = $defaultsFormat;

        return $this;
    }

    /**
     * Get defaultsFormat
     *
     * @return string 
     */
    public function getDefaultsFormat()
    {
        return $this->defaultsFormat;
    }

    /**
     * Set reqFormat
     *
     * @param string $reqFormat
     * @return Route
     */
    public function setReqFormat($reqFormat)
    {
        $this->reqFormat = $reqFormat;

        return $this;
    }

    /**
     * Get reqFormat
     *
     * @return string 
     */
    public function getReqFormat()
    {
        return $this->reqFormat;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Route
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set sort
     *
     * @param boolean $sort
     * @return Route
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return boolean 
     */
    public function getSort()
    {
        return $this->sort;
    }
}