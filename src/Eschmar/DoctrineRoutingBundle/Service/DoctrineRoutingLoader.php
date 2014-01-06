<?php

namespace Eschmar\DoctrineRoutingBundle\Service;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Custom loader class for storing dynamic routes inside a database
 *
 * @package default
 * @author Marcel Eschmann
 **/
class DoctrineRoutingLoader extends Loader
{
    /**
     * Doctrine Entity Manager
     **/
    private $em;

    /**
     * Avoid multiple loading
     **/
    private $loaded = false;

    function __construct($entityManager) {
        //parent::__construct();
        $this->em = $entityManager;
    }

    /**
     * If this function returns true, load() will be called.
     *
     * @return boolean
     * @author Marcel Eschmann
     **/
    public function supports($resource, $type = null)
    {
        return $type === "doctrine";
    }

    /**
     * Loads all routes from database and returns a RouteCollection containing all routes.
     *
     * @return RouteCollection
     * @author Marcel Eschmann
     **/
    public function load($resource, $type = null)
    {
        // Avoid multiple adding of the loader
        if (true === $this->loaded) {
            throw new \RuntimeException('DoctrineRoutingLoader was already added once!');
        }

           // Create a new route collection
        $routes = new RouteCollection();

        // Retrieve each active route from the database and add it to the collection
        $db_routes = $this->em->getRepository('EschmarDoctrineRoutingBundle:Route')->findBy(array(
            'isActive' => 1,
            'isCategory' => 0
        ), array('sort' => 'asc'));
        foreach ($db_routes as $r) {

            // Retrieve route configuration
            $defaults = array('_controller' => $r->getController());
            $requirements = array();
            $options = array();
            $host = $r->getHost() === null ? '' : $r->getHost();
            
            // TODO:
            /*$schemes = array();
            $methods = array();
            $condition = null;*/

            foreach ($r->getConfig() as $config) {
                switch ($config->getType()) {
                    case 0:
                        $defaults[$config->getName()] = $config->getValue();
                        break;
                    case 1:
                        $requirements[$config->getName()] = $config->getValue();
                        break;
                    case 2:
                        $options[$config->getName()] = $config->getValue();
                        break;
                    default:
                        // invalid type
                        break;
                }
            }

            // Add route to collection
            $routes->add($r->getName(), new Route($r->getPath(), $defaults, $requirements, $options, $host));
        }

        $this->loaded = true;
        return $routes;
    }

} // END class DoctrineRoutingLoader


?>