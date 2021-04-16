<?php

use App\Sys\Config;

require_once dirname(__DIR__).'/vendor/autoload.php';
$faker = Faker\Factory::create('fr_FR');
// On enregistre les ids des contenus créés
$posts = [];
$categories = [];
$pdo=new PDO("mysql::host=localhost;dbname=blog","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
for ($i = 0; $i < 5; $i++) {
    $title=$faker->sentence(1);
    $slug=Config::slugify($title);
    $pdo->exec("INSERT INTO categorie SET title='{$title}', slug='{$slug}'");
    $categories[] = $pdo->lastInsertId();
}
for ($i = 0; $i < 50; $i++) {
    $title=$faker->sentence(1);
    $slug=Config::slugify($title);
    $pdo->exec("INSERT INTO publications SET title='{$title}', slug='{$slug}', desc_pub='{$faker->paragraphs(rand(0,2), true)}}', cont_pub='{$faker->paragraphs(rand(3,10), true)}', id_cat={$faker->randomElement($categories)}");
    
}

