<?php

/* templates/header.twig */
class __TwigTemplate_66cda3b24c2d460a188a2b3af8a4900b05c7747aa9d63aad7e4a0165f32bed9e extends Twig_Template
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
        echo "<!DOCTYPE html>
<html class=\"no-js css-menubar\" lang=\"en\">
<head>
    <base href=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_constant("URL"), "html", null, true);
        echo "\">
  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui\">
  <meta name=\"description\" content=\"bootstrap admin template\">
  <meta name=\"author\" content=\"\">
  <title>Sistema | ";
        // line 10
        echo twig_escape_filter($this->env, twig_constant("TITLE"), "html", null, true);
        echo "</title>
  <link rel=\"apple-touch-icon\" href=\"public/classic/base/assets/images/apple-touch-icon.png\">
  <link rel=\"shortcut icon\" href=\"public/classic/base/assets/images/favicon.ico\">
  <!-- Stylesheets -->
  <link rel=\"stylesheet\" href=\"public/classic/global/css/bootstrap.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/css/bootstrap-extend.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/css/site.min.css\">
  <!-- Plugins -->
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/animsition/animsition.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/asscrollable/asScrollable.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/switchery/switchery.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/intro-js/introjs.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/slidepanel/slidePanel.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/flag-icon-css/flag-icon.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/dropify/dropify.css\">
  
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/ladda/ladda.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/toastr/toastr.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/examples/css/advanced/toastr.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/bootstrap-sweetalert/sweetalert.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-responsive/dataTables.responsive.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-buttons/dataTables.buttons.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/examples/css/tables/datatable.css\">

  <!-- Fonts -->
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/font-awesome/font-awesome.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/web-icons/web-icons.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/brand-icons/brand-icons.min.css\">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src=\"public/classic/global/vendor/html5shiv/html5shiv.min.js\"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src=\"public/classic/global/vendor/media-match/media.match.min.js\"></script>
    <script src=\"public/classic/global/vendor/respond/respond.min.js\"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src=\"public/classic/global/vendor/breakpoints/breakpoints.js\"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class=\"animsition\">
  <!--[if lt IE 8]>
        <p class=\"browserupgrade\">You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

";
        // line 62
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "templates/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 62,  34 => 10,  25 => 4,  20 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html class=\"no-js css-menubar\" lang=\"en\">
<head>
    <base href=\"{{ constant('URL') }}\">
  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui\">
  <meta name=\"description\" content=\"bootstrap admin template\">
  <meta name=\"author\" content=\"\">
  <title>Sistema | {{ constant('TITLE') }}</title>
  <link rel=\"apple-touch-icon\" href=\"public/classic/base/assets/images/apple-touch-icon.png\">
  <link rel=\"shortcut icon\" href=\"public/classic/base/assets/images/favicon.ico\">
  <!-- Stylesheets -->
  <link rel=\"stylesheet\" href=\"public/classic/global/css/bootstrap.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/css/bootstrap-extend.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/css/site.min.css\">
  <!-- Plugins -->
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/animsition/animsition.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/asscrollable/asScrollable.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/switchery/switchery.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/intro-js/introjs.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/slidepanel/slidePanel.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/flag-icon-css/flag-icon.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/dropify/dropify.css\">
  
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/ladda/ladda.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/toastr/toastr.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/examples/css/advanced/toastr.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/bootstrap-sweetalert/sweetalert.css\">

  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-responsive/dataTables.responsive.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/vendor/datatables-buttons/dataTables.buttons.css\">
  <link rel=\"stylesheet\" href=\"public/classic/base/assets/examples/css/tables/datatable.css\">

  <!-- Fonts -->
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/font-awesome/font-awesome.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/web-icons/web-icons.min.css\">
  <link rel=\"stylesheet\" href=\"public/classic/global/fonts/brand-icons/brand-icons.min.css\">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src=\"public/classic/global/vendor/html5shiv/html5shiv.min.js\"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src=\"public/classic/global/vendor/media-match/media.match.min.js\"></script>
    <script src=\"public/classic/global/vendor/respond/respond.min.js\"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src=\"public/classic/global/vendor/breakpoints/breakpoints.js\"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class=\"animsition\">
  <!--[if lt IE 8]>
        <p class=\"browserupgrade\">You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

{% block content %}{% endblock %}", "templates/header.twig", "C:\\xampp\\htdocs\\pdvsa\\views\\twig\\templates\\header.twig");
    }
}
