<?php

/* admins/add.twig */
class __TwigTemplate_a50b47ed74dff90ad46c8a067977d63a2496df8b20bbc347402695cec2b88429 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("templates/header", "admins/add.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "templates/header";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "  ";
        $this->loadTemplate("templates/nav", "admins/add.twig", 3)->display($context);
        // line 4
        echo "
  
  ";
        // line 6
        $this->loadTemplate("templates/sidebar", "admins/add.twig", 6)->display($context);
        // line 7
        echo "
  
  
\t<div class=\"page\">
\t\t<div class=\"page-header\">
\t\t    <h1 class=\"page-title\">Gestión de Administradores</h1>
\t\t    <ol class=\"breadcrumb\">
\t\t        <li class=\"breadcrumb-item\"><a href=\"admins/\">Admins</a></li>
\t\t        <li class=\"breadcrumb-item active\">Listado</li>
\t\t    </ol>
\t\t</div>
\t    <div class=\"page-content\">
\t      \t<div class=\"panel\">
\t      \t\t<div class=\"panel-body container-fluid\">
\t      \t\t\t<div class=\"row row-lg\">
\t      \t\t\t\t<div class=\"col-md-12 col-lg-12\">
\t      \t\t\t\t\t
\t\t\t\t\t\t\t<div class=\"example-wrap\">
\t\t\t\t\t\t\t\t<h4 class=\"example-title\">Administradores - Creación</h4>
\t\t\t\t\t\t\t\t<div class=\"example\">
\t\t\t\t\t\t\t\t\t<form id=\"admins_form\" autocomplete=\"off\" enctype=\"multipart/form-data\">
\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-6 col-xs-12\">

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"name\">Nombre <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"name\" class=\"form-control\" name=\"name\" placeholder=\"Nombre del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"ape\">Apellido <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"ape\" class=\"form-control\" name=\"ape\" placeholder=\"Apellido del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"ced\">Cédula de identidad<span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"tel\" id=\"ced\" class=\"form-control\" name=\"ced\" placeholder=\"Cédula del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"email\">Correo Electrónico <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" id=\"email\" class=\"form-control\" name=\"email\" placeholder=\"Correo del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"emaildos\">Confirmar correo <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" id=\"emaildos\" class=\"form-control\" name=\"emaildos\" placeholder=\"Vuelve a escribir el correo\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-xs-12 col-md-6\">

\t\t\t\t\t\t                        <div class=\"example-wrap\">
\t\t\t\t\t\t                          \t<h4 class=\"example-title\">Imágen de Perfil</h4>
\t\t\t\t\t\t                          \t<div class=\"example\">
\t\t\t\t\t\t                            \t<input type=\"file\" name=\"perfil\" id=\"input-file-now-custom-1\" data-height=\"220\" data-plugin=\"dropify\" />
\t\t\t\t\t\t                         \t </div>
\t\t\t\t\t\t                        </div>

\t\t\t\t\t\t                      \t<div class=\"form-group\">
\t\t\t\t\t\t                      \t\t<label class=\"form-control-label\" for=\"pass\">Contraseña <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" id=\"pass\" class=\"form-control\" name=\"pass\" placeholder=\"Contraseña del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t                      \t</div>

\t\t\t\t\t\t                      \t<div class=\"form-group\">
\t\t\t\t\t\t                      \t\t<label class=\"form-control-label\" for=\"passdos\">Confirmar Contraseña <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" id=\"passdos\" class=\"form-control\" name=\"passdos\" placeholder=\"Vuelve a escribir la contraseña\" autocomplete=\"off\">
\t\t\t\t\t\t                      \t</div>

\t\t\t\t\t\t                    </div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t                      \t<button type=\"button\" id=\"admins_submit\" class=\"btn btn-primary\">Crear</button>
\t\t\t\t\t                    </div>

\t\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t      \t\t\t\t</div>
\t      \t\t\t</div>
\t      \t\t\t
\t      \t\t</div>
\t      \t</div>
\t    </div>
\t</div>
  
  ";
        // line 98
        $this->loadTemplate("templates/footer", "admins/add.twig", 98)->display($context);
        // line 99
        echo "  <script src=\"public/classic/global/vendor/dropify/dropify.js\"></script>
\t<script src=\"public/classic/global/js/Plugin/dropify.js\"></script>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "admins/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 99,  133 => 98,  40 => 7,  38 => 6,  34 => 4,  31 => 3,  28 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'templates/header' %}
{% block content %}
  {% include 'templates/nav' %}

  
  {% include 'templates/sidebar' %}

  
  
\t<div class=\"page\">
\t\t<div class=\"page-header\">
\t\t    <h1 class=\"page-title\">Gestión de Administradores</h1>
\t\t    <ol class=\"breadcrumb\">
\t\t        <li class=\"breadcrumb-item\"><a href=\"admins/\">Admins</a></li>
\t\t        <li class=\"breadcrumb-item active\">Listado</li>
\t\t    </ol>
\t\t</div>
\t    <div class=\"page-content\">
\t      \t<div class=\"panel\">
\t      \t\t<div class=\"panel-body container-fluid\">
\t      \t\t\t<div class=\"row row-lg\">
\t      \t\t\t\t<div class=\"col-md-12 col-lg-12\">
\t      \t\t\t\t\t
\t\t\t\t\t\t\t<div class=\"example-wrap\">
\t\t\t\t\t\t\t\t<h4 class=\"example-title\">Administradores - Creación</h4>
\t\t\t\t\t\t\t\t<div class=\"example\">
\t\t\t\t\t\t\t\t\t<form id=\"admins_form\" autocomplete=\"off\" enctype=\"multipart/form-data\">
\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-6 col-xs-12\">

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"name\">Nombre <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"name\" class=\"form-control\" name=\"name\" placeholder=\"Nombre del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"ape\">Apellido <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"ape\" class=\"form-control\" name=\"ape\" placeholder=\"Apellido del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"ced\">Cédula de identidad<span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"tel\" id=\"ced\" class=\"form-control\" name=\"ced\" placeholder=\"Cédula del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"email\">Correo Electrónico <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" id=\"email\" class=\"form-control\" name=\"email\" placeholder=\"Correo del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t

\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-control-label\" for=\"emaildos\">Confirmar correo <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" id=\"emaildos\" class=\"form-control\" name=\"emaildos\" placeholder=\"Vuelve a escribir el correo\" autocomplete=\"off\">
\t\t\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-xs-12 col-md-6\">

\t\t\t\t\t\t                        <div class=\"example-wrap\">
\t\t\t\t\t\t                          \t<h4 class=\"example-title\">Imágen de Perfil</h4>
\t\t\t\t\t\t                          \t<div class=\"example\">
\t\t\t\t\t\t                            \t<input type=\"file\" name=\"perfil\" id=\"input-file-now-custom-1\" data-height=\"220\" data-plugin=\"dropify\" />
\t\t\t\t\t\t                         \t </div>
\t\t\t\t\t\t                        </div>

\t\t\t\t\t\t                      \t<div class=\"form-group\">
\t\t\t\t\t\t                      \t\t<label class=\"form-control-label\" for=\"pass\">Contraseña <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" id=\"pass\" class=\"form-control\" name=\"pass\" placeholder=\"Contraseña del administrador\" autocomplete=\"off\">
\t\t\t\t\t\t                      \t</div>

\t\t\t\t\t\t                      \t<div class=\"form-group\">
\t\t\t\t\t\t                      \t\t<label class=\"form-control-label\" for=\"passdos\">Confirmar Contraseña <span class=\"required\">*</span></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" id=\"passdos\" class=\"form-control\" name=\"passdos\" placeholder=\"Vuelve a escribir la contraseña\" autocomplete=\"off\">
\t\t\t\t\t\t                      \t</div>

\t\t\t\t\t\t                    </div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t                      \t<button type=\"button\" id=\"admins_submit\" class=\"btn btn-primary\">Crear</button>
\t\t\t\t\t                    </div>

\t\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t      \t\t\t\t</div>
\t      \t\t\t</div>
\t      \t\t\t
\t      \t\t</div>
\t      \t</div>
\t    </div>
\t</div>
  
  {% include 'templates/footer' %}
  <script src=\"public/classic/global/vendor/dropify/dropify.js\"></script>
\t<script src=\"public/classic/global/js/Plugin/dropify.js\"></script>
</body>
</html>
{% endblock %}", "admins/add.twig", "C:\\xampp\\htdocs\\pdvsa\\views\\twig\\admins\\add.twig");
    }
}
