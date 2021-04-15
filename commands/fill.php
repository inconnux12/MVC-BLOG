<?php
require_once dirname(__DIR__).'/vendor/autoload.php';
$faker = Faker\Factory::create('fr_FR');
// On enregistre les ids des contenus créés
$posts = [];
$categories = [];
$pdo=new PDO("mysql::host=localhost;dbname=blog","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
for ($i = 0; $i < 5; $i++) {
    $pdo->exec("INSERT INTO categorie SET name_cat='{$faker->sentence(1)}'");
    $categories[] = $pdo->lastInsertId();
}
for ($i = 0; $i < 50; $i++) {
    $pdo->exec("INSERT INTO publications SET title_pub='{$faker->sentence(1)}', slug='{$faker->slug}', desc_pub='{$faker->paragraphs(rand(3,6), true)}}', cont_pub='{$faker->paragraphs(rand(3,10), true)}', id_cat={$faker->randomElement($categories)}");
    
}

