<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 11/10/2017
 * Time: 09:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserTypeOld;
use AppBundle\Entity\UserOld;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationController
 * @package AppBundle\Controller
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/registration", name="user_registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new UserOld();
        $form = $this->createForm(UserTypeOld::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getUserPassword());
            $user->setUserPassword($password);

            // 4) save the UserOld!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/user/{UserId}", name = "Update")
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @internal param $UserId = {id}
     */
    public function updateAction(User $user, UserPasswordEncoderInterface $passwordEncoder, Request $request)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '
            );
        }
        $form = $this->createForm(UserTypeOld::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getUserPassword());
            $user->setUserPassword($password);

            // 4) save the UserOld!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );

    }

    /**
     * @Route("/userDel/{UserId}", name = "Delete")
     * @param User $User
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @internal param UserId $UserId
     */
    public function deleteAction(User $User, Request $request)
    {
        if (!$User) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        return $this->redirectToRoute('home');

    }
}