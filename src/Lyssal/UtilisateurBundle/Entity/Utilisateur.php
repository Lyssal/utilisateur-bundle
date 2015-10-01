<?php
namespace Lyssal\UtilisateurBundle\Entity;

use FOS\UserBundle\Entity\User as AbstractedUtilisateur;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lyssal_utilisateur")
 * @ORM\MappedSuperclass()
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
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    protected $dateCreation;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=false)
     */
    protected $dateModification;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="UtilisateurGroupe", cascade="persist")
     * @ORM\JoinTable(name="lyssal_utilisateur_a_utilisateur_groupe", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}, inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")})
     */
    protected $groups;
    
    
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
     * @return array
     */
    public function getRealRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRealRoles(array $roles)
    {
        $this->setRoles($roles);
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
