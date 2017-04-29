<?php

namespace Infrastructure\GameBundle\Command;

use Domain\User\Model\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckWinnerGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:check-winner')
            ->setDescription("Check if there's a winner of the game.")
            ->addArgument('gameId', InputArgument::REQUIRED, 'Game Id to check');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $gameCommand = $this->getContainer()->get('game.use_case.game_command');

            $user = $gameCommand->checkGameWinnerOrOver($input->getArgument('gameId'));

            if ($user instanceof User) {
                $output->writeln("There's a winner: " . $user->getName());
            } elseif ($user) {
                $output->writeln("There's no winner. It's a tie.");
            } else {
                $output->writeln("There's no winner yet.");
            }
        } catch (\Exception $ex) {
            $output->writeln('Error ' . $ex->getMessage());
        }
    }
}