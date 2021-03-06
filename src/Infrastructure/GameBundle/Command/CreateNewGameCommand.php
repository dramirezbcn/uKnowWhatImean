<?php

namespace Infrastructure\GameBundle\Command;

use Application\UseCase\Game\Request\CreateGameRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateNewGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:create-new-game')
            ->setDescription('Create a new game.')
            ->addArgument('firstUser', InputArgument::REQUIRED, 'Id of the first user.')
            ->addArgument('secondUser', InputArgument::REQUIRED, 'Id of the second user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $gameCommand = $this->getContainer()->get('game.use_case.game_command');

            $game = $gameCommand->create(
                new CreateGameRequest(
                    $input->getArgument('firstUser'),
                    $input->getArgument('secondUser')
                )
            );

            $output->writeln("You've succesfully created a game.");
            $output->writeln('Id: ' . $game->getId());
            $output->writeln('First user: ' . $game->getFirstUser()->getName());
            $output->writeln('Second user: ' . $game->getSecondUser()->getName());
        } catch (\Exception $ex) {
            $output->writeln('Error ' . $ex->getMessage());
        }
    }
}