<?php

namespace App\Controller;

use App\Entity\BonsTravail;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends AbstractController
{
   public function index(int $id, ManagerRegistry $doctrine): Response {

       $repository = $doctrine->getRepository(BonsTravail::class);
       $bon = $repository->findOneBy(array(
           'id' => $id
       ));
       return new BinaryFileResponse('../src/file/' . $bon);
   }
}
