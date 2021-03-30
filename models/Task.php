<?php

    class Task
    {
        private $_isDone;
        private $_description;
        private $_noTask;

        public function __construct()
        {
            $ctp = func_num_args();
            $args = func_get_args();
            switch($ctp)
            {
                case 1:
                    $this->hydrate($args[0]);
                    break;
                case 2:
                    $this->create($args[0],$args[1]);
                    break;
                default:
                    throw new Exception("Invalid utilisateur constructeur");
            }
        }

        private function create($description,$isDone)
        {
            $this->setIsDone($isDone);
            $this->setDescription($description);
        }

        //APPEL LE SETTER DE CHACUNS DES ATTRIBUTS
        public function hydrate(array $data)
        {
            foreach($data as $element => $value)
            {
                $method = 'set'.ucfirst($element);
                if(method_exists($this,$method))
                    $this->$method($value);
            }
        }

        public function setIsDone($isDone)
        {
            if(is_string($isDone))
            {
                $this->_isDone = $isDone;
            }
            else
            {
                throw new Exception("isDone is invalid");
            }
        }

        public function setDescription($description)
        {
            if(is_string($description))
            {
                $this->_description=$description;
            }
            else
            {
                throw new Exception("description is invalid");
            }
        }

        /**
         * @param mixed $noTask
         */
        public function setNoTask($noTask)
        {
            if(is_string($noTask))
            {
                $this->_noTask=$noTask;
            }
            else
            {
                throw new Exception("noProject is invalid");
            }
        }

        /**
         * @return mixed
         */
        public function getNoTask()
        {
            return $this->_noTask;
        }

        public function getIsDone()
        {
            return $this->_isDone;
        }

        public function getDescription()
        {
            return $this->_description;
        }
}
