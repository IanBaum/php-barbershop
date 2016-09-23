<?php
    class Client
    {
        private $name;
        private $barber_id;
        private $id;

        function __construct($name, $barber_id, $id=null)
        {
            $this->name = $name;
            $this->barber_id = $barber_id;
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

        function getBarberId()
        {
            return $this->barber_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setBarberId($new_barber_id)
        {
            $this->barber_id = (int) $new_barber_id;
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO clients (name,barber_id) VALUES ('{$this->getName()}', {$this->getBarberId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $id = $client['id'];
                $barber_id = $client['barber_id'];
                $new_client = new Client($name, $barber_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }
    }

?>
