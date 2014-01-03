<?php

namespace Eschmar\DoctrineRoutingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;

/**
 * Clears the routing cache. New routes will be cached with the next request.
 *
 * @package default
 * @author Marcel Eschmann
 **/
class ClearRoutingCacheCommand extends Command
{
    protected function configure()
    {
    	$this->setName('cache:clear:routing')
    		->setDescription('Clear Routing Cache')
    		->addArgument('env', InputArgument::OPTIONAL, '[dev,prod,test]');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$error = false;
    	$output->writeln('');

    	$env = $input->getArgument('env') ? $input->getArgument('env') : 'dev';

        // Check if there's available cache files at all
    	if (!is_dir('app/cache/'.$env)) {
    		$output->writeln('<info>> No cache folder for environment "'.$env.'" found.</info>');
    		return;
    	}

        // Delete routing cache files
    	$finder = new Finder();
    	foreach ($finder->files()->depth('== 0')->in('app/cache/'.$env) as $file) {
    		if (preg_match('/^appDevUrl/', $file->getFilename()) == 1) {
    			try {
    				unlink($file->getRealPath());
    			} catch (Exception $e) {
    				$error = true;
    				$output->writeln('Unable to delete '.$file->getFilename().'!');
    			}
    		}
    	}

        // Status report
    	if ($error) {
    		$output->writeln('<error>> Unexpected error. Check for write privileges.</error>');
    	}else {
    		$output->writeln('<info>> Successfully cleared routing cache.</info>');
    	}
    }
}  // END class ClearRoutingCacheCommand extends Command

?>