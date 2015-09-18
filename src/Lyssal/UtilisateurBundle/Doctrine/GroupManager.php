<?php
namespace Lyssal\UtilisateurBundle\Doctrine;

/**
 * Surcharge du manager FosGroup.
 */
class GroupManager extends \FOS\UserBundle\Doctrine\GroupManager
{
    /**
     * Retourne les noms des groupes d'utilisateur indexés par ID.
     */
    public function getNamesById()
    {
        $namesById = array();
        
        foreach ($this->findGroups() as $group)
            $namesById[$group->getId()] = $group->getName();
        
        return $namesById;
    }
}
