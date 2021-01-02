<?php

namespace App\Provider;

use App\Response\TaskResponse;

class Provider2 extends AbstractProvider
{
    const ENDPOINT = "http://www.mocky.io/v2/5d47f235330000623fa3ebf7";
    const NAME = "Provider2";

    public function getResult(): array
    {
        $response = [];

        $tasks = $this->fetch(self::ENDPOINT);

        foreach ($tasks as $key => $task) {
            $name = array_key_first($task);

            $taskItem = new TaskResponse();
            $taskItem->setName($name);
            $taskItem->setDuration($task[$name]["estimated_duration"]);
            $taskItem->setComplexity($task[$name]["level"]);
            $taskItem->setProvider(self::NAME);

            $response[] = $taskItem;
        }

        return $response;
    }
}