<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 17/09/2018
 * Time: 12:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
/**
 * @ORM\Table(name="salaire")
 * @ORM\Entity
 */
class Salaire
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=30, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=30, nullable=false)
     */
    private $mois;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date ;

    /**
     * @var Personnel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personnel", inversedBy="salaire")
     * @ORM\JoinColumn(name="personnel_id", referencedColumnName="id")
     */
    private $personnel ;

    public function __construct()
    {
        $this->date = new \DateTime("now");
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
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param string $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * @param string $mois
     */
    public function setMois($mois)
    {
        $this->mois = $mois;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Personnel
     */
    public function getPersonnel()
    {
        return $this->personnel;
    }

    /**
     * @param Personnel $personnel
     */
    public function setPersonnel($personnel)
    {
        $this->personnel = $personnel;
    }


}