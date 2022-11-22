<?php

namespace App\DataFixtures;
use App\Entity\Agent;
use App\Entity\BonsTravail;
use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        // Agents
        for ($i = 0; $i < 5; $i++) {

            $agent = new Agent();
            $agent->setNom($faker->lastName);
            $agent->setPrenom($faker->firstName);
            $agent->setEmail($faker->email);
            $agent->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm'); // 'admin'
            $agent->setCreatedBy('alban');
            $user = new User();
            $user->setEmail($agent->getEmail());
            $agent->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm');
            $user->setRoles(['ROLE_AGENT']);
            $user->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm');
            $agent->setUsers($user);
            $manager->persist($agent);
        }
        // Clients
        for ($k = 0; $k < 5; $k++) {

            $client = new Client();
            $client->setNom($faker->company);
            $client->setEmail($faker->email);
            $client->setVille($faker->city);
            $client->setAdresse($faker->address);
            $client->setCodePostale($faker->postcode);
            $client->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm');  // 'admin'
            $client->setCreatedBy('alban');
            $user = new User();
            $user->setEmail($client->getEmail());
            $client->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm');
            $user->setRoles(['ROLE_CLIENT']);
            $user->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm');
            $client->setUsers($user);
            $manager->persist($client);
            


        }
        {
            $newbon = new BonsTravail();
            $newbon->setNumero('00001');
            $newbon->setTravail('Vitre');
            $newbon->setDateExecutionPrevue($faker->dateTime);
            $manager->persist($newbon);
        }

        // UserAdmin
        {
            $userAdmin = new User();
            $userAdmin->setEmail('admin@gmail.com');
            $userAdmin->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm'); // 'admin'
            $userAdmin->setRoles(['ROLE_ADMIN']);
            $agent->setUsers($userAdmin);
            $manager->persist($userAdmin);


        }
        $manager->flush();
   }
}
