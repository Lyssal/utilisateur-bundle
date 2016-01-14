# LyssalUtilisateurBundle

`LyssalUtilisateurBundle` permet de gérer les utilisateurs. Le bundle se base sur `FOSUser` avec `Doctrine ORM`.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b8d0b0d0-f8ad-439a-94de-d33414d9f6cc/small.png)](https://insight.sensiolabs.com/projects/b8d0b0d0-f8ad-439a-94de-d33414d9f6cc)


## Entités

Toutes les entités possèdent leur manager et leur gestion administrative (optionnelle) si vous utilisez `Sonata`.

Les entités sont :
* Civilite : Madame, Monsieur, Mademoiselle, Docteur, etc
* Utilisateur : Un utilisateur
* UtilisateurGroupe : Un groupe d'utilisateur


## Utilisation

Vous devez créer un bundle héritant `LyssalUtilisateurBundle` :

```php
namespace Acme\UtilisateurBundle;

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
 * @ORM\Entity()
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
* `lyssal.utilisateur.entity.utilisateur.class` : Acme\UtilisateurBundle\Entity\Utilisateur
* `lyssal.utilisateur.entity.utilisateur_groupe.class` : Acme\UtilisateurBundle\Entity\UtilisateurGroupe

Exemple avec sur `Acme/UtilisateurBundle/Resources/config/services.xml` :

```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <!-- ... -->
    <parameters>
        <parameter key="lyssal.utilisateur.entity.civilite.class">Acme\UtilisateurBundle\Entity\Civilite</parameter>
        <parameter key="lyssal.utilisateur.entity.utilisateur.class">Acme\UtilisateurBundle\Entity\Utilisateur</parameter>
        <parameter key="lyssal.utilisateur.entity.utilisateur_groupe.class">Acme\UtilisateurBundle\Entity\UtilisateurGroupe</parameter>
    </parameters>
</container>
```

Si vous utilisez `SonataAdmin`, ajoutez dans les services de votre `Acme/UtilisateurBundle/Resources/config/services.xml` :

```xml
<service id="sonata.user.editable_role_builder" class="Lyssal\UtilisateurBundle\Security\EditableRolesBuilder">
    <argument type="service" id="security.context" />
    <argument type="service" id="sonata.admin.pool" />
    <argument>%security.role_hierarchy.roles%</argument>
    <argument type="service" id="translator" />
</service>

<service id="lyssal.utilisateur.form.type.security_roles" class="Lyssal\UtilisateurBundle\Form\Type\SecurityRolesType">
    <tag name="form.type" alias="lyssal_security_roles" />
    <argument type="service" id="sonata.user.editable_role_builder" />
</service>
```


Les paramètres suivants, gérés par `FOSUser`, doivent également être définis (reportez-vous à la documentation de `FOSUserBundle` pour plus d'informations) :
* `fos_user.model.user.class`
* `fos_user.model.group.class`


## Managers

Les services sont :
* `fos_user.user_manager`
* `fos_user.group_manager`
* `lyssal.utilisateur.manager.civilite`
* `lyssal.utilisateur.manager.utilisateur`
* `lyssal.utilisateur.manager.utilisateur_groupe`

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
5. Mettez à jour le `routing.yml` :
```sh
lyssal_utilisateur:
    resource: "@LyssalUtilisateurBundle/Resources/config/routing.yml"
    prefix: /
```
