<?php

/* templates/sidebar.twig */
class __TwigTemplate_36268c9f295e5e0b10050744d1866f82217961b84a4ef972af712f17ac60b4cb extends Twig_Template
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
        echo "  <div class=\"site-menubar\"> 
    <div class=\"site-menubar-body\">
      <div>
        <div>
          <ul class=\"site-menu\" data-plugin=\"menu\">
            <li class=\"site-menu-category\">Administración</li>

            <li class=\"site-menu-item ";
        // line 8
        echo (((($context["c"] ?? null) == "Front")) ? ("active") : (""));
        echo "\">
              <a class=\"animsition-link\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_constant("URL"), "html", null, true);
        echo "\">
                <i class=\"site-menu-icon wb-dashboard\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Escritorio</span>
              </a>
            </li>

            ";
        // line 16
        echo "
            <li class=\"site-menu-item has-sub ";
        // line 17
        echo (((($context["c"] ?? null) == "Rangos")) ? ("active open") : (""));
        echo "\">
              <a href=\"javascript:void(0)\">
                <i class=\"site-menu-icon wb-clipboard\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Gestión rangos</span>
                <span class=\"site-menu-arrow\"></span>
              </a>
              <ul class=\"site-menu-sub\">
                
                
                <li class=\"site-menu-item ";
        // line 26
        echo ((((($context["c"] ?? null) == "Rangos") && (($context["m"] ?? null) == "index"))) ? ("active") : (""));
        echo "\">
                  <a class=\"animsition-link\" href=\"rangos/\">
                    <i class=\"site-menu-icon wb-order\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Listado</span>
                  </a>
                </li>

                <li class=\"site-menu-item ";
        // line 33
        echo ((((($context["c"] ?? null) == "Rangos") && (($context["m"] ?? null) == "add"))) ? ("active") : (""));
        echo "\">
                  <a class=\"animsition-link\" href=\"rangos/add/\">
                   <i class=\"site-menu-icon wb-plus-circle\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Agregar</span>
                  </a>
                </li>
                
              
              </ul>
            </li>

            <li class=\"site-menu-item has-sub ";
        // line 44
        echo (((($context["c"] ?? null) == "Admins")) ? ("active open") : (""));
        echo "\">
              <a href=\"javascript:void(0)\">
                <i class=\"site-menu-icon wb-user-circle\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Administradoress</span>
                <span class=\"site-menu-arrow\"></span>
              </a>
              <ul class=\"site-menu-sub\">
                
                
                <li class=\"site-menu-item ";
        // line 53
        echo ((((($context["c"] ?? null) == "Admins") && (($context["m"] ?? null) == "index"))) ? ("active") : (""));
        echo "\">
                  <a class=\"animsition-link\" href=\"admins/\">
                    <i class=\"site-menu-icon wb-order\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Listado</span>
                  </a>
                </li>

                <li class=\"site-menu-item ";
        // line 60
        echo ((((($context["c"] ?? null) == "Admins") && (($context["m"] ?? null) == "add"))) ? ("active") : (""));
        echo "\">
                  <a class=\"animsition-link\" href=\"admins/add/\">
                   <i class=\"site-menu-icon wb-plus-circle\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Agregar</span>
                  </a>
                </li>
                
              
              </ul>
            </li>

            ";
        // line 96
        echo "        </div>
      </div>
    </div>
    <div class=\"site-menubar-footer\">
      <a href=\"javascript: void(0);\" class=\"fold-show\" data-placement=\"top\" data-toggle=\"tooltip\"
      data-original-title=\"Settings\">
        <span class=\"icon wb-settings\" aria-hidden=\"true\"></span>
      </a>
      <a href=\"javascript: void(0);\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Lock\">
        <span class=\"icon wb-eye-close\" aria-hidden=\"true\"></span>
      </a>
      <a href=\"javascript: void(0);\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Logout\">
        <span class=\"icon wb-power\" aria-hidden=\"true\"></span>
      </a>
    </div>
  </div>

  <div class=\"site-gridmenu\">
    <div>
      <div>
        <ul>
          <li>
            <a href=\"public/classic/base/html/apps/mailbox/mailbox.html\">
              <i class=\"icon wb-envelope\"></i>
              <span>Mailbox</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/calendar/calendar.html\">
              <i class=\"icon wb-calendar\"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/contacts/contacts.html\">
              <i class=\"icon wb-user\"></i>
              <span>Contacts</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/media/overview.html\">
              <i class=\"icon wb-camera\"></i>
              <span>Media</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/documents/categories.html\">
              <i class=\"icon wb-order\"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/projects/projects.html\">
              <i class=\"icon wb-image\"></i>
              <span>Project</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/forum/forum.html\">
              <i class=\"icon wb-chat-group\"></i>
              <span>Forum</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/index.html\">
              <i class=\"icon wb-dashboard\"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>";
    }

    public function getTemplateName()
    {
        return "templates/sidebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 96,  102 => 60,  92 => 53,  80 => 44,  66 => 33,  56 => 26,  44 => 17,  41 => 16,  32 => 9,  28 => 8,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("  <div class=\"site-menubar\"> 
    <div class=\"site-menubar-body\">
      <div>
        <div>
          <ul class=\"site-menu\" data-plugin=\"menu\">
            <li class=\"site-menu-category\">Administración</li>

            <li class=\"site-menu-item {{ c == 'Front' ? 'active' : '' }}\">
              <a class=\"animsition-link\" href=\"{{ constant('URL') }}\">
                <i class=\"site-menu-icon wb-dashboard\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Escritorio</span>
              </a>
            </li>

            {# open active #}

            <li class=\"site-menu-item has-sub {{ c == 'Rangos' ? 'active open' : '' }}\">
              <a href=\"javascript:void(0)\">
                <i class=\"site-menu-icon wb-clipboard\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Gestión rangos</span>
                <span class=\"site-menu-arrow\"></span>
              </a>
              <ul class=\"site-menu-sub\">
                
                
                <li class=\"site-menu-item {{ c == 'Rangos' and m == 'index' ? 'active' : '' }}\">
                  <a class=\"animsition-link\" href=\"rangos/\">
                    <i class=\"site-menu-icon wb-order\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Listado</span>
                  </a>
                </li>

                <li class=\"site-menu-item {{ c == 'Rangos' and m == 'add' ? 'active' : '' }}\">
                  <a class=\"animsition-link\" href=\"rangos/add/\">
                   <i class=\"site-menu-icon wb-plus-circle\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Agregar</span>
                  </a>
                </li>
                
              
              </ul>
            </li>

            <li class=\"site-menu-item has-sub {{ c == 'Admins' ? 'active open' : '' }}\">
              <a href=\"javascript:void(0)\">
                <i class=\"site-menu-icon wb-user-circle\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">Administradoress</span>
                <span class=\"site-menu-arrow\"></span>
              </a>
              <ul class=\"site-menu-sub\">
                
                
                <li class=\"site-menu-item {{ c == 'Admins' and m == 'index' ? 'active' : '' }}\">
                  <a class=\"animsition-link\" href=\"admins/\">
                    <i class=\"site-menu-icon wb-order\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Listado</span>
                  </a>
                </li>

                <li class=\"site-menu-item {{ c == 'Admins' and m == 'add' ? 'active' : '' }}\">
                  <a class=\"animsition-link\" href=\"admins/add/\">
                   <i class=\"site-menu-icon wb-plus-circle\" aria-hidden=\"true\"></i>
                    <span class=\"site-menu-title\">Agregar</span>
                  </a>
                </li>
                
              
              </ul>
            </li>

            {#<li class=\"site-menu-category\">Configuración</li>
           
            <li class=\"site-menu-item\">
              <a class=\"animsition-link\" href=\"public/classic/base/html/angular/index.html\">
                <i class=\"site-menu-icon bd-angular\" aria-hidden=\"true\"></i>
                <span class=\"site-menu-title\">General</span>
              </a>
            </li>
          </ul>
          <div class=\"site-menubar-section\">
            <h5>
              Milestone
              <span class=\"float-right\">30%</span>
            </h5>
            <div class=\"progress progress-xs\">
              <div class=\"progress-bar active\" style=\"width: 30%;\" role=\"progressbar\"></div>
            </div>
            <h5>
              Release
              <span class=\"float-right\">60%</span>
            </h5>
            <div class=\"progress progress-xs\">
              <div class=\"progress-bar progress-bar-warning\" style=\"width: 60%;\" role=\"progressbar\"></div>
            </div>
          </div>#}
        </div>
      </div>
    </div>
    <div class=\"site-menubar-footer\">
      <a href=\"javascript: void(0);\" class=\"fold-show\" data-placement=\"top\" data-toggle=\"tooltip\"
      data-original-title=\"Settings\">
        <span class=\"icon wb-settings\" aria-hidden=\"true\"></span>
      </a>
      <a href=\"javascript: void(0);\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Lock\">
        <span class=\"icon wb-eye-close\" aria-hidden=\"true\"></span>
      </a>
      <a href=\"javascript: void(0);\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Logout\">
        <span class=\"icon wb-power\" aria-hidden=\"true\"></span>
      </a>
    </div>
  </div>

  <div class=\"site-gridmenu\">
    <div>
      <div>
        <ul>
          <li>
            <a href=\"public/classic/base/html/apps/mailbox/mailbox.html\">
              <i class=\"icon wb-envelope\"></i>
              <span>Mailbox</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/calendar/calendar.html\">
              <i class=\"icon wb-calendar\"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/contacts/contacts.html\">
              <i class=\"icon wb-user\"></i>
              <span>Contacts</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/media/overview.html\">
              <i class=\"icon wb-camera\"></i>
              <span>Media</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/documents/categories.html\">
              <i class=\"icon wb-order\"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/projects/projects.html\">
              <i class=\"icon wb-image\"></i>
              <span>Project</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/apps/forum/forum.html\">
              <i class=\"icon wb-chat-group\"></i>
              <span>Forum</span>
            </a>
          </li>
          <li>
            <a href=\"public/classic/base/html/index.html\">
              <i class=\"icon wb-dashboard\"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>", "templates/sidebar.twig", "C:\\xampp\\htdocs\\pdvsa\\views\\twig\\templates\\sidebar.twig");
    }
}
