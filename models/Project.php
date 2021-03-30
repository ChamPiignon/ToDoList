<?php

class Project
{
    private $_title;
    private $_isPublic;
    private $_noProject;

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
    private function create($title,$isPublic)
    {
        $this->setIsPublic($isPublic);
        $this->setTitle($title);
    }

    //APPEL LE SETTER DE CHACUNS DES ATTRIBUTS
    private function hydrate(array $data)
    {
        foreach ($data as $element => $value) {
            $method = 'set' . ucfirst($element);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->_title = $title;
        } else {
            throw new Exception("Exception: title is invalid in ".get_called_class());
        }
    }

    public function setIsPublic($isPublic)
    {
        if (is_string($isPublic)) {
            $this->_isPublic= $isPublic;
        } else {
            throw new Exception("Exception: isPublic is invalid in ".get_called_class());
        }
    }

    public function setNoProject($noProject)
    {
        if (is_string($noProject)) {
            $this->_noProject= $noProject;
        } else {
            throw new Exception("Exception: noProject is invalid in ".get_called_class());
        }
    }

    /**
     * @return titre du projet
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return
     */
    public function getIsPublic()
    {
        return $this->_isPublic;
    }

    public function getNoProject()
    {
        return $this->_noProject;
    }
}

