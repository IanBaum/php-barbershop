<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Barber.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=barbershop_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BarberTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Barber::deleteAll();
        }
        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "Bob";
            $test_barber = new Barber($name, $id);
            //Act
            $result = $test_barber->getId();
            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "Bob";
            $test_barber = new Barber($name);
            //Act
            $result = $test_barber->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Bob";
            $test_barber = new Barber($name);
            $new_name = "Bill";
            //Act
            $test_barber->setName($new_name);
            $result = $test_barber->getName();
            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Bill";
            $test_barber = new Barber($name);
            $test_barber->save();

            //Act
            $result = Barber::getAll();

            //Assert
            $this->assertEquals($test_barber, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Bill";
            $test_barber = new Barber($name);
            $test_barber->save();

            $name2 = "John";
            $test_barber2 = new Barber($name2);
            $test_barber2->save();

            //Act
            $result = Barber::getAll();

            //Assert
            $this->assertEquals([$test_barber, $test_barber2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bill";
            $test_barber = new Barber($name);
            $test_barber->save();

            $name2 = "John";
            $test_barber2 = new Barber($name2);
            $test_barber2->save();

            //Act
            Barber::deleteAll();
            $result = Barber::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Bill";
            $test_barber = new Barber($name);
            $test_barber->save();

            $name2 = "John";
            $test_barber2 = new Barber($name2);
            $test_barber2->save();

            //Act
            $result = Barber::find($test_barber->getId());

            //Assert
            $this->assertEquals($test_barber, $result);
        }

        function test_update()
        {
            //Arrange
            $name="Bill";
            $test_barber = new Barber($name);
            $test_barber->save();
            $new_name = "David";

            //Act
            $test_barber->update($new_name);

            //Assert
            $result = $test_barber->getName();
            $this->assertEquals($new_name, $result);
        }

        function testGetClients()
        {
            //Arrange
            $barber_name = "Bill";
            $test_barber = new Barber($barber_name);
            $test_barber->save();
            $barber_id = $test_barber->getId();

            $barber_name2 = "Frank";
            $test_barber2 = new Barber($barber_name);
            $test_barber2->save();
            $barber_id2 = $test_barber2->getId();

            $client_name = "Tim";
            $test_client = new Client($client_name, $barber_id);
            $test_client->save();

            $client_name2 = "Joe";
            $test_client2 = new Client($client_name2, $barber_id);
            $test_client2->save();

            $client_name3 = "Mike";
            $test_client3 = new Client($client_name3, $barber_id2);
            $test_client3->save();

            //Act
            $result = $test_barber->getClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }
    }
?>
