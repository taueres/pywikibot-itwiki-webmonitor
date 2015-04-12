<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Log;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WsController
 * @package AppBundle\Controller
 *
 * @Route("/ws")
 */
class WsController extends Controller
{
    /**
     * @Route("/log/list", name="ws_log_list", options={"expose": true})
     * @param Request $request
     * @return JsonResponse
     */
    public function getLogListAction(Request $request)
    {
        $paginator = $this->get('app.log_paginator');
        $qb = $paginator->getQueryBuilderPaginated($request);
        $qb->addOrderBy('log.id', 'DESC');

        $mapper = $this->get('app.log_ws_mapper');
        return new JsonResponse(
            array(
                'size' => $paginator->getTotalNumberOfEntities(),
                'pages' => $paginator->getNumberOfPages(),
                'items' => $mapper->mapLogCollection($qb->getQuery()->getResult())
            )
        );
    }

    /**
     * @Route("/log/{logId}", name="ws_log_read", options={"expose": true})
     * @param Log $logId
     * @return JsonResponse
     */
    public function getLogAction(Log $logId)
    {
        $mapper = $this->get('app.log_ws_mapper');
        return new JsonResponse(
            $mapper->mapLogEntity($logId)
        );
    }

    /**
     * @Route("/log-text/{logId}", name="ws_log_text_read", options={"expose": true})
     * @param int $logId
     * @return JsonResponse
     */
    public function getLogTextAction($logId)
    {
        $logText = $this->getDoctrine()
            ->getRepository('AppBundle:LogText')
            ->findOneBy(['log' => $logId]);
        if (null === $logText) {
            throw $this->createNotFoundException();
        }
        $mapper = $this->get('app.log_ws_mapper');
        return new JsonResponse(
            $mapper->mapLogTextEntity($logText)
        );
    }
}