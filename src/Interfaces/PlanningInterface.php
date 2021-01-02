<?php

namespace App\Interfaces;

interface PlanningInterface
{
    public function planning($tasks, $developers): array;
}