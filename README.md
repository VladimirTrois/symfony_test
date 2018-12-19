# Application de checkin de bière

## Application

Un utilisateur doit pouvoir se connecter en utilisant son e-mail et son mot de passe.

Un utilisateur doit pouvoir créer un compte avec un e-mail et un mot de passe :
* l'e-mail doit être unique et être valide
* MDP: 12 caractère minimum, 1 Lettre minuscule, 1 Majuscule, 1 chiffre, 1 caractère spécial

L'utilisateur se retrouve sur une page indiquant le nombre total de bières qu'il a bu ainsi
que le nombre de référence unique

Un utilisateur a la possibilité d'ajouter une bière a sa checklist de bière consommée.
Pour choisir une biere, l'utilisateur dispose d'un champ de recherche dans lequel
il rentre le nom de la bière ou de la brasserie.

Une liste des différentes bières, correspondant a la recherche est remontée,
l'utilisateur peut cliquer sur une bière pour voir plus de détails et ajouter
cette bière a sa liste.
Lorsqu'il ajoute cette bière, il peut :
* Donner une note entre 0 et 10
* Ajouter le revendeur
* Indiquer le type de service

Un utilisateur doit pouvoir ajouter une biere s'il ne trouve pas cette bière dans la liste.
Un utilisateur doit pouvoir ajouter une brasserie s'il ne trouve pas cette brasserie dans la liste.
Un utilisateur doit pouvoir ajouter un revendeur s'il ne trouve pas ce revendeur dans la liste.

Une page de statistique montrera les métriques suivantes:
* nombre de références de bières unique dégustées
* nombre de références de bières unique par type de bière
* nombre de références de bières unique par pays d'origine du brasseur
* Référence favorites de l'utilisateur suivant la consommation

### Model
Les objets métiers de cette application :
* Utilisateur
* Bière
* Brasserie
* Revendeur
* Checklist

#### Utilisateur

* e-mail (unique)
* mot de passe
* date de création
* pseudonyme

#### Biere

Une biere appartient à une brasserie.

* Nom
* Robe (couleur)
* Type (ambrée, triple, etc.)
* Description
* IBU (indice d'amertume) (entier entre 0 et 100)
* Abv (degré d'alcool) nombre flottant
* date de création

#### Brasserie

* Nom
* Adresse
    * Numéro de rue
    * rue
    * ville
    * Code postale
    * Pays
* Date de création

#### Revendeur

Un revendeur dispose de plusieurs références de bière.

* Nom
* Adresse
    * Numéro de rue
    * rue
    * ville
    * Code postale
    * Pays
* Type (Bar/Grande Surface/Caviste)
* Date de création

#### Checklist

Une checklist appartient à un utilisateur.
Elle contient une référence vers une bière
ainsi qu'une référence vers le revendeur.

* Note (flottant entre 0 et 10)
* Service (pression, bouteille, canette)
* Date de création
