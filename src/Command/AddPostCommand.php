<?php

namespace App\Command;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddPostCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'app:add-post';

    /** @var EntityManagerInterface  */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add new post command')
            ->addArgument('content', InputArgument::REQUIRED, 'Content of the post')//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('content');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));

            $post = (new BlogPost())
                ->setCreateDate(new \DateTime())
                ->setContent($arg1);

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }

        $io->success('Done.');
    }
}
