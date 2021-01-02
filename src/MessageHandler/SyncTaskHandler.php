<?php

namespace App\MessageHandler;

use App\Entity\Task;
use App\Message\SyncTask;
use App\Response\TaskResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SyncTaskHandler implements MessageHandlerInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(SyncTask $message)
    {
        /**
         * @var TaskResponse $item
         */
        foreach ($message->getResult() as $item) {
            $task = new Task();
            $task->setName($item->getName());
            $task->setComplexity($item->getComplexity());
            $task->setDuration($item->getDuration());
            $task->setProvider($item->getProvider());

            $this->em->persist($task);
            $this->em->flush();
        }
    }
}
