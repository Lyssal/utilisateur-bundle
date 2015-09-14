<?php
namespace Lyssal\UtilisateurBundle\Manager;

use FOS\UserBundle\Doctrine\UserManager;

/**
 * Manager de l'entité Utilisateur.
 */
class UtilisateurManager extends UserManager
{
    /**
     * Finds users by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
    public function findUsersBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /**
     * Met à jour "enabled" de plusieurs utilisateurs.
     * 
     * @param \Lyssal\UtilisateurBundle\Entity\Utilisateur[] $users   Utilisateurs à mettre à jour
     * @param boolean                                        $enabled Valeur du enabled
     */
    public function updateEnabledByUsers($users, $enabled)
    {
        foreach ($users as $user)
        {
            $user->setEnabled($enabled);
            $this->updateUser($user, false);
        }

        $this->objectManager->flush();
    }
}
