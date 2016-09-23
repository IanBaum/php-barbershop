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

        static function find($search_id)
        {
            $found_barber = null;
            $barbers = Barber::getAll();
            foreach($barbers as $barber){
                $barber_id = $barber->getId();
                if($barber_id == $search_id){
                    $found_barber = $barber;
                }
            }
            return $found_barber;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE barbers SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE barber_id = {$this->getId()};");
            foreach($returned_clients as $client){
                $name = $client['name'];
                $id = $client['id'];
                $barber_id = $client['barber_id'];
                $new_client = new Client($name, $barber_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
    }
?>
