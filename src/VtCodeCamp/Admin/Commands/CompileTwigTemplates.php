<?php

namespace VtCodeCamp\Admin\Commands;

use Cilex\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Silex\Application;

class CompileTwigTemplates extends Command
{
    /**
     * @var \Silex\Application
     */
    private $silexApp;

    public function __construct(Application $silexApp)
    {
        parent::__construct();
        $this->silexApp = $silexApp;
    }

    protected function configure()
    {
        $this->setName('twig:compile');
        $this->setDescription('Compile twig templates');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $twigConfig = include APPLICATION_ROOT . '/config/twig.php';
        /* @var $twig Twig_Environment */
        $twig = $this->silexApp['twig'];
        foreach ($twigConfig['paths'] as $path) {
            $output->writeln('Path: ' . $path);
        }
        $output->writeln('Cache: '. $twigConfig['environment']['cache']);
        $output->writeln('Debug: '. $twigConfig['environment']['debug']);
        foreach ($twigConfig['paths'] as $path) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            while ($iterator->valid()) {
                if (!$iterator->isDot() && !$iterator->isDir()) {
                    $twig->loadTemplate($iterator->getSubPathName());
                }
                $iterator->next();
            }
        }
    }
}
