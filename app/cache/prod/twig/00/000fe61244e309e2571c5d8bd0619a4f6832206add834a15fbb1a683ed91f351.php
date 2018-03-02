<?php

/* KoProjectBundle:ProjectAffichage:postForm.html.twig */
class __TwigTemplate_db1a059fe8e0647141058538ebe7f2f3f0d549e9c24147b27a710dd6bd03c08f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::layout.html.twig", "KoProjectBundle:ProjectAffichage:postForm.html.twig", 1);
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

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <header id=\"topbar\" class=\"alt\" style=\"padding: 10px;\" >
        <div class=\"topbar-left\">
            <ol class=\"breadcrumb\">
                <li class=\"crumb-active\" >
                    <a> Creer un annonce </a>
                </li>
            </ol>
        </div>
    </header>

    <section id=\"content\" class=\"table-layout\" style=\"padding: 10px;margin-left: 300px;\">
        <div class=\"tray tray-center\">

            <div class=\"admin-form mw800 center-block theme-primary\">
                <div class=\"panel\" >
                    <div class=\"panel-heading\">
                        <span class=\"panel-title\"> Mon annonce </span>
                    </div>
                    <div class=\"panel-body\">
                                <form method=\"POST\" action=\"\" >
                                  ";
        // line 25
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form');
        echo "
                                </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

";
    }

    public function getTemplateName()
    {
        return "KoProjectBundle:ProjectAffichage:postForm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 25,  31 => 5,  28 => 4,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "KoProjectBundle:ProjectAffichage:postForm.html.twig", "C:\\MAMP\\htdocs\\Kolibri\\src\\Ko\\ProjectBundle/Resources/views/ProjectAffichage/postForm.html.twig");
    }
}
