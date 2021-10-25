<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
	/**
     * @Route("/accessDenied", name="accessDenied")
     */
    public function accessDenied(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('config/Noaccees.html.twig');
    }

	
	/**
     * @Route("/user/usertest", name="usertest")
     */
    public function usertest(Request $request)
    {
var_dump ('user');
exit();
	}
	
	/**
     * @Route("/admin/admintest", name="admintest")
     */
    public function admintest(Request $request)
    {
		var_dump( 'admintest');
		exit();
	}
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
   $user->setRoles (array('ROLE_USER'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $this->addFlash(
            'success',
            'Ajout se fait avec succès '
        );
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig',
            array('form' => $form->createView())
        );
    }
 /**
     * @Route("/registeradmin", name="user_registrationadmin")
     */
    public function registeradmin(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
$user->setRoles (array('ROLE_ADMIN'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
            'success',
            'Ajout se fait avec succès '
        );
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig',
            array('form' => $form->createView())
        );
    }
  /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request)

    {
        $user = $this->getUser();

return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/editprofil", name="editprofil")
     */
    public function editprofil(Request $request)

    {
        $user = $this->getUser();
   $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/editprofil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
     /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
