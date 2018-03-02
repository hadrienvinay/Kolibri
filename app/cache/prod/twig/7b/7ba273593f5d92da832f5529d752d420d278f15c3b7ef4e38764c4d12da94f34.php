<?php

/* ::layout.html.twig */
class __TwigTemplate_31c56ce31dc45af986b9aa928903e273d81176ae886c4793f0cc95658e8cb6dc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<!DOCTYPE html>
<html>
<head>
  ";
        // line 5
        $this->loadTemplate("::header.html.twig", "::layout.html.twig", 5)->display(array());
        // line 6
        echo "</head>

<body class=\"body\">

    <header class=\"navbar navbar-default navbar-static-top header\" style=\"background-image: url('";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("images/header.png"), "html", null, true);
        echo "');\">
            <div class=\"nav navbar-top-links navbar-right\" >
                <div class=\"\" style=\"padding-top: 2em; padding-right: 2em;\">
                    <ul class=\"nav navbar-nav\">

                        <li><a href=\"";
        // line 15
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("ko_project_liste");
        echo "\"><span class=\"glyphicon glyphicon-send\"></span> Annonces</a></li>
                        <li class=\"\"><a href=\"#\"><span class=\"glyphicon glyphicon-plane\"></span> Profil</a></li>
                        <li><a href=\"#\"><span class=\"glyphicon glyphicon-cloud\"></span> Link</a></li>

                        <!-- Dropdown-->
                        <li class=\" \" id=\"dropdown\">
                            <a data-toggle=\"collapse\" href=\"#dropdown-lvl1\">
                                <span class=\"glyphicon glyphicon-user\"></span> Sub Level <span class=\"caret\"></span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id=\"dropdown-lvl1\" class=\"panel-collapse collapse\">
                                <div class=\"panel-body\">
                                    <ul class=\"nav navbar-nav\">
                                        <li><a href=\"#\">Link</a></li>
                                        <li><a href=\"#\">Link</a></li>
                                        <li><a href=\"#\">Link</a></li>

                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li><a href=\"";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("ko_user_utilisateur");
        echo "\"><span class=\"glyphicon glyphicon-signal\"></span> Users</a></li>

                        <li><a href=\"";
        // line 39
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("ko_project_create_post");
        echo "\"><span class=\"glyphicon glyphicon-plus\"></span> Nouvelle Annonce</a></li>

                    </ul>
                ";
        // line 42
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 43
            echo "                    Connecté en tant que ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "username", array()), "html", null, true);
            echo "
                    <a class=\"btn btn-primary btn-lg\" href=\"";
            // line 44
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_logout");
            echo "\">Déconnexion</a>
                ";
        } else {
            // line 46
            echo "                    <a class=\"btn btn-outline btn-success btn-lg\" style=\"margin-right: 1em;\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_registration_register");
            echo "\" >Inscription »</a>
                    <a class=\"btn btn-outline btn-primary btn-lg\" href=\"";
            // line 47
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_login");
            echo "\">Connexion</a>
                ";
        }
        // line 49
        echo "            </div>
        </div>
        <div class=\"nav navbar-top-links navbar-left\">
        <a href=\"";
        // line 52
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("ko_project_accueil");
        echo "\">
             <img src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("images/logo.png"), "html", null, true);
        echo "\" >
        </a>
        </div>
    </header>




        ";
        // line 61
        $this->displayBlock('content', $context, $blocks);
        // line 62
        echo "
";
        // line 63
        $this->displayBlock('javascripts', $context, $blocks);
        // line 68
        echo "
</body>
</html>";
    }

    // line 61
    public function block_content($context, array $blocks = array())
    {
        echo " ";
    }

    // line 63
    public function block_javascripts($context, array $blocks = array())
    {
        // line 64
        echo "    ";
        // line 65
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 65,  142 => 64,  139 => 63,  133 => 61,  127 => 68,  125 => 63,  122 => 62,  120 => 61,  109 => 53,  105 => 52,  100 => 49,  95 => 47,  90 => 46,  85 => 44,  80 => 43,  78 => 42,  72 => 39,  67 => 37,  42 => 15,  34 => 10,  28 => 6,  26 => 5,  21 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "::layout.html.twig", "C:\\MAMP\\htdocs\\Kolibri\\app/Resources\\views/layout.html.twig");
    }
}
