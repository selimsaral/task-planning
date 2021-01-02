<?php

namespace App\Provider;

use App\Response\TaskResponse;

class Provider1 extends AbstractProvider
{
    const ENDPOINT = "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa";
    const NAME = "Provider1";

    public function getResult(): array
    {
        $response = [];

        $tasks = $this->fetch(self::ENDPOINT);

        foreach ($tasks as $task) {
            $taskItem = new TaskResponse();
            $taskItem->setName($task["id"]);
            $taskItem->setDuration($task["sure"]);
            $taskItem->setComplexity($task["zorluk"]);
            $taskItem->setProvider(self::NAME);

            $response[] = $taskItem;
        }

        return $response;
    }
}