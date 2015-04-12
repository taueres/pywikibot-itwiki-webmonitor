<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class LogText
 *
 * @ORM\Entity()
 * @ORM\Table(name="log_text")
 */
class LogText
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var Log
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Log", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="log_id")
     */
    private $log;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return Log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param Log $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

}