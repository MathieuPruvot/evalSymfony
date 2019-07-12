<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $category = new Category();
        $category->setName('informatique');
        $blogPost = new BlogPost();
        $blogPost->setTitle('Article1');
        $blogPost->setSlug('Article1');
        $blogPost->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu sagittis diam, id congue eros. Nulla facilisis pharetra libero. In lacinia risus ut purus tempus venenatis nec id libero. Nulla posuere. ");
        $blogPost->setDate(2018);
        $blogPost->setCategory($category);
        $blogPost->setFeatured(true);

        $manager->persist($category);
        $manager->persist($blogPost);

        $category = new Category();
        $category->setName('divers');
        $blogPost = new BlogPost();
        $blogPost->setTitle('Article2');
        $blogPost->setSlug('Article2');
        $blogPost->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor faucibus dapibus. Donec eu tincidunt lacus, vitae rutrum elit. Curabitur quis nisi at orci euismod pulvinar at eu nisl volutpat");
        $blogPost->setDate(2019);
        $blogPost->setCategory($category);
        $blogPost->setFeatured(true);

        $manager->persist($category);
        $manager->persist($blogPost);

        $user = new User();
        $user->setUsername("admin");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $manager->flush();
    }
}
