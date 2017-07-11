<?php
/**
 * Created by PhpStorm.
 * User: 3WRE
 * Date: 19/06/2017
 * Time: 12:35
 */
// src/Ko/UserBundle/Controller/SecurityController.php;

namespace Ko\UserBundle\Controller;

use Ko\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('KoProjectBundle:Home:indexView.html.twig');
        }
        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('KoUserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function utilisateurAction()
    {
        $userManger = $this->get('fos_user.user_manager');
        $user = $userManger->findUsers();
        return $this->render('@KoUser/User/listUser.html.twig', array(
            'users' => $user,
        ));

    }

}