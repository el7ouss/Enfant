<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 14:54
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 * @ORM\Table(name="eleve")
 * @ORM\Entity
 */
class Eleve
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column( name="nom",type="string")
     */
    protected $nom;
    /**
     * @ORM\Column(name="prenom",type="string")
     */
    protected $prenom;
    /**
     * @ORM\Column(name="date_naiss", type="string")
     */
    protected $dateNaiss;
    /**
     * @ORM\Column(name="num_tel_pere",type="string")
     * @Assert\Type(
     *     type="integer",
     *     message="Le valeur {{ value }} n'est pas de type {{ type }} ou le longeur est supérieur à 8."
     * )
     */
    protected $numtelPere;
    /**
     * @ORM\Column( name="nom_pere",type="string")
     */
    protected $nomPere;
    /**
     * @ORM\Column(name="prenom_pere",type="string")
     */
    protected $prenomPere;
    /**
     * @ORM\Column(name="num_tel_mere",type="string")
     * @Assert\Type(
     *     type="integer",
     *     message="Le valeur {{ value }} n'est pas de type {{ type }} ou le longeur est supérieur à 8."
     * )
     */
    protected $numtelMere;
    /**
     * @ORM\Column( name="nom_mere",type="string")
     */
    protected $nomMere;
    /**
     * @ORM\Column(name="prenom_mere",type="string")
     */
    protected $prenomMere;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=false)
     */
    private $image="";

    /**
     * @var  ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Adhesion", mappedBy="eleve")
     */
    private $adhesion;

    /**
     * @var Groupe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groupe", inversedBy="eleve")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe;
    /**
     * Activite constructor.
     */
    public function __construct()
    {
        $this->adhesion = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * @param mixed $dateNaiss
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;
    }

    /**
     * @return mixed
     */
    public function getNumtelPere()
    {
        return $this->numtelPere;
    }

    /**
     * @param mixed $numtelPere
     */
    public function setNumtelPere($numtelPere)
    {
        $this->numtelPere = $numtelPere;
    }

    /**
     * @return mixed
     */
    public function getNomPere()
    {
        return $this->nomPere;
    }

    /**
     * @param mixed $nomPere
     */
    public function setNomPere($nomPere)
    {
        $this->nomPere = $nomPere;
    }

    /**
     * @return mixed
     */
    public function getPrenomPere()
    {
        return $this->prenomPere;
    }

    /**
     * @param mixed $prenomPere
     */
    public function setPrenomPere($prenomPere)
    {
        $this->prenomPere = $prenomPere;
    }

    /**
     * @return mixed
     */
    public function getNumtelMere()
    {
        return $this->numtelMere;
    }

    /**
     * @param mixed $numtelMere
     */
    public function setNumtelMere($numtelMere)
    {
        $this->numtelMere = $numtelMere;
    }

    /**
     * @return mixed
     */
    public function getNomMere()
    {
        return $this->nomMere;
    }

    /**
     * @param mixed $nomMere
     */
    public function setNomMere($nomMere)
    {
        $this->nomMere = $nomMere;
    }

    /**
     * @return mixed
     */
    public function getPrenomMere()
    {
        return $this->prenomMere;
    }

    /**
     * @param mixed $prenomMere
     */
    public function setPrenomMere($prenomMere)
    {
        $this->prenomMere = $prenomMere;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

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
     * @return ArrayCollection
     */
    public function getAdhesion()
    {
        return $this->adhesion;
    }

    /**
     * @param ArrayCollection $adhesion
     */
    public function setAdhesion($adhesion)
    {
        $this->adhesion = $adhesion;
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