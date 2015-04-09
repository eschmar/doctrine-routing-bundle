<?php

namespace Eschmar\DoctrineRoutingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->setDescription('Clear Routing Cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('');
        $kernel = $this->getApplication()->getKernel();
        $helper = $kernel->getContainer()->get('eschmar_doctrine_routing.helper');
        $env = $kernel->getEnvironment();

        if (!$helper->clear($env)) {
            foreach ($helper->error_stack as $error) {
                $output->writeln('<error>'.$error.'</error>');
            }
        }else {
            foreach ($helper->info_stack as $info) {
                $output->writeln('<info>'.$info.'</info>');
            }
            $output->writeln('<info>> Successfully cleared routing cache.</info>');
        }
    }
}  // END class ClearRoutingCacheCommand extends Command
