<?php
/**
 * Created by PhpStorm.
 * User: hadrien
 * Date: 19/12/2017
 * Time: 16:23
 */
// src/DataFixtures/AppFixtures.php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Ko\MainBundle\Entity\Driver;
use Ko\MainBundle\Entity\Producer;
use Ko\MainBundle\Entity\Proposal;
use Ko\MainBundle\Entity\Trip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Exception\Exception;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*/ create a driver name : aa and pass: aa;
       $user1 = new User();
       $user1->setUsername('aa');
       $user1->setPlainPassword('aa');
       $user1->setDescription('Bonjour je suis un driver qui habite à Rennes et qui fais des trajets réguliers à Marseille');
       $user1->setEmail('aa@gmail.com');
       $user1->setFirstName('aa');
       $user1->setLastName('aa');
       $user1->setType(1);
       $user1->setEnabled(1);
       $manager->persist($user1);
       $manager->flush();

       // create an admin : admin and pass: pass;
       $userAdmin = new User();
       $userAdmin->setUsername('admin');
       $userAdmin->setPlainPassword('pass');
       $userAdmin->setDescription('Admin');
       $userAdmin->setEmail('admin@gmail.com');
       $userAdmin->setFirstName('admin');
       $userAdmin->setLastName('super');
       $userAdmin->setType(0);
       $userAdmin->setEnabled(1);
       $userAdmin->setRoles(array('ROLE_ADMIN'));
       $manager->persist($userAdmin);
       $manager->flush();

       // create a producter name : bb and pass: bb;
       $user2 = new User();
       $user2->setUsername('bb');
       $user2->setPlainPassword('b');
       $user2->setEmail('bb@gmail.com');
       $user2->setFirstName('bb');
       $user2->setLastName('bb');
       $user2->setType(2);
       $user2->setEnabled(2);
       $manager->persist($user2);
       $manager->flush();

       $drivernew = new Driver();
       $drivernew->setUserId($user1);
       $drivernew->setCity('Paris');
       $drivernew->setLicenceCheck(1);

       $producernew = new Producer();
       $producernew->setUserId($user2);

       $manager->persist($drivernew);
       $manager->flush();
       $manager->persist($producernew);
       $manager->flush();
       */


    $geocoder = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDGumVlc4KEBNmAwrso9w5faYMf62JXLBU&address=%s&sensor=false";

        // create a driver name : aa and pass: aa;
      $user1 = new User();
      $user1->setUsername('aa');
      $user1->setPlainPassword('aa');
      $user1->setDescription('Bonjour je suis un driver qui habite à Rennes et qui fais des trajets réguliers à Marseille');
      $user1->setEmail('aa@gmail.com');
      $user1->setFirstName('aa');
      $user1->setLastName('aa');
      $user1->setType(1);
      $user1->setRoles(array('ROLE_USER'));
      $user1->setEnabled(1);
      $user1->setPicture('profil_pic.png');

      $manager->persist($user1);
      $manager->flush();

      // create an admin : admin and pass: pass;
      $userAdmin = new User();
      $userAdmin->setUsername('admin');
      $userAdmin->setPlainPassword('pass');
      $userAdmin->setDescription('Admin');
      $userAdmin->setEmail('admin@gmail.com');
      $userAdmin->setFirstName('admin');
      $userAdmin->setLastName('super');
      $userAdmin->setType(0);
      $userAdmin->setEnabled(1);
      $userAdmin->setRoles(array('ROLE_ADMIN'));

      $manager->persist($userAdmin);
      $manager->flush();

      // create a producter name : bb and pass: bb;
      $user2 = new User();
      $user2->setUsername('bb');
      $user2->setPlainPassword('bb');
      $user2->setEmail('bb@gmail.com');
      $user2->setDescription('Bonjour je suis un producteur qui produit à Rennnes et qui livre à Paris principalement des petits colis');$user2->setFirstName('bb');
      $user2->setLastName('bb');
      $user2->setType(2);
      $user2->setRoles(array('ROLE_PRODUCER'));
      $user2->setEnabled(2);
      $user2->setPicture('profil_pic.png');

      $manager->persist($user2);
      $manager->flush();


      $producer= new Producer();
      $producer->setUserId($user2);
      $manager->persist($producer);
      $manager->flush();


      $driver = new Driver();
      $driver->setUserId($user1);
      $manager->persist($driver);
      $manager->flush();

        $users = json_decode(file_get_contents( "%kernel.root_dir%/../web/db_kokolo_users.json" ), true);
        $trips = json_decode(file_get_contents( "%kernel.root_dir%/../web/db_kokolo_trips.json" ), true);

        $mem = 0;
        foreach($users as $user){
            $user_temp = new User();
            $user_temp->setUsername($user['firstName']);
            $user_temp->setPlainPassword('password');
            $user_temp->setDescription('');
            $user_temp->setEmail($user['firstName'].'@gmail.com');
            $user_temp->setFirstName($user['firstName']);
            $user_temp->setLastName($user['lastName']);
            $user_temp->setType($user['type']);
            $user_temp->setDescription($user['description']);
            $user_temp->setPicture('profil_pic.png');
            $user_temp->setEnabled(1);
            $manager->persist($user_temp);
            $manager->flush();


            if($user['type']==1)
            {
                $user_temp->setRoles(array('ROLE_USER'));
                $driver1 = new Driver();
                $driver1->setUserId($user_temp);
                $driver1->setCity('');
                $driver1->setLicenceCheck(false);
                $manager->persist($driver1);
                $manager->flush();

            }
            else{
                $user_temp->setRoles(array('ROLE_PRODUCER'));
                $producor1 = new Producer();
                $producor1->setUserId($user_temp);
                $producor1->setAddress('');
                $producor1->setCompanyName('');
                $producor1->setSiret('');
                $manager->persist($producor1);
                $manager->flush();
                for($i=$mem*3;$i<$mem*3+3;$i++){
                    $trip_temp = new Trip();
                    $trip_temp->setProducerId($producor1);
                    $trip_temp->setAddressDeparture($trips[$i]['Departure']);
                    $trip_temp->setAddressArrival($trips[$i]['Arrival']);
//                        try {
//                            $trip_temp->setDateBegin(new \DateTime(strtotime($trips[$i]['Begin'])));
//                            $trip_temp->setDateEnd(new \DateTime(strtotime($trips[$i]['End'])));
//                        }
//                        catch(Exception $e) {
                    $timestamp_end = 1514118002;
                    $timestamp_begin =1483273202;
                    $timestamp_rand = random_int($timestamp_begin,$timestamp_end);
                    $trip_temp->setDateBegin(new \DateTime('@'.$timestamp_rand));
                    $timestamp_rand_end=$timestamp_rand+1000000;
                    $trip_temp->setDateEnd(new \DateTime('@'.$timestamp_rand_end));
//                        }
                    $trip_temp->setTypeProduct($trips[$i]['Product']);
                    $trip_temp->setSizeCar($trips[$i]['size_car']);
                    $trip_temp->setBigPack($trips[$i]['Big_pack']);
                    $trip_temp->setSmallPack($trips[$i]['Small_pack']);
                    $trip_temp->setMedPack($trips[$i]['Med_pack']);

                    // Get latitude and lonfitude depart and arrival place
                    $query = sprintf($geocoder, urlencode(utf8_encode($trip_temp->getAddressDeparture())));
                    $result = json_decode(file_get_contents($query));

                    if(empty($result->results)){
                        $latitudeDepart = 0;
                        $longitudeDepart = 0;
                    }
                    else {
                        $json = $result->results[0];
                        $latitudeDepart = (float) $json->geometry->location->lat;
                        $longitudeDepart = (float) $json->geometry->location->lng;
                        $trip_temp->setLatitudeStart($latitudeDepart);
                        $trip_temp->setLongitudeStart($longitudeDepart);
                    }

                    // Get latitude and lonfitude depart and arrival place
                    $query = sprintf($geocoder, urlencode(utf8_encode($trip_temp->getAddressDeparture())));
                    $result = json_decode(file_get_contents($query));

                    if(empty($result->results)){
                        $latitudeArrival = 0;
                        $longitudeArrival = 0;
                    }
                    else {
                        $json = $result->results[0];
                        $latitudeArrival = (float) $json->geometry->location->lat;
                        $longitudeArrival = (float) $json->geometry->location->lng;
                        $trip_temp->setLatitudeEnd($latitudeArrival);
                        $trip_temp->setLongitudeEnd($longitudeArrival);
                    }

                    $manager->persist($trip_temp);
                    $manager->flush();
                }
                $mem=$mem+1;
            }

            $manager->persist($user_temp);
            $manager->flush();

        }

        /*
                $trip1->setDescription('First Trip');
                $trip1->setAddressArrival('Paris');
                $trip1->setAddressDeparture('Rennes');
                $trip1->setDateBegin(new \DateTime());
                $trip1->setDateEnd(new \DateTime());
                $trip1->setProducerId($producor1);
                $trip1->setTypeProduct('Carottes');
                $trip1->setHourClose(15);
                $trip1->setHourOpen(10);
                $trip1->setSize(2);

                $trip2->setDescription('Second Trip');
                $trip2->setAddressArrival('Lille');
                $trip2->setAddressDeparture('Bordeaux');
                $trip2->setDateBegin(new \DateTime());
                $trip2->setDateEnd(new \DateTime());
                $trip2->setProducerId($producor2);
                $trip2->setTypeProduct('Meubles');
                $trip2->setHourClose(19);
                $trip2->setHourOpen(8);
                $trip2->setSize(1);


                $manager->persist($trip1);
                $manager->persist($trip2);


                $manager->flush();*/
    }
}