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
            ->setName('app:create-user')
            ->setDescription('Create user.')
            ->addArgument('userName', InputArgument::REQUIRED, 'The name of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userCommand = $this->getContainer()->get('user.use_case.user_command');

        $user = $userCommand->create(
            new CreateUserRequest($input->getArgument('userName'))
        );

        $output->writeln("You've succesfully created a user.");
        $output->writeln('Id: ' . $user->getId());
        $output->writeln('Name: ' . $user->getName());
    }
}