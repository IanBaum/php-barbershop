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
        protected function teardown()
        {
          Barber::deleteAll();
          Client::deleteAll();
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

        function test_save()
        {
            //Arrange
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $client_name = "Tim";
            $test_client3 = new Client($client_name, $barber_id);
            $test_client3->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client3, $result[0]);
        }


        function test_getAll()
        {
            //Arrange
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $client_name = "Tim";
            $test_client = new Client($client_name, $barber_id);
            $test_client->save();

            $client_name2 = "Joe";
            $test_client2 = new Client($client_name2, $barber_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client2, $test_client], $result);
        }

        function test_deleteAll()
        {
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $client_name = "Tim";
            $test_client = new Client($client_name, $barber_id);
            $test_client->save();

            $client_name2 = "Joe";
            $test_client2 = new Client($client_name2, $barber_id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $client_name = "Tim";
            $test_client = new Client($client_name, $barber_id);
            $test_client->save();

            $client_name2 = "Joe";
            $test_client2 = new Client($client_name2, $barber_id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }
    }
?>
