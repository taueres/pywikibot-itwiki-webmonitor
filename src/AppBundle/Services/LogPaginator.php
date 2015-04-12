<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class LogPaginator
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var int
     */
    protected $pageSize;

    /**
     * @param EntityManager $em
     * @param int $pageSize
     */
    public function __construct(EntityManager $em, $pageSize)
    {
        $this->em = $em;
        $this->pageSize = $pageSize;
    }

    /**
     * @param Request $request
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderPaginated(Request $request)
    {
        $page = (int) $request->query->get('page', 1);
        if ($page < 1) {
            $page = 1;
        }

        $qb = $this->em->getRepository('AppBundle:Log')->createQueryBuilder('log');
        $qb->setMaxResults($this->pageSize);
        $qb->setFirstResult($this->pageSize * ($page - 1));
        return $qb;
    }

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return ceil($this->getTotalNumberOfEntities() / $this->pageSize);
    }

    /**
     * @return int
     */
    public function getTotalNumberOfEntities()
    {
        return $this->em->createQuery("
            SELECT COUNT(log.id)
            FROM AppBundle:Log log
        ")->getSingleScalarResult();
    }
}