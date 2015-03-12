# LyssalUtilisateurBundle

`LyssalUtilisateurBundle` permet de gérer les utilisateurs. Le bundle se base sur `FOSUser`.


## Entités

Toutes les entités possèdent leur manager et leur gestion administrative (optionnelle) si vous utilisez `Sonata`.

Les entités sont :
* Civilite : Madame, Monsieur, Mademoiselle, Docteur, etc
* Utilisateur : Un utilisateur
* UtilisateurGroupe : Un groupe d'utilisateur


## Utilisation

Vous devez créer un bundle héritant `LyssalUtilisateurBundle` :

```php
namespace Acme\TourismeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeUtilisateurBundle extends Bundle
{
    public function getParent()
    {
        return 'LyssalUtilisateurBundle';
    }
}
```

Ensuite, vous devez créer dans votre bundle les entités nécessaires héritant celles de `LyssalUtilisateurBundle`.

```php
namespace Acme\UtilisateurBundle\Entity;

use Lyssal\UtilisateurBundle\Entity\Utilisateur as BaseUtilisateur;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="acme_utilisateur")
 * @ORM\Entity
 */
class Utilisateur extends BaseUtilisateur
{
    // Vos propriétés et méthodes si nécessaire
}

```
```php
namespace Acme\UtilisateurBundle\Entity;

use Lyssal\UtilisateurBundle\Entity\UtilisateurGroupe as BaseUtilisateurGroupe;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="acme_utilisateur_groupe")
 * @ORM\Entity
 */
class UtilisateurGroupe extends BaseUtilisateurGroupe
{
    // Vos propriétés et méthodes si nécessaire
}
```
```php
namespace Acme\UtilisateurBundle\Entity;

use Lyssal\UtilisateurBundle\Entity\Civilite as BaseCivilite;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendee_civilite")
 * @ORM\Entity
 */
class Civilite extends BaseCivilite
{
    // Vos propriétés et méthodes si nécessaire
}
```

Vous devez ensuite redéfinir les paramètres suivants :
* `lyssal.utilisateur.entity.civilite.class` : Acme\UtilisateurBundle\Entity\Civilite

Exemple avec sur `Acme/UtilisateurBundle/Resources/config/services.xml` :

```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <parameters>
        <parameter key="lyssal.utilisateur.entity.civilite.class">Acme\UtilisateurBundle\Entity\Civilite</parameter>
    </parameters>
</container>
```

Les paramètres suivants, gérés par `FOSUser`, doivent également être définis (reportez-vous à la documentation de `FOSUserBundle` pour plus d'informations) :
* `fos_user.model.user.class`
* `fos_user.model.group.class`


## Managers

Les services sont :
* `fos_user.user_manager`
* `fos_user.group_manager`
* `lyssal.tourisme.manager.structure_type`

À noter que les managers `fos_user.user_manager` et `fos_user.group_manager` sont hérités des managers de `FOSUser`.


## SonataAdmin

Les entités seront automatiquement intégrées à `SonataAdmin` si vous l'avez installé.

Si vous souhaitez redéfinir les classes `Admin`, il suffit de surcharger les paramètres suivants :
* `lyssal.utilisateur.admin.utilisateur.class`
* `lyssal.utilisateur.admin.utilisateur_groupe.class`
* `lyssal.utilisateur.admin.civilite.class`


## Installation

1. Mettez à jour votre `composer.json` :
```json
"require": {
    "lyssal/utilisateur-bundle": "*"
}
```
2. Installez le bundle :
```sh
php composer.phar update
```
3. Mettez à jour `AppKernel.php` :
```php
new Lyssal\UtilisateurBundle\LyssalUtilisateurBundle(),
```
4. Créez les tables en base de données :
```sh
php app/console doctrine:schema:update --force
```
