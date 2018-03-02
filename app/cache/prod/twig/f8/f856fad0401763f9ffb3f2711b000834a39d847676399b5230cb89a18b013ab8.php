<?php

/* KoProjectBundle:Home:indexView.html.twig */
class __TwigTemplate_c4cb53051f3fff9e01ea6ad674002a208fd6d34f700e5729deda4ac9ada14a39 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("::layout.html.twig", "KoProjectBundle:Home:indexView.html.twig", 1)->display($context);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    <div id=\"wrapper\" style=\"text-align: center;padding: 2%; \" >
    <div class=\"col-lg-8\" style=\"text-align: center;\">
        ";
        // line 8
        echo "    </div>
    <hr>
    <div class=\"row\" >
        <div class=\"col-lg-6\">

            <div class=\"panel panel-success\">
                <div class=\"panel-heading\">
                    <h2>Je suis Producteur</h2>
                </div>
                <div class=\"panel-body\">
                    Déposer votre annonce<br>
                    Recevez des propositions<br>
                    Validez, et c'est parti<br>
                </div>
                <div class=\"panel-footer\">
                    <a href=\"";
        // line 23
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("ko_project_create_post");
        echo "\" class=\"btn btn-success btn-lg\">Proposer une annonce</a>
                </div>
            </div>


        </div>
        <div class=\"col-lg-6\">
            <div class=\"panel panel-info\">
                <div class=\"panel-heading\">
                    <h2>Je souhaite livrer</h2>
                </div>
                <div class=\"panel-body\">
                    Précisez votre trajet<br>
                    Consultez les offres<br>
                    Validez, et en route <br>
                </div>
                <div class=\"panel-footer\">
                    <a href=\"\" class=\"btn btn-info btn-lg\">Effectuer un trajet</a>
                </div>
            </div>
        </div>
    </div>

        <hr>
        <div class=\"row\">
            <div class=\"col-lg-4\">
                Solidaire
            </div>
            <div class=\"col-lg-4\">
                Sécurisé
            </div>
            <div class=\"col-lg-4\">
                Ecologique
            </div>
        </div>


        <hr>
        <div class=\"row\">
            <h1>Une solution, deux offres adaptées</h1>
            <div class=\"col-lg-6\">
                Covoiturage
                <ul>
                    <li>Peu couteux</li>
                    <li>Assurances incluses</li>
                    <li>Basé sur un modèle vérifié</li>
                </ul>
            </div>
            <div class=\"col-lg-6\">
                Livraison Groupée
                <ul>
                    <li>Fiable</li>
                    <li>Partenaires Professionnels</li>
                    <li>Mise en commun </li>
                </ul>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "KoProjectBundle:Home:indexView.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 23,  36 => 8,  31 => 4,  25 => 3,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "KoProjectBundle:Home:indexView.html.twig", "C:\\MAMP\\htdocs\\Kolibri\\src\\Ko\\ProjectBundle/Resources/views/Home/indexView.html.twig");
    }
}
