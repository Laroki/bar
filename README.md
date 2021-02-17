# bar

J'ai un problème d'indentation avec mon environnement (VS code) c'est pour ça que les fichier twig sont mal indentés

Groupe 16:
Sarah Güngör. <br/>
Léa Boutilié. 
Lucas Benhayoun. 
Hélène Margary. 
Félix Robaglia. 
Rémi Cakir. 
Xavier Mediavilla Diez.

Question 4:

```php
public function findCatSpecial(int $id)
    {
        return $this->createQueryBuilder('c')
            ->join('c.beers', 'b') // raisonner en terme de relation
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->andWhere('c.term = :term')
            ->setParameter('term', 'special')
            ->getQuery()
            ->getResult();
    }
```

La méthode sert à récuperer les catégories 'special' d'une bière (l'id en paramètre correspond à l'id de la bière)
