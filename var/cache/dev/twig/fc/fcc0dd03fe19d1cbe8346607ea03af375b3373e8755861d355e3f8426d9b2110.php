<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* program/show.html.twig */
class __TwigTemplate_1da0c7cb26c8e72ece008e12b2626bb40ea08c058dc25cddaecf0074eeccc1bf extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'nav_r_items' => [$this, 'block_nav_r_items'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "_fullbase.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "program/show.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "program/show.html.twig"));

        $this->parent = $this->loadTemplate("_fullbase.html.twig", "program/show.html.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Série #";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 3, $this->source); })()), "id", [], "any", false, false, false, 3), "html", null, true);
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_nav_r_items($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "nav_r_items"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "nav_r_items"));

        // line 6
        echo "\t<a href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("program_season_new", ["program" => twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 6, $this->source); })()), "id", [], "any", false, false, false, 6)]), "html", null, true);
        echo "\">
\t\t<button type=\"button\" class=\"btn btn-hoverLight\">
\t\t\tNouvelle saison
\t\t</button>
\t</a>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 12
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 13
        echo "\t<div class=\"program_show main\">
\t\t<div class=\"media\">
\t\t\t<img class=\"align-self-start mr-3\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 15, $this->source); })()), "poster", [], "any", false, false, false, 15), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 15, $this->source); })()), "title", [], "any", false, false, false, 15), "html", null, true);
        echo " poster\"/>
\t\t\t<div class=\"media-body\">
\t\t\t\t<hr/>
\t\t\t\t<h1>";
        // line 18
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 18, $this->source); })()), "title", [], "any", false, false, false, 18)), "html", null, true);
        echo "</h1>
\t\t\t\t<hr/>
\t\t\t\t<p>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 20, $this->source); })()), "summary", [], "any", false, false, false, 20), "html", null, true);
        echo "</p>
\t\t\t\t<hr/>
\t\t\t\t<p class=\"text-black\">
\t\t\t\t\tCatégorie :
\t\t\t\t\t<span class=\"danger-text ml-2 text-uppercase\">";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 24, $this->source); })()), "category", [], "any", false, false, false, 24), "name", [], "any", false, false, false, 24), "html", null, true);
        echo "</span>
\t\t\t\t\t";
        // line 26
        echo "\t\t\t\t</p>
\t\t\t\t<hr/>
\t\t\t\t<ul>
\t\t\t\t\t";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["seasons"]) || array_key_exists("seasons", $context) ? $context["seasons"] : (function () { throw new RuntimeError('Variable "seasons" does not exist.', 29, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["season"]) {
            // line 30
            echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t";
            // line 32
            echo "\t\t\t\t\t\t\t<a class=\"brown\" href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("program_show_season", ["program" => twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 32, $this->source); })()), "id", [], "any", false, false, false, 32), "season" => twig_get_attribute($this->env, $this->source, $context["season"], "id", [], "any", false, false, false, 32)]), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\tSaison
\t\t\t\t\t\t\t\t";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["season"], "number", [], "any", false, false, false, 34), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 35
            if (twig_get_attribute($this->env, $this->source, $context["season"], "year", [], "any", false, false, false, 35)) {
                // line 36
                echo "\t\t\t\t\t\t\t\t\t-
\t\t\t\t\t\t\t\t";
            }
            // line 39
            echo "\t\t\t\t\t\t\t\t";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["season"], "year", [], "any", false, false, false, 39), "html", null, true);
            echo "
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['season'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "\t\t\t\t</ul>
\t\t\t\t<hr/>
\t\t\t\t<strong class=\"text-black\">Acteurs :</strong>
\t\t\t\t<ul>
\t\t\t\t\t";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 47, $this->source); })()), "actors", [], "any", false, false, false, 47));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["actor"]) {
            // line 48
            echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"dark\" href=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("program_actor_show", ["program" => twig_get_attribute($this->env, $this->source, (isset($context["program"]) || array_key_exists("program", $context) ? $context["program"] : (function () { throw new RuntimeError('Variable "program" does not exist.', 49, $this->source); })()), "id", [], "any", false, false, false, 49), "actor" => twig_get_attribute($this->env, $this->source, $context["actor"], "id", [], "any", false, false, false, 49)]), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["actor"], "name", [], "any", false, false, false, 49), "html", null, true);
            echo "</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 52
            echo "\t\t\t\t\t\t<li>Aucun acteur pour cette série</li>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "\t\t\t\t</ul>
\t\t\t\t<hr/>
\t\t\t\t<a class=\"black\" href=\"";
        // line 56
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("program_index");
        echo "\">
\t\t\t\t\tRetour à la liste des programmes
\t\t\t\t</a>
\t\t\t</div>
\t\t</div>
\t</div>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "program/show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  221 => 56,  217 => 54,  210 => 52,  200 => 49,  197 => 48,  192 => 47,  186 => 43,  175 => 39,  171 => 36,  169 => 35,  165 => 34,  159 => 32,  156 => 30,  152 => 29,  147 => 26,  143 => 24,  136 => 20,  131 => 18,  123 => 15,  119 => 13,  109 => 12,  92 => 6,  82 => 5,  60 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# templates/program/show.html.twig #}
{% extends '_fullbase.html.twig' %}
{% block title %}Série #{{ program.id }}
{% endblock %}
{% block nav_r_items %}
\t<a href=\"{{path('program_season_new', {program: program.id})}}\">
\t\t<button type=\"button\" class=\"btn btn-hoverLight\">
\t\t\tNouvelle saison
\t\t</button>
\t</a>
{% endblock %}
{% block body %}
\t<div class=\"program_show main\">
\t\t<div class=\"media\">
\t\t\t<img class=\"align-self-start mr-3\" src=\"{{program.poster}}\" alt=\"{{ program.title }} poster\"/>
\t\t\t<div class=\"media-body\">
\t\t\t\t<hr/>
\t\t\t\t<h1>{{ program.title|upper }}</h1>
\t\t\t\t<hr/>
\t\t\t\t<p>{{ program.summary }}</p>
\t\t\t\t<hr/>
\t\t\t\t<p class=\"text-black\">
\t\t\t\t\tCatégorie :
\t\t\t\t\t<span class=\"danger-text ml-2 text-uppercase\">{{ program.category.name }}</span>
\t\t\t\t\t{# display:block #}
\t\t\t\t</p>
\t\t\t\t<hr/>
\t\t\t\t<ul>
\t\t\t\t\t{% for season in seasons %}
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t{# TODO Lien vers le nom d'une route #}
\t\t\t\t\t\t\t<a class=\"brown\" href=\"{{path('program_show_season', {program: program.id, season: season.id})}}\">
\t\t\t\t\t\t\t\tSaison
\t\t\t\t\t\t\t\t{{season.number}}
\t\t\t\t\t\t\t\t{% if season.year %}
\t\t\t\t\t\t\t\t\t-
\t\t\t\t\t\t\t\t{% endif
                        %}
\t\t\t\t\t\t\t\t{{season.year}}
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t{% endfor %}
\t\t\t\t</ul>
\t\t\t\t<hr/>
\t\t\t\t<strong class=\"text-black\">Acteurs :</strong>
\t\t\t\t<ul>
\t\t\t\t\t{% for actor in program.actors %}
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"dark\" href=\"{{path('program_actor_show', {program: program.id, actor: actor.id})}}\">{{ actor.name }}</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t{% else %}
\t\t\t\t\t\t<li>Aucun acteur pour cette série</li>
\t\t\t\t\t{% endfor %}
\t\t\t\t</ul>
\t\t\t\t<hr/>
\t\t\t\t<a class=\"black\" href=\"{{ path('program_index') }}\">
\t\t\t\t\tRetour à la liste des programmes
\t\t\t\t</a>
\t\t\t</div>
\t\t</div>
\t</div>

{% endblock %}
", "program/show.html.twig", "/home/jerkoder/docsCommuns/mes_devs_docs/projects/symfony/wild-series/templates/program/show.html.twig");
    }
}
