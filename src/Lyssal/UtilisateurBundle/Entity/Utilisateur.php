<?php
namespace Lyssal\UtilisateurBundle\Entity;

use FOS\UserBundle\Entity\User as AbstractedUtilisateur;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupInterface;

/**
 * @ORM\Table(name="lyssal_utilisateur")
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Utilisateur extends AbstractedUtilisateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_date_creation", type="datetime", nullable=false)
     */
    private $dateCreation;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_date_modification", type="datetime", nullable=false)
     */
    private $dateModification;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="UtilisateurGroupe", cascade="persist")
     * @ORM\JoinTable(name="lyssal_utilisateur_a_utilisateur_groupe", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}, inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")})
     */
    protected $groupes;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the creation date
     *
     * @param \DateTime|null $dateCreation
     */
    public function setDateCreation(\DateTime $dateCreation = null)
    {
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * Returns the creation date
     *
     * @return \DateTime|null
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    
    /**
     * Sets the last update date
     *
     * @param \DateTime|null $updatedAt
     */
    public function setDateModification(\DateTime $dateModification = null)
    {
        $this->dateModification = $dateModification;
    }
    
    /**
     * Returns the last update date
     *
     * @return \DateTime|null
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }
    
    /**
     * Add groupe
     *
     * @param \Lyssal\UtilisateurBundle\Entity\UtilisateurGroupe $groupe
     * @return Lyssal\UtilisateurBundle\Entity\Utilisateur
     */
    public function addGroupe(GroupInterface $groupe)
    {
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \Lyssal\UtilisateurBundle\Entity\UtilisateurGroupe $groupe
     */
    public function removeGroupe(GroupInterface $groupe)
    {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupes()
    {
        return $this->groupes;
    }
    
    
    /**
     * Hook on pre-persist operations
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->dateCreation = new \DateTime();
    }

    /**
     * Hook on pre-update operations
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function preUpdate()
    {
        $this->dateModification = new \DateTime();
    }
    
    /**
     * Returns a string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getUsername() ?: '-';
    }
}
