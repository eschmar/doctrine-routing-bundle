<?php

namespace Eschmar\DoctrineRoutingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RouteConfig
 *
 * @ORM\Table(name="route_config")
 * @ORM\Entity
 */
class RouteConfig
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
     * @ORM\ManyToOne(targetEntity="Route", inversedBy="config")
     **/
    private $route;

    /**
     * @var smallint
     *
     * @ORM\Column(name="type", type="smallint", options={"comment" = "0=defaults,1=req,2=options"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

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
     * Set type
     *
     * @param integer $type
     * @return RouteConfig
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return RouteConfig
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
     * Set value
     *
     * @param string $value
     * @return RouteConfig
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set route
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\Route $route
     * @return RouteConfig
     */
    public function setRoute(\Eschmar\DoctrineRoutingBundle\Entity\Route $route = null)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \Eschmar\DoctrineRoutingBundle\Entity\Route 
     */
    public function getRoute()
    {
        return $this->route;
    }
}
