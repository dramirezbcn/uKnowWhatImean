<?php

namespace Infrastructure\UserBundle\Command;

use Application\UseCase\User\Request\CreateUserRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:delete-user')
            // the short description shown while running "php bin/console list"
            ->setDescription('Delete user.')
            // Arguments
            ->addArgument('userId', InputArgument::REQUIRED, 'The id of the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userCommand = $this->getContainer()->get('user.use_case.user_command');

        $userCommand->delete($input->getArgument('userId'));

        // outputs a message without adding a "\n" at the end of the line
        $output->writeln("You've succesfully deleted a user.");
    }
}