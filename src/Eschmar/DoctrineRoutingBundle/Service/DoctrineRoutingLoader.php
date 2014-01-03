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
		//$routes = new RouteCollection();

		if (true === $this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }

        $routes = new RouteCollection();
        $doctrine_routes = $this->em->getRepository('EschmarDoctrineRoutingBundle:Route')->findAll();

        foreach ($doctrine_routes as $r) {
        	$temp = new Route($r->getPattern(), array(
        		'_controller' => $r->getController()
    		));

    		$routes->add('tadaaa', $temp);
        }

		// code here.

		$this->loaded = true;
		return $routes;
	}

} // END class DoctrineRoutingLoader


?>