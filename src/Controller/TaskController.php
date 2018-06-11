<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View; // Utilisation de la vue de FOSRestBundle
use App\Entity\Task;

class TaskController extends Controller
{
    /**
     * @Route("/task", name="task")
     */
    /*public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TaskController.php',
        ]);
    }*/

    /**
     * @Rest\View()
     * @Rest\Get("/tasks")
     */
    public function getTasksAction(Request $request)
    {
        $tasks = $this->get('doctrine.orm.entity_manager')
                ->getRepository('App:Task')
                ->findAll();
        /* @var $tasks Task[] */

        // Création d'une vue FOSRestBundle
        $view = View::create($tasks);
        $view->setFormat('json');

        return $view;
    }
}
