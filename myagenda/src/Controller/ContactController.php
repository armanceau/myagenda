<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactController extends AbstractController
{
    #[Route('/contact/{id}', name: 'app_contact')]
    public function index(int $id, ContactRepository $repos): Response
    {
        $contact = $repos->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Aucun produit trouvé pour cet ID : ' . $id);
        }

        return $this->render('contact/index.html.twig', [
            'contact' => $contact,
        ]);
    }

    #[Route('/add/contact', name: 'app_contact_add')]
    public function add(Request $request, entityManagerInterface $entityManager): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Utilisez l'EntityManager pour persister l'utilisateur
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success',"le contact a bien été ajouté");

            // Faites tout ce que vous devez faire après l'ajout

            return $this->redirectToRoute('app_default');
        }

        return $this->render('contact/addContact.html.twig', [
            'NewContactForm' => $form->createView(),
        ]);
    }


    #[Route('/contact/delete/{id}', name: 'app_contact_delete')]
    public function delete(int $id, ContactRepository $repos, Request $request): Response
    {
        $contact = $repos->find($id);

        $repos->remove($contact);

        $this->addFlash('success',"le contact a bien été supprimé");

        return $this->redirectToRoute('app_default');   
    }

    #[Route('/edit/contact/{id}', name: 'app_contact_edit')]
    public function edit(int $id, ContactRepository $repos, Request $request): Response
    {

        $contact = $repos->find($id);

        // Crée le formulaire Symfony
        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control'], // Ajoute la classe Bootstrap 'form-control' à l'input
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control'], // Ajoute la classe Bootstrap 'form-control' à l'input
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'form-control'], // Ajoute la classe Bootstrap 'form-control' à l'input
            ])
            ->add('telephone', TextType::class, [
                'attr' => ['class' => 'form-control'], // Ajoute la classe Bootstrap 'form-control' à l'input
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Modifier ce contact',
                'attr' => ['class' => 'btn btn-primary'], // Ajoute la classe Bootstrap 'btn btn-primary' au bouton
            ])
            ->getForm();

        // Gère la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Les données du formulaire sont disponibles dans $form->getData()
            $formData = $form->getData();

            // Utilisez le repository pour enregistrer les données en base de données
            $repos->save($formData);

            $this->addFlash('success',"le contact a bien été modifié");

            // Redirige vers une autre page ou affiche un message de réussite
            return $this->redirectToRoute('app_default');
        }
        // Rendu de la vue avec le formulaire
        return $this->render('contact/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
