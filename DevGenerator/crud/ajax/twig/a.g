{% extends 'templates/header' %}
{% block content %}
  {% include 'templates/nav' %}
 
  {% include 'templates/sidebar' %}

    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Gestión de {{view}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{view}}/">{{view}}</a></li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div>
        <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row row-lg">
            <div class="col-md-12 col-lg-12">

                <div class="example-wrap">
                    <h4 class="example-title">{{view}} - Creación</h4>
                    <div class="example">
                        <form id="{{view}}_form" autocomplete="off">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                      <label class="form-control-label" for="c">Input <span class="required">*</span></label>
                                      <input type="text" id="c" class="form-control" name="c" placeholder="Escribe algo..." autocomplete="off">
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <button type="button" id="{{view}}_submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  
  {% include 'templates/footer' %}
  <script src="public/dev/js/{{view}}/create.js"></script>
</body>
</html>
{% endblock %}