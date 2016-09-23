<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Barber.php";

    $server = 'mysql:host=localhost:8889;dbname=barbershop';
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
            $name2 = "John";
            $test_barber = new Barber($name);
            $test_barber->save();
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
            $name2 = "John";
            $test_barber = new Barber($name);
            $test_barber->save();
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
            $name2 = "John";
            $test_barber = new Barber($name);
            $test_barber->save();
            $test_barber2 = new Barber($name2);
            $test_barber2->save();

            //Act
            $result = Barber::find($test_barber->getId());

            //Assert
            $this->assertEquals($test_barber, $result);
        }
    }
?>
