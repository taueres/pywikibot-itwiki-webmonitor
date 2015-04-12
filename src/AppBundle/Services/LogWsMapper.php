<?php
namespace AppBundle\Services;

use AppBundle\Entity\Log;
use AppBundle\Entity\LogText;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LogWsMapper
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param Log $log
     * @return array
     */
    public function mapLogEntity(Log $log)
    {
        $ret = array(
            'id' => $log->getId(),
            'command' => $log->getCommand(),
            'exitCode' => $log->getExitCode(),
            'createdAt' => $log->getCreatedAt()->getTimestamp(),
            'textRead' => $this->router->generate('ws_log_text_read', ['logId' => $log->getId()])
        );
        return $ret;
    }

    /**
     * @param LogText $logText
     * @return array
     */
    public function mapLogTextEntity(LogText $logText)
    {
        $ret = array(
            'id' => $logText->getId(),
            'logId' => $logText->getLog()->getId(),
            'text' => $logText->getText(),
        );
        return $ret;
    }

    /**
     * @param array|Log[] $logEntities
     * @return array
     */
    public function mapLogCollection(array $logEntities)
    {
        $output = array();
        foreach ($logEntities as $logEntity) {
            $output[] = $this->mapLogEntity($logEntity);
        }
        return $output;
    }
}