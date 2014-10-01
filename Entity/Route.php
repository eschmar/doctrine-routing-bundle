<?php

namespace Eschmar\DoctrineRoutingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255, nullable=true)
     */
    private $host;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=255)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=50)
     */
    private $icon;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;

    /**
     * @ORM\OneToMany(targetEntity="RouteConfig", mappedBy="route")
     **/
    private $config;

    /**
     * @ORM\OneToMany(targetEntity="Route", mappedBy="parent")
     * @ORM\OrderBy({"sort" = "ASC"})
     **/
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Route", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     **/
    protected $parent;

    /**
     * @var datetime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_category", type="boolean")
     */
    private $isCategory;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->touch();
    }

    /**
     * @ORM\PreUpdate
     */
    public function touch() {
        $this->setModified(new \DateTime(date('Y-m-d H:i:s')));
    }

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
     * Set host
     *
     * @param string $host
     * @return Route
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return Route
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set sort
     *
     * @param integer $sort
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
     * @return integer 
     */
    public function getSort()
    {
        return $this->sort;
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
     * Set modified
     *
     * @param \DateTime $modified
     * @return Route
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Add config
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\RouteConfig $config
     * @return Route
     */
    public function addConfig(\Eschmar\DoctrineRoutingBundle\Entity\RouteConfig $config)
    {
        $this->config[] = $config;

        return $this;
    }

    /**
     * Remove config
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\RouteConfig $config
     */
    public function removeConfig(\Eschmar\DoctrineRoutingBundle\Entity\RouteConfig $config)
    {
        $this->config->removeElement($config);
    }

    /**
     * Get config
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Add children
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\Route $children
     * @return Route
     */
    public function addChild(\Eschmar\DoctrineRoutingBundle\Entity\Route $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\Route $children
     */
    public function removeChild(\Eschmar\DoctrineRoutingBundle\Entity\Route $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Eschmar\DoctrineRoutingBundle\Entity\Route $parent
     * @return Route
     */
    public function setParent(\Eschmar\DoctrineRoutingBundle\Entity\Route $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Eschmar\DoctrineRoutingBundle\Entity\Route 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return Route
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set isCategory
     *
     * @param boolean $isCategory
     * @return Route
     */
    public function setIsCategory($isCategory)
    {
        $this->isCategory = $isCategory;

        return $this;
    }

    /**
     * Get isCategory
     *
     * @return boolean 
     */
    public function getIsCategory()
    {
        return $this->isCategory;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Route
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Route
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }
}
