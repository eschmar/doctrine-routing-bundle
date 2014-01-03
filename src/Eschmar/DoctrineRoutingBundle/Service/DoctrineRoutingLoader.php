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
        $db_routes = $this->em->getRepository('EschmarDoctrineRoutingBundle:Route')->findBy(array('isActive' => 1), array('sort' => 'asc'));
        foreach ($db_routes as $r) {

        	// Pattern
        	$temp = new Route($r->getPath(), array(
        		'_controller' => $r->getDefaultsController()
    		));

        	// Defaults
    		if ($r->getDefaultsFormat() !== null) {
    			$temp->addDefaults(array(
    				'_format' => $r->getDefaultsFormat()
				));
    		}

    		// Requirements
    		if ($r->getReqFormat() !== null) {
    			$temp->addRequirements(array(
    				'_format' => $r->getReqFormat()
				));
        	}

    		$routes->add($r->getName(), $temp);
        }

		$this->loaded = true;
		return $routes;
	}

} // END class DoctrineRoutingLoader


?>