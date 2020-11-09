<?php

namespace Infrastructure\Console;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use TelegramBot\Api\BotApi;

class XCommand extends Command implements ServiceSubscriberInterface
{
    private ContainerInterface $container;
    protected static $defaultName = 'x';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Only for testing purposes')
        ;
    }

    public static function getSubscribedServices()
    {
        return [
        ];
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $telegram = $this->container->get(BotApi::class);
        $me = $telegram->getMe();
        dump($me);

        return 0;
    }
}
