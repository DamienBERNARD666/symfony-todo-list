<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Status;
use App\Entity\ToDo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $status = new Status();
        $status->setLabel("En attente");
        $manager->persist($status);

        $status = new Status();
        $status->setLabel("A faire");
        $manager->persist($status);


        $status = new Status();
        $status->setLabel("Cloturée");
        $manager->persist($status);

        $project = new Project();
        $project->setLabel("Module Constat");
        $manager->persist($project);

        $toDos = new Todo();
        $toDos->setTask("Lire documentation");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);


        $project = new Project();
        $project->setLabel("Recrutement");
        $manager->persist($project);

        $project = new Project();
        $project->setLabel("Module Devis");
        $manager->persist($project);

        $status = new Status();
        $status->setLabel("Terminée");
        $manager->persist($status);

        $toDos = new Todo();
        $toDos->setTask("Faire des cookies");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);


        $project = new Project();
        $project->setLabel("Module Agenda");
        $manager->persist($project);

        $project = new Project();
        $project->setLabel("Plate Forme");
        $manager->persist($project);

        $project = new Project();
        $project->setLabel("CRM client");
        $manager->persist($project);

        
        $toDos = new Todo();
        $toDos->setTask("Faire la page de couverture");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);

        $project = new Project();
        $project->setLabel("Administration");
        $manager->persist($project);

        
        $status = new Status();
        $status->setLabel("En cours");
        $manager->persist($status);

        
        $toDos = new Todo();
        $toDos->setTask("Faire les comptes");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);

        $project = new Project();
        $project->setLabel("Mobile Constat");
        $manager->persist($project);

        $project = new Project();
        $project->setLabel("Mobile Client");
        $manager->persist($project);


        $toDos = new Todo();
        $toDos->setTask("Lessive");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);

        
        $toDos = new Todo();
        $toDos->setTask("Faire test");
        $toDos->setProject($project);
        $toDos->setStatus($status);
        $manager->persist($toDos);


        $manager->flush();
    }
}
