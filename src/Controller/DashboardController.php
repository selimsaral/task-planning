<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Entity\Task;
use App\Planning\TaskPlanning;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $planning;

    public function __construct(TaskPlanning $planning)
    {
        $this->planning = $planning;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $developers = $this->getDoctrine()->getRepository(Developer::class)->findAllWithOrder();
        $tasks      = $this->getDoctrine()->getRepository(Task::class)->findAllWithOrder();

        $planning = $this->planning->planning($tasks, $developers);

        return $this->render('dashboard/index.html.twig', [
            'planning' => $planning,
        ]);
    }
}
