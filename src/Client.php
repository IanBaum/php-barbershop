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
    }

?>
