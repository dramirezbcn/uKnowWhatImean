<?php

namespace Infrastructure\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:delete-user')
            ->setDescription('Delete user.')
            ->addArgument('userId', InputArgument::REQUIRED, 'The id of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userCommand = $this->getContainer()->get('user.use_case.user_command');

        $userCommand->delete($input->getArgument('userId'));

        $output->writeln("You've succesfully deleted a user.");
    }
}