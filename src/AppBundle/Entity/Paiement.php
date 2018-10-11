<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 20/09/2018
 * Time: 20:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="paiement")
 * @ORM\Entity
 */
class Paiement
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
     * @ORM\Column(name="mois", type="array", nullable=false)
     */
    private $mois;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var Adhesion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adhesion", inversedBy="paiement")
     * @ORM\JoinColumn(name="adhesion_id", referencedColumnName="id")
     */
    private $adhesion ;

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
     * @return Adhesion
     */
    public function getAdhesion()
    {
        return $this->adhesion;
    }

    /**
     * @param Adhesion $adhesion
     */
    public function setAdhesion($adhesion)
    {
        $this->adhesion = $adhesion;
    }



}