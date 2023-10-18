<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Classroom;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student/create', name: 'create_student', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_list');
        }

        return $this->render('student/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/student', name: 'student_list', methods: ['GET'])]
    public function list(): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/student/update/{id}', name: 'update_student', methods: ['GET', 'POST'])]
    public function update(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('student_list');
        }

        return $this->render('student/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/student/delete/{id}', name: 'delete_student', methods: ['POST'])]
    public function delete(Request $request, Student $student): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        return $this->redirectToRoute('student_list');
    }
}
