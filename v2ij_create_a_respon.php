<?php

namespace V2IJ\RespController;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RespController extends Application
{
    private $commands = [];

    public function __construct()
    {
        parent::__construct('RespController', '1.0');

        $this->add(new \V2IJ\RespController\Command\HelpCommand());
        $this->add(new \V2IJ\RespController\Command\VersionCommand());
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '',
            ' RespController - Responsive CLI Tool Controller',
            '==============================================',
            'Type <info>help</info> to see available commands',
            '',
        ]);
    }

    protected function getDefaultCommands()
    {
        return $this->commands;
    }
}

namespace V2IJ\RespController\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class RespCommand extends Command
{
    protected function configure()
    {
        $this->setName('resp');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('RespCommand executed');
    }
}

namespace V2IJ\RespController\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelpCommand extends RespCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('help');
        $this->setDescription('Displays help for a command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '',
            ' RespController Help',
            '=====================',
            'Available commands:',
            '  <info>help</info>      Displays help for a command',
            '  <info>version</info>   Displays the version of RespController',
            '',
        ]);
    }
}

namespace V2IJ\RespController\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommand extends RespCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('version');
        $this->setDescription('Displays the version of RespController');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('RespController version 1.0');
    }
}

if (php_sapi_name() === 'cli') {
    (new RespController())->run();
}