<?php

/* templates/footer.twig */
class __TwigTemplate_da12686fa92cfd5c149277be193f2bfdf158df5a6a2d629b8ada4d1c620e373e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- Footer -->
  <footer class=\"site-footer\">
    <div class=\"site-footer-legal\">© ";
        // line 3
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " <a href=\"#\">PDVSA</a></div>
    <div class=\"site-footer-right\">
      Creado <i class=\"red-600 wb wb-heart\"></i> por <a href=\"#\">pdvsa systems</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src=\"public/classic/global/vendor/babel-external-helpers/babel-external-helpers.js\"></script>
  <script src=\"public/classic/global/vendor/jquery/jquery.js\"></script>
  <script src=\"public/classic/global/vendor/tether/tether.js\"></script>
  <script src=\"public/classic/global/vendor/bootstrap/bootstrap.js\"></script>
  <script src=\"public/classic/global/vendor/animsition/animsition.js\"></script>
  <script src=\"public/classic/global/vendor/mousewheel/jquery.mousewheel.js\"></script>
  <script src=\"public/classic/global/vendor/asscrollbar/jquery-asScrollbar.js\"></script>
  <script src=\"public/classic/global/vendor/asscrollable/jquery-asScrollable.js\"></script>
  <script src=\"public/classic/global/vendor/ashoverscroll/jquery-asHoverScroll.js\"></script>
  <!-- Plugins -->
  <script src=\"public/classic/global/vendor/switchery/switchery.min.js\"></script>
  <script src=\"public/classic/global/vendor/intro-js/intro.js\"></script>
  <script src=\"public/classic/global/vendor/screenfull/screenfull.js\"></script>
  <script src=\"public/classic/global/vendor/slidepanel/jquery-slidePanel.js\"></script>

  <script src=\"public/classic/global/vendor/ladda/spin.min.js\"></script>
  <script src=\"public/classic/global/vendor/ladda/ladda.min.js\"></script>

  <script src=\"public/classic/global/vendor/toastr/toastr.js\"></script>

  <script src=\"public/classic/global/vendor/datatables/jquery.dataTables.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-responsive/dataTables.responsive.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/dataTables.buttons.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.html5.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.flash.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.print.js\"></script>
  <script src=\"public/classic/global/vendor/asrange/jquery-asRange.min.js\"></script>
  <script src=\"public/classic/global/vendor/bootbox/bootbox.js\"></script>

  <script src=\"public/classic/global/vendor/bootstrap-sweetalert/sweetalert.js\"></script>
  <!-- Scripts -->
  <script src=\"public/classic/global/js/State.js\"></script>
  <script src=\"public/classic/global/js/Component.js\"></script>
  <script src=\"public/classic/global/js/Plugin.js\"></script>
  <script src=\"public/classic/global/js/Base.js\"></script>
  <script src=\"public/classic/global/js/Config.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/Menubar.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/GridMenu.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/Sidebar.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/PageAside.js\"></script>
  <script src=\"public/classic/base/assets/js/Plugin/menu.js\"></script>
  <script src=\"public/classic/global/js/config/colors.js\"></script>
  <script src=\"public/classic/base/assets/js/config/tour.js\"></script>

  <script src=\"public/classic/global/vendor/toastr/toastr.js\"></script>

  <script>
  Config.set('assets', 'public/classic/base/assets');
  </script>
  <!-- Page -->
  <script src=\"public/classic/base/assets/js/Site.js\"></script>
  <script src=\"public/classic/global/js/Plugin/asscrollable.js\"></script>
  <script src=\"public/classic/global/js/Plugin/slidepanel.js\"></script>
  <script src=\"public/classic/global/js/Plugin/switchery.js\"></script>
  <script src=\"public/classic/global/js/Plugin/datatables.js\"></script>
  <script src=\"public/classic/base/assets/examples/js/tables/datatable.js\"></script>
  <script src=\"public/classic/global/js/Plugin/ladda.js\"></script>
  <script src=\"public/classic/global/js/Plugin/bootstrap-sweetalert.js\"></script>
  <script src=\"public/classic/global/js/Plugin/toastr.js\"></script>
  <script src=\"public/classic/base/assets/examples/js/advanced/bootbox-sweetalert.js\"></script>
  <script src=\"public/dev/js/general.js\"></script>
  <script src=\"public/dev/js/del.js\"></script>
  ";
    }

    public function getTemplateName()
    {
        return "templates/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!-- Footer -->
  <footer class=\"site-footer\">
    <div class=\"site-footer-legal\">© {{ \"now\"|date('Y') }} <a href=\"#\">PDVSA</a></div>
    <div class=\"site-footer-right\">
      Creado <i class=\"red-600 wb wb-heart\"></i> por <a href=\"#\">pdvsa systems</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src=\"public/classic/global/vendor/babel-external-helpers/babel-external-helpers.js\"></script>
  <script src=\"public/classic/global/vendor/jquery/jquery.js\"></script>
  <script src=\"public/classic/global/vendor/tether/tether.js\"></script>
  <script src=\"public/classic/global/vendor/bootstrap/bootstrap.js\"></script>
  <script src=\"public/classic/global/vendor/animsition/animsition.js\"></script>
  <script src=\"public/classic/global/vendor/mousewheel/jquery.mousewheel.js\"></script>
  <script src=\"public/classic/global/vendor/asscrollbar/jquery-asScrollbar.js\"></script>
  <script src=\"public/classic/global/vendor/asscrollable/jquery-asScrollable.js\"></script>
  <script src=\"public/classic/global/vendor/ashoverscroll/jquery-asHoverScroll.js\"></script>
  <!-- Plugins -->
  <script src=\"public/classic/global/vendor/switchery/switchery.min.js\"></script>
  <script src=\"public/classic/global/vendor/intro-js/intro.js\"></script>
  <script src=\"public/classic/global/vendor/screenfull/screenfull.js\"></script>
  <script src=\"public/classic/global/vendor/slidepanel/jquery-slidePanel.js\"></script>

  <script src=\"public/classic/global/vendor/ladda/spin.min.js\"></script>
  <script src=\"public/classic/global/vendor/ladda/ladda.min.js\"></script>

  <script src=\"public/classic/global/vendor/toastr/toastr.js\"></script>

  <script src=\"public/classic/global/vendor/datatables/jquery.dataTables.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-fixedheader/dataTables.fixedHeader.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-responsive/dataTables.responsive.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/dataTables.buttons.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.html5.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.flash.js\"></script>
  <script src=\"public/classic/global/vendor/datatables-buttons/buttons.print.js\"></script>
  <script src=\"public/classic/global/vendor/asrange/jquery-asRange.min.js\"></script>
  <script src=\"public/classic/global/vendor/bootbox/bootbox.js\"></script>

  <script src=\"public/classic/global/vendor/bootstrap-sweetalert/sweetalert.js\"></script>
  <!-- Scripts -->
  <script src=\"public/classic/global/js/State.js\"></script>
  <script src=\"public/classic/global/js/Component.js\"></script>
  <script src=\"public/classic/global/js/Plugin.js\"></script>
  <script src=\"public/classic/global/js/Base.js\"></script>
  <script src=\"public/classic/global/js/Config.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/Menubar.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/GridMenu.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/Sidebar.js\"></script>
  <script src=\"public/classic/base/assets/js/Section/PageAside.js\"></script>
  <script src=\"public/classic/base/assets/js/Plugin/menu.js\"></script>
  <script src=\"public/classic/global/js/config/colors.js\"></script>
  <script src=\"public/classic/base/assets/js/config/tour.js\"></script>

  <script src=\"public/classic/global/vendor/toastr/toastr.js\"></script>

  <script>
  Config.set('assets', 'public/classic/base/assets');
  </script>
  <!-- Page -->
  <script src=\"public/classic/base/assets/js/Site.js\"></script>
  <script src=\"public/classic/global/js/Plugin/asscrollable.js\"></script>
  <script src=\"public/classic/global/js/Plugin/slidepanel.js\"></script>
  <script src=\"public/classic/global/js/Plugin/switchery.js\"></script>
  <script src=\"public/classic/global/js/Plugin/datatables.js\"></script>
  <script src=\"public/classic/base/assets/examples/js/tables/datatable.js\"></script>
  <script src=\"public/classic/global/js/Plugin/ladda.js\"></script>
  <script src=\"public/classic/global/js/Plugin/bootstrap-sweetalert.js\"></script>
  <script src=\"public/classic/global/js/Plugin/toastr.js\"></script>
  <script src=\"public/classic/base/assets/examples/js/advanced/bootbox-sweetalert.js\"></script>
  <script src=\"public/dev/js/general.js\"></script>
  <script src=\"public/dev/js/del.js\"></script>
  ", "templates/footer.twig", "C:\\xampp\\htdocs\\pdvsa\\views\\twig\\templates\\footer.twig");
    }
}
