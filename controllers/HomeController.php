<?php

class HomeController
{
    private $gateway;
    private Project $projectSelect;
    private $tasksOption;

    public function __construct()
    {
        global $views;
        $array = $this->init();
        $projects=$array['Projects'];
        $tasks=$array['Tasks'];
        $this->tasksOption=$tasks;
        if (isset($_REQUEST['option']))
        {
            $action = Validation::valid_url($_REQUEST['option']);
            switch ($action)
            {
                case 'addProj':
                    $this->addProject();
                    break;
                case 'removeProj':
                    $this->removeProject();
                    break;
                case 'renameProj':
                    $this->renameProject();
                    break;
                case 'addTask':
                    $this->addTask();
                    break;
                case 'removeTasks':
                    $this->removeTasks();
                    break;
                case 'markTasksDo':
                    $this->markTasksDo();
                    break;
                case 'markTasksDone':
                    $this->markTasksDone();
                    break;
                default:
                    throw new Exception('Option not found');
            }
            if(isset($_REQUEST['project']) && !empty($_REQUEST['project'] && $_REQUEST['option']!='removeProj'))
            {
                header('Location: ./?project='.$_REQUEST['project']);
            }
            else
            {
                header('Location: ./?action=home');
            }

        }
        require_once($views['home']);
    }

    private function init()
    {
        global $views,$db,$login,$mdp;
        $projects = [];
        $tasks = [];
        $this->gateway = new ProjectGateway($db,$login,$mdp);
        $projects = $this->gateway->getPublicProjects();
        if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
        {
            $projects = array_merge($projects,$this->gateway->getPrivateProjects());
        }
        $tasks = $this->getTasks($projects);
        $array = array('Projects','Tasks');
        $array['Projects']=$projects;
        $array['Tasks']=$tasks;
        return $array;
    }

    private function getTasks(array $projects)
    {
        if (isset($_REQUEST['project']))
        {
           $indexProject = Validation::valid_url($_REQUEST['project']);
           if(!ctype_digit($indexProject) || $indexProject>=count($projects) || $indexProject<0)
                throw new Exception("Projet introuvable");
           $tasks = $this->gateway->getTasks($projects[$indexProject]);
           $this->projectSelect=$projects[$indexProject];
           return $tasks;
        }
    }

    private function addProject()
    {
        global $db,$login,$mdp;
        $Utilisateur = new UtilisateurGateway($db,$login,$mdp);
        if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
        {
            $this->gateway->addProject(new Project("NewPrivateProject","0"),$Utilisateur->getNoUserConnected());
        }
        else{
            $this->gateway->addProject(new Project("NewPublicProject","1"),0);
        }

    }

    private function removeProject()
    {
        if(isset($this->projectSelect))
        {
            $this->gateway->delProject($this->projectSelect);
        }
    }

    private function renameProject()
    {
        if(isset($this->projectSelect) && isset($_REQUEST["newName"]) && !empty($_REQUEST["newName"]))
        {
            $this->gateway->renameProject($this->projectSelect,$_REQUEST['newName']);
        }
    }

    private function addTask()
    {
        if(isset($_REQUEST["nameNewTask"]) && isset($this->projectSelect) && !empty($_REQUEST["nameNewTask"]))
        {
            $this->gateway->addTask(new Task($_REQUEST["nameNewTask"],"0"),$this->projectSelect);
        }
    }

    private function removeTasks()
    {
        if(isset( $_REQUEST['nbCheckBox']) && !empty( $_REQUEST['nbCheckBox']))
        {
            $nbTasks = Validation::valid_int($_REQUEST['nbCheckBox']);

            for ($i = 0; $i < $nbTasks; $i++)
            {
                if (isset($_REQUEST['task' . $i]) && !empty($_REQUEST['task' . $i]) && $_REQUEST['task' . $i] = 'on') {
                    $this->gateway->delTask($this->tasksOption[$i]);
                }
            }
        }
    }

    private function markTasksDo()
    {
        if(isset( $_REQUEST['nbCheckBox']) && !empty( $_REQUEST['nbCheckBox']))
        {
            $nbTasks = Validation::valid_int($_REQUEST['nbCheckBox']);

            for ($i = 0; $i < $nbTasks; $i++)
            {
                if (isset($_REQUEST['task' . $i]) && !empty($_REQUEST['task' . $i]) && $_REQUEST['task' . $i] = 'on') {
                    $this->gateway->setTaskIsNotDone($this->tasksOption[$i]);
                }
            }
        }
    }

    private function markTasksDone()
    {
        if(isset( $_REQUEST['nbCheckBox']) && !empty( $_REQUEST['nbCheckBox']))
        {
            $nbTasks = Validation::valid_int($_REQUEST['nbCheckBox']);

            for ($i = 0; $i < $nbTasks; $i++) {
                if(isset($_REQUEST['task'.$i]) && !empty($_REQUEST['task'.$i]) && $_REQUEST['task'.$i]='on')
                {
                    $this->gateway->setTaskIsDone($this->tasksOption[$i]);
                }
            }
        }

    }
}