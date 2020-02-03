<?php

namespace App\DataFixtures;

use App\Entity\OrderBody;
use App\Entity\OrderHead;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var \Faker\Factory
     */
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $orderHead = new OrderHead();
            $orderHead->setId($this->faker->numerify("##########"));
            $orderHead->setPhone($this->faker->phoneNumber());
            $orderHead->setShippingStatus($this->faker->boolean(50));
            $orderHead->setShippingPrice($this->faker->randomFloat(2,1,10000));
            $orderHead->setPaymentStatus($this->faker->boolean(70));
            $orderHead->setShippingPaymentStatus($this->faker->boolean(40));
            $manager->persist($orderHead);

            $this->addReference("order_head" . $orderHead->getId(), $orderHead);

            $this->loadOrderBody($manager, $orderHead);
        }
        $manager->flush();
    }

    public function loadOrderBody(ObjectManager $manager,
                                  OrderHead $orderHead)
    {
        for ($i = 0; $i < 5; $i++)
        {
            $orderBody = new OrderBody();
            $orderBody->setBarcode($this->faker->numerify("#############"));
            $orderBody->setCanceled($this->faker->boolean);
            $orderBody->setCost($this->faker->randomFloat(2,10,50));
            $orderBody->setIdOrderHead($orderHead);
            $orderBody->setQuantity(1);
            $orderBody->setPrice($this->faker->randomFloat(2,100,20000));
            $orderBody->setShippedStatusSku($this->faker->boolean);
            $orderBody->setTaxPerc(19);
            $orderBody->setTaxAmt(($orderBody->getPrice() / 100 ) * $orderBody->getTaxPerc() );
            $orderBody->setTrackingNumber($this->faker->numerify("##################"));
            $manager->persist($orderBody);
        }
    }
}
