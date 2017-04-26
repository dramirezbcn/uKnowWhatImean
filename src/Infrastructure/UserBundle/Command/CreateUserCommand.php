<?php

namespace Infrastructure\UserBundle\Command;

use Application\UseCase\User\Request\CreateUserRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create-user')
            // the short description shown while running "php bin/console list"
            ->setDescription('Create user.')
            // Arguments
            ->addArgument('userName', InputArgument::REQUIRED, 'The name os the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userCommand = $this->getContainer()->get('user.use_case.user_command');

        $user = $userCommand->create(
            new CreateUserRequest($input->getArgument('userName'))
        );

        // outputs a message without adding a "\n" at the end of the line
        $output->writeln("You've succesfully created a user.");
        $output->writeln('Id: ' . $user->getId());
        $output->writeln('Name: ' . $user->getName());
    }
}