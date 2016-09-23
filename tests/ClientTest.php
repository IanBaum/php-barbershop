<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Barber.php";

    $server = 'mysql:host=localhost:8889;dbname=barbershop_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearchown()
        {
          Barber::deleteAll();
          Task::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $id = 1;
            $client_name = "Tim";
            $test_client = new Client($client_name, $barber_id, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
          //Arrange
          $barber_name = "Bill";
          $test_barber = new Barber($barber_name);
          $test_barber->save();
          $barber_id = $test_barber->getId();

          $client_name = "Tim";
          $test_client = new Client($client_name, $barber_id);

          //Act
          $result = $test_client->getName();

          //Assert
          $this->assertEquals($client_name, $result);
        }

        function test_setName()
        {
          //Arrange
          $barber_name = "Bill";
          $test_barber = new Barber($barber_name);
          $test_barber->save();
          $barber_id = $test_barber->getId();

          $client_name = "Tim";
          $test_client = new Client($client_name, $barber_id);
          $new_client_name = "Joe";

          //Act
          $test_client->setName($new_client_name);
          $result = $test_client->getName();

          //Assert
          $this->assertEquals($new_client_name, $result);
        }

        function test_getBarberId()
        {
          //Arrange
          $barber_name = "Bill";
          $test_barber = new Barber($barber_name);
          $test_barber->save();
          $barber_id = $test_barber->getId();

          $client_name = "Tim";
          $test_client = new Client($client_name, $barber_id);

          //Act
          $result = $test_client->getBarberId();

          //Assert
          $this->assertEquals($barber_id, $result);
        }

        function test_setBarberId()
        {
          //Arrange
          $barber_name = "Bill";
          $test_barber = new Barber($barber_name);
          $test_barber->save();
          $barber_id = $test_barber->getId();

          $barber_name2 = "Frank";
          $test_barber2 = new Barber($barber_name2);
          $test_barber->save();
          $barber_id2 = $test_barber2->getId();

          $client_name = "Tim";
          $test_client = new Client($client_name, $barber_id);

          //Act
          $test_client->setBarberId($barber_id2);
          $result = $test_client->getBarberId();

          //Assert
          $this->assertEquals($barber_id2, $result);
        }
    }
?>
