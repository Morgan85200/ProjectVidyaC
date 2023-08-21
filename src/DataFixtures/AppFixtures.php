<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Game;
use App\Entity\Category;
use App\Entity\Creator;
use App\Entity\GameCategory;
use App\Entity\GameCreator;
use App\Entity\GamePlatform;
use App\Entity\GameUser;
use App\Entity\Platform;
use App\Repository\CategoryRepository;
use App\Repository\CreatorRepository;
use App\Repository\GameRepository;
use App\Repository\PlatformRepository;
use App\Repository\UserRepository;
use App\Service\DateTimeFactory;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    private $dateTimeFactory;
    //Déclarations nécessaires pour l'appel lors des tables relationnelles
    private UserRepository $userRepository;
    private GameRepository $gameRepository;
    private CategoryRepository $categoryRepository;
    private CreatorRepository $creatorRepository;
    private PlatformRepository $platformRepository;

    public function __construct(UserPasswordHasherInterface $hasher, DateTimeFactory $dateTimeFactory, UserRepository $userRepository, GameRepository $gameRepository, CategoryRepository $categoryRepository, CreatorRepository $creatorRepository, PlatformRepository $platformRepository)
    {
        $this->hasher = $hasher;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->userRepository = $userRepository;
        $this->gameRepository = $gameRepository;
        $this->categoryRepository = $categoryRepository;
        $this->creatorRepository = $creatorRepository;
        $this->platformRepository = $platformRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // USER DATA
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername('User '.$i);
            $password = $this->hasher->hashPassword($user, 'pass_1234');
            $user->setPassword($password);

            $manager->persist($user);
        }
        $manager->flush();

        // GAME DATA
        for ($i = 0; $i < 20; $i++) {
            $game = new Game();
            $game->setTitle('Title '.$i);
            $game->setDescription('Description '.$i);
            // Fixture liée à la date de création
            $dummyDateString = '2000-01-01';
            $dummyDate = $this->dateTimeFactory->createDateTimeImmutable($dummyDateString);
            $game->setReleaseDate($dummyDate);
            $game->setImage('images/devil_may_cry_3.jpg');

            $manager->persist($game);
        }
        $manager->flush();

        // CATEGORIE DATA
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('Nom Catégorie '.$i);
            $manager->persist($category);
        }
        $manager->flush();

        // CREATOR DATA
        for ($i = 0; $i < 10; $i++) {
            $creator = new Creator();
            $creator->setName('Nom Créateur '.$i);
            $manager->persist($creator);
        }
        $manager->flush();

        // PLATFORM DATA
        for ($i = 0; $i < 10; $i++) {
            $platform = new Platform();
            $platform->setName('Nom Platforme '.$i);
            $manager->persist($platform);
        }
        $manager->flush();

        // GAME-USER TABLE RELATIONNEL DATA

        $games = $this->gameRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        for ($i = 0; $i < 10; $i++) {

            $game = $games[random_int(0, 10)];
            $category = $categories[random_int(0, 9)];
            $gameCategory = new GameCategory();
            $gameCategory->setCategoryId($category);
            $gameCategory->setGameId($game);

            $manager->persist($gameCategory);
        }
        $manager->flush();

        // GAME-CREATOR TABLE RELATIONNEL DATA

        $games = $this->gameRepository->findAll();
        $creators = $this->creatorRepository->findAll();

        for ($i = 0; $i < 10; $i++) {

            $game = $games[random_int(0, 10)];
            $creator = $creators[random_int(0, 9)];
            $gameCreator = new GameCreator();
            $gameCreator->setCreatorId($creator);
            $gameCreator->setGameId($game);

            $manager->persist($gameCreator);
        }
        $manager->flush();

        // GAME-PLATFORM TABLE RELATIONNEL DATA

        $games = $this->gameRepository->findAll();
        $platforms = $this->platformRepository->findAll();

        for ($i = 0; $i < 10; $i++) {

            $game = $games[random_int(0, 10)];
            $platform = $platforms[random_int(0, 9)];
            $gamePlatform = new GamePlatform();
            $gamePlatform->setPlatformId($platform);
            $gamePlatform->setGameId($game);

            $manager->persist($gamePlatform);
        }
        $manager->flush();

        // GAME-USER TABLE RELATIONNEL DATA

        $games = $this->gameRepository->findAll();
        $users = $this->userRepository->findAll();
        $statuts = ['Terminé', 'En cours', 'Wishlist', 'Abandonné'];

        for ($i = 0; $i < 10; $i++) {

            $game = $games[random_int(0, 10)];
            $user = $users[random_int(0, 10)];
            $gameUser = new GameUser();
            $gameUser->setUserId($user);
            $gameUser->setGameId($game);
            $gameUser->setNote(random_int(0, 5));
            $gameUser->setStatut(array_rand($statuts));
            $gameUser->setTimeSpent(random_int(0, 200));
            $gameUser->setIsFavorited(random_int(0, 1));

            $manager->persist($gameUser);
        }
        $manager->flush();
    }
}
