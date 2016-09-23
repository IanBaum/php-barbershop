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
    }
?>
