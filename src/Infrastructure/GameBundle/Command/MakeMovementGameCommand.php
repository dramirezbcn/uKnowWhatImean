<?php

namespace Infrastructure\GameBundle\Command;

use Application\UseCase\Game\Request\MovementRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMovementGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:make-move')
            ->setDescription('Make a move.')
            ->addArgument('gameId', InputArgument::REQUIRED, 'Game Id where to do the movement')
            ->addArgument('positionX', InputArgument::REQUIRED, 'Position X of the board where to do the movement')
            ->addArgument('positionY', InputArgument::REQUIRED, 'Position Y of the board where to do the movement')
            ->addArgument('type', InputArgument::REQUIRED, 'X or O')
            ->addArgument('user', InputArgument::REQUIRED, 'User Id doing the movement');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $gameCommand = $this->getContainer()->get('game.use_case.game_command');

            $game = $gameCommand->makeMovement(
                new MovementRequest(
                    $input->getArgument('gameId'),
                    $input->getArgument('positionX'),
                    $input->getArgument('positionY'),
                    $input->getArgument('type'),
                    $input->getArgument('user')
                )
            );

            $output->writeln("You've succesfully make a move.");
            $output->writeln('Game Id: ' . $game->getId());
            $output->writeln('Position X: ' . $input->getArgument('positionX'));
            $output->writeln('Position Y: ' . $input->getArgument('positionY'));
            $output->writeln('Type: ' . $input->getArgument('type'));

        } catch (\Exception $ex) {
            $output->writeln('Error ' . $ex->getMessage());
        }
    }
}