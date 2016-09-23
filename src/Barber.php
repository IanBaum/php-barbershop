<?php
    class Barber
    {
      private $name;
      private $id;

      function __construct($name, $id = null)
      {
          $this->name = $name;
          $this->id = $id;
      }

      function getId()
      {
          return $this->id;
      }

      function getName()
      {
          return $this->name;
      }

      function setName($new_name)
      {
          $this->name = (string) $new_name;
      }

      function save()
      {
          $GLOBALS['DB']->exec("INSERT INTO barbers (name) VALUES ('{$this->getName()}')");
          $this->id = $GLOBALS['DB']->lastInsertId();
      }

      static function getAll()
      {
          $returned_barbers = $GLOBALS['DB']->query("SELECT * FROM barbers;");
          $barbers = array();
          foreach($returned_barbers as $barber){
              $name = $barber['name'];
              $id = $barber['id'];
              $new_barber = new Barber($name, $id);
              array_push($barbers, $new_barber);
          }
          return $barbers;
      }

      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM barbers;");
      }
    }
?>
