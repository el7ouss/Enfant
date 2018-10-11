<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 15:17
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="activite")
 */
class Activite
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column( name="libelle",type="string")
     */
    protected $libelle;
    /**
     * @ORM\Column( name="nb_heure",type="integer")
     */
    protected $nbHeure;

    /**
     * @var Groupe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groupe", inversedBy="activite")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe ;

    /**
     * @var  ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seance", mappedBy="activite")
     */
    private $seance;

    /**
     * Activite constructor.
     */
    public function __construct()
    {
        $this->seance = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getNbHeure()
    {
        return $this->nbHeure;
    }

    /**
     * @param mixed $nbHeure
     */
    public function setNbHeure($nbHeure)
    {
        $this->nbHeure = $nbHeure;
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
     * @return ArrayCollection
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * @param ArrayCollection $seance
     */
    public function setSeance($seance)
    {
        $this->seance = $seance;
    }

    /**
     * @return Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * @param Groupe $groupe
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }


}