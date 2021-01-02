<?php

namespace App\Tests;

use App\Planning\TaskPlanning;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskPlanningTest extends WebTestCase
{

    public function testPlanningAssignTest()
    {
        $tasks = [
            [
                "name"       => "Test Task 1",
                "duration"   => 1,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 2",
                "duration"   => 1,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 3",
                "duration"   => 1,
                "complexity" => 1
            ]
        ];

        $developer = [
            [
                "name"            => "DEV1",
                "hourly_capacity" => 1,
                "weekly_capacity" => 45
            ],
            [
                "name"            => "DEV2",
                "hourly_capacity" => 2,
                "weekly_capacity" => 90
            ],
            [
                "name"            => "DEV3",
                "hourly_capacity" => 3,
                "weekly_capacity" => 135
            ],
            [
                "name"            => "DEV4",
                "hourly_capacity" => 4,
                "weekly_capacity" => 180
            ],
            [
                "name"            => "DEV5",
                "hourly_capacity" => 5,
                "weekly_capacity" => 225
            ],
        ];

        $task = new TaskPlanning();
        $task->planning($tasks, $developer);

        $this->assertEmpty($tasks);
    }

    public function testPlanningNotAssignTest()
    {
        $tasks = [
            [
                "name"       => "Test Task 1",
                "duration"   => 100,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 2",
                "duration"   => 100,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 3",
                "duration"   => 100,
                "complexity" => 1
            ]
        ];

        $developer = [
            [
                "name"            => "DEV1",
                "hourly_capacity" => 1,
                "weekly_capacity" => 45
            ],
        ];

        $task = new TaskPlanning();
        $task->planning($tasks, $developer);

        $this->assertNotEmpty($tasks);
    }


    public function testCheckWorkingHours()
    {
        $tasks = [
            [
                "name"       => "Test Task 1",
                "duration"   => 50,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 2",
                "duration"   => 50,
                "complexity" => 1
            ],
            [
                "name"       => "Test Task 3",
                "duration"   => 50,
                "complexity" => 1
            ]
        ];

        $allDeveloper = [
            "DEV1" => [
                "name"            => "DEV1",
                "hourly_capacity" => 1,
                "weekly_capacity" => 45
            ],
        ];

        $task  = new TaskPlanning();
        $weeks = $task->planning($tasks, $allDeveloper);

        foreach ($weeks as $week) {

            foreach ($week as $developerName => $developers) {

                $developerCapacity = $allDeveloper[$developerName]['weekly_capacity'];

                $this->assertLessThanOrEqual($developerCapacity, $developers['total_duration']);
            }
        }

    }
}