<?php

namespace App\Planning;

use App\Interfaces\PlanningInterface;

class TaskPlanning implements PlanningInterface
{
    public function planning($tasks, $developers): array
    {
        $weeks = $this->getWeeks($tasks, $developers);

        foreach ($weeks as $key => &$week) {
            foreach ($developers as $developer) {
                $developerName = $developer['name'];
                $taskDetail    = $this->getTask($tasks, $developer['weekly_capacity']);

                $week[$developerName]['total_capacity'] = $developer['weekly_capacity'];
                $week[$developerName]['total_duration'] = $taskDetail['total_duration'];
                $week[$developerName]['tasks']          = $taskDetail['tasks'];
            }
        }

        return $weeks;
    }


    private function getWeeks(array $tasks, array $developers): array
    {
        $totalDuration       = $this->getTotalDuration($tasks);
        $totalWeeklyCapacity = $this->getTotalWeeklyCapacity($developers);

        $totalWeeks = ceil($totalDuration / $totalWeeklyCapacity);
        $weeks      = [];

        for ($i = 1; $i <= $totalWeeks; $i++) {
            $weeks[$i] = [];
        }

        return $weeks;
    }

    private function getTotalDuration($tasks): int
    {
        $totalDuration = 0;
        foreach ($tasks as $task) {
            $totalDuration += ($task['complexity'] * $task['duration']);
        }

        return $totalDuration;
    }

    private function getTotalWeeklyCapacity($developers): int
    {
        $totalWeeklyCapacity = 0;

        foreach ($developers as $developer) {
            $totalWeeklyCapacity += $developer['weekly_capacity'];
        }

        return $totalWeeklyCapacity;
    }

    private function getTask(array &$all_task, int $limit): array
    {
        $remaining      = $limit;
        $total_duration = 0;
        $filtered_tasks = [];

        foreach ($all_task as $key => $task) {
            if ($remaining > 0) {

                $taskDuration         = $task['duration'];
                $originalTaskDuration = $taskDuration;
                $originalRemaining    = $remaining;

                if ($remaining < $taskDuration) {
                    $taskDuration     = $remaining;
                    $task['duration'] = $remaining;
                }

                $total_duration += $taskDuration;
                $remaining      -= $taskDuration;

                $filtered_tasks[] = $task;

                if ($originalRemaining < $originalTaskDuration) {
                    $all_task[$key]['duration'] -= $remaining;
                } else {
                    unset($all_task[$key]);
                }
            }
        }

        return array('total_duration' => $total_duration, 'tasks' => $filtered_tasks);
    }
}