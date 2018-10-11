<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 15:12
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="seance")
 */

class Seance
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column( name="jours",type="string")
     */
    protected $jours;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="string", nullable=true)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="string", nullable=true)
     */
    private $dateEnd;

    /**
     * @var Activite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Activite", inversedBy="seance")
     * @ORM\JoinColumn(name="activite_id", referencedColumnName="id")
     */
    private $activite ;


    /**
     * @return mixed
     */
    public function getJours()
    {
        return $this->jours;
    }

    /**
     * @param mixed $jours
     */
    public function setJours($jours)
    {
        $this->jours = $jours;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTime $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param Activite $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }



}