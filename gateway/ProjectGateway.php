<?php
class ProjectGateway extends Gateway
{
    public function getPublicProjects(): array
    {
        $projects = [];
        $query = "SELECT * FROM Project WHERE isPublic=1";
        $this->con->executeQuery($query);
        foreach ($this->con->getResults() as $data) {
            $projects[] = new Project($data);
        }
        return $projects;
    }

    public function getPrivateProjects(): array
    {
        $projects = [];
        $query = "SELECT * FROM Project P, Utilisateur u WHERE isPublic=0 AND p.NoUser = u.NoUser AND email=:email";
        $this->con->executeQuery($query, array(':email' => array($_SESSION['utilisateur'], PDO::PARAM_STR)));
        $res=$this->con->getResults();
        foreach ($res as $data) {
            $projects[] = new Project($data);
        }
        return $projects;
    }

    public function addProject(Project $project,$noUser): bool
    {

        $query = 'INSERT INTO Project(noUser, title, isPublic) VALUES (:noUser, :titleProject, :isPublic)';
        return $this->con->executeQuery($query, array
        (
            ':noUser' => array($noUser, PDO::PARAM_STR),
            ':titleProject' => array($project->getTitle(), PDO::PARAM_STR),
            ':isPublic' => array($project->getIsPublic(), PDO::PARAM_BOOL)
        ));
    }



    public function delProject(Project $project)
    {
        $query = 'DELETE FROM Task WHERE noProject=:noProject';
        $this->con->executeQuery($query, array(':noProject' => array($project->getNoProject(), PDO::PARAM_STR)));

        $query = 'DELETE FROM Project WHERE noProject=:noProject';
        $this->con->executeQuery($query, array(':noProject' => array($project->getNoProject(), PDO::PARAM_STR)));
    }

    public function renameProject(Project $project,$title)
    {
        $query = 'UPDATE Project Set title=:title WHERE noProject=:noProject';
        $this->con->executeQuery($query, array
        (
            ':noProject' => array($project->getNoProject(), PDO::PARAM_STR),
            ':title' => array($title, PDO::PARAM_STR)
        ));
    }

    public function getTasks(Project $project): array
    {
        $tasks = [];
        $query = "SELECT * FROM Project P, Task t WHERE p.NoProject=t.NoProject AND p.NoProject=:NoProject";
        $this->con->executeQuery($query, array('NoProject' => array($project->getNoProject(), PDO::PARAM_STR)));
        $res=$this->con->getResults();
        foreach ($res as $data) {
            $tasks[] = new Task($data);
        }
        return $tasks;
    }

    public function setTaskIsDone(Task $task)
    {
        $query = 'UPDATE Task Set isDone=:isDone WHERE noTask=:noTask';
        $this->con->executeQuery($query, array
        (
            ':noTask' => array($task->getNoTask(), PDO::PARAM_STR),
            ':isDone' => array('1', PDO::PARAM_STR)
        ));
    }

    public function setTaskIsNotDone(Task $task)
    {
        $query = 'UPDATE Task Set isDone=:isDone WHERE noTask=:noTask';
        $this->con->executeQuery($query, array
        (
            ':noTask' => array($task->getNoTask(), PDO::PARAM_STR),
            ':isDone' => array('0', PDO::PARAM_STR)
        ));
    }

    public function delTask(Task $task)
    {
        $query = 'DELETE FROM Task WHERE noTask=:noTask';
        $this->con->executeQuery($query, array(':noTask' => array($task->getNoTask(), PDO::PARAM_STR)));
    }

    public function addTask(Task $task,Project $project)
    {
        $query = 'INSERT INTO Task(noProject, isDone, description) VALUES (:noProject, :isDone, :description)';
        return $this->con->executeQuery($query, array
        (
            ':noProject' => array($project->getNoProject(), PDO::PARAM_STR),
            ':isDone' => array($task->getIsDone(), PDO::PARAM_STR),
            ':description' => array($task->getDescription(), PDO::PARAM_STR)
        ));
    }


}

