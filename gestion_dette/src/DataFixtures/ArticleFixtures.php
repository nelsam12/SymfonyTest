<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article->setLibelle('Article 1');
        $article->setQteStock(1000);
        $article->setPrixUnitaire(30);
        $article->setAvailable(true);
        $manager->persist($article);
        $manager->flush();
    }
}
