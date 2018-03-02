<?php

/* KoUserBundle:Security:login.html.twig */
class __TwigTemplate_fd2e377f4230c642bd03fda53acf396050e6eb29ae2e0c2d38d0ca4f8f1e683e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("::layout.html.twig", "KoUserBundle:Security:login.html.twig", 3);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">

    ";
        // line 9
        echo "    ";
        if (($context["error"] ?? null)) {
            // line 10
            echo "        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "message", array()), "html", null, true);
            echo "</div>
    ";
        }
        // line 12
        echo "
    ";
        // line 14
        echo "    <div class=\"col-lg-6\" style=\"margin-left: 25%;\">

        <div class=\"panel panel-warning\">
            <div class=\"panel-heading\" style=\"text-align: center;\">
                Connexion
            </div>
            <div class=\"panel-body\">
                <form action=\"";
        // line 21
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
                    <label for=\"username\">Login :</label>
                    <input class=\"form-control\" type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["last_username"] ?? null), "html", null, true);
        echo "\" />
                    <label for=\"password\">Password :</label>
                    <input class=\"form-control\" type=\"password\" id=\"password\" name=\"_password\" />
                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" />
                    <label for=\"remember_me\">Remember me</label>

            </div>
            <div class=\"panel-footer\">
                <input class=\"btn btn-default\" type=\"submit\" value=\"Connexion\" />
                </form>
            </div>
        </div>
    </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "KoUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 23,  56 => 21,  47 => 14,  44 => 12,  38 => 10,  35 => 9,  31 => 6,  28 => 5,  11 => 3,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "KoUserBundle:Security:login.html.twig", "C:\\MAMP\\htdocs\\Kolibri\\src\\Ko\\UserBundle/Resources/views/Security/login.html.twig");
    }
}
