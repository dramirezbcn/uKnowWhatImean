<?php

namespace Infrastructure\GameBundle\Command;

use Application\UseCase\Game\Dto\MovementDto;
use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\Request\MovementRequest;
use Application\UseCase\User\Request\CreateUserRequest;
use Domain\Board\Model\Board;
use Domain\User\Model\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class StartNewGameCommand extends ContainerAwareCommand
{
    /** @var  OutputInterface */
    private $output;

    protected function configure()
    {
        $this
            ->setName('app:start')
            ->setDescription('Start a new game.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $userCommand = $this->getContainer()->get('user.use_case.user_command');
        $gameCommand = $this->getContainer()->get('game.use_case.game_command');

        $helper = $this->getHelper('question');

        $question = new Question('Please enter the Name of First User: ', 'Test user 1');
        $user1Name = $helper->ask($input, $output, $question);
        $user1 = $userCommand->create(new CreateUserRequest($user1Name)) ;

        $question = new Question('Please enter the Name of Second User: ', 'Test user 2');
        $user2Name = $helper->ask($input, $output, $question);
        $user2 = $userCommand->create(new CreateUserRequest($user2Name)) ;

        $game = $gameCommand->create(new CreateGameRequest($user1->getId(), $user2->getId()));

        $output->writeln("You've succesfully created a game.");
        $output->writeln('Game Id: ' . $game->getId());
        $output->writeln('First user: ' . $game->getFirstUser()->getName());
        $output->writeln('Second user: ' . $game->getSecondUser()->getName());

        $question = new Question('Continue? (y/n) ', 'y');
        $continue = $helper->ask($input, $output, $question);

        if($continue !== 'y'){
            exit();
        }

        $userToMove = $game->getFirstUser();
        $moveType = MovementDto::X;
        $winner = false;

        while(!$winner) {
            try {
                $this->printBoard($game->getBoard());

                $question = new Question('Please enter the column of the next move for ' . $userToMove->getName() . ': ', 1);
                $positionY = $helper->ask($input, $output, $question);
                $question = new Question('Please enter the row of the next move for ' . $userToMove->getName() . ': ', 1);
                $positionX = $helper->ask($input, $output, $question);

                $game = $gameCommand->makeMovement(
                    new MovementRequest(
                        $game->getId(),
                        $positionX,
                        $positionY,
                        $moveType,
                        $userToMove->getId()
                    )
                );

                $winner = $gameCommand->checkGameWinnerOrOver($game->getId());

                $userToMove = ($userToMove === $game->getFirstUser()) ? $game->getSecondUser() : $game->getFirstUser();
                $moveType = ($moveType === MovementDto::X) ? MovementDto::O : MovementDto::X;
            } catch (\Exception $ex) {
                $output->writeln('Error ' . $ex->getMessage());
            }
        }

        $this->printBoard($game->getBoard());
        if($winner instanceof User) {
            $output->writeln('We have a Winner!!: ' . $winner->getName());
        } else {
            $output->writeln("There's no winner, it's a tie");
        }
        exit();
    }

    private function printBoard(Board $board)
    {
        /** @var MovementDto[] $row */
        foreach ($board->getBoardPositions() as $row){
            $this->output->writeln('-------');
            $this->output->write('|');
            /** @var MovementDto $movement */
            foreach ($row as $movement){
                $this->output->write($movement->getType() . '|');
            }
            $this->output->writeln('');
        }
        $this->output->writeln('-------');
    }
}