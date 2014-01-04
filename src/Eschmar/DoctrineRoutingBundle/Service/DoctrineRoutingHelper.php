<?php

namespace Eschmar\DoctrineRoutingBundle\Service;

use Symfony\Component\Finder\Finder;

/**
 * Helper class
 *
 * @package default
 * @author Marcel Eschmann
 **/
class DoctrineRoutingHelper
{

    /**
     * Error messages log
     **/
    public $error_stack = array();

    /**
     * Info messages log
     **/
    public $info_stack = array();

    /**
     * Clears the routing cache
     *
     * @return boolean
     * @author Marcel Eschmann
     **/
    public function clear($env = 'dev')
    {

        // Validate input
        $env = $env === null ? 'dev' : $env;

        if ($env !== 'dev' && $env !== 'prod' && $env !== 'test') {
            $this->error_stack[] = '> Invalid environment chosen. Please choose between [dev, prod, test].';
            return false;
        }

        // Check if there's available cache files at all
        if (!is_dir('app/cache/'.$env)) {
            $this->info_stack[] = '> No cache folder for environment "'.$env.'" found.';
            return true;
        }

        // Delete routing cache files
        $finder = new Finder();
        foreach ($finder->files()->depth('== 0')->in('app/cache/'.$env) as $file) {
            if (preg_match('/^appDevUrl/', $file->getFilename()) == 1) {
                if (!@unlink($file->getRealPath())) {
                    $this->error_stack[] = '> Unable to delete '.$file->getFilename().'!';
                    $this->error_stack[] = '> Unexpected error. Check for write privileges.';
                    return false;
                }
            }
        }

        return true;
    }
    
} // END class DoctrineRoutingHelper

?>