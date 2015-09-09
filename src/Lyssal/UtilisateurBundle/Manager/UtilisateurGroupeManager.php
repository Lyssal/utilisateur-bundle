<?php
namespace Lyssal\UtilisateurBundle\Manager;

use FOS\UserBundle\Entity\GroupManager;

/**
 * Manager de l'entité UtilisateurGroupe.
 */
class UtilisateurGroupeManager extends GroupManager
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
