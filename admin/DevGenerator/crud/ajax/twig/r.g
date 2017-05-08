{% extends 'templates/header' %}

{% block CssBlock %}
<link rel="stylesheet" href="public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.css">
<link rel="stylesheet" href="public/classic/global/vendor/datatables-responsive/dataTables.responsive.css">
<link rel="stylesheet" href="public/classic/global/vendor/datatables-buttons/dataTables.buttons.css">
<link rel="stylesheet" href="public/classic/base/assets/examples/css/tables/datatable.css">
{% endblock %}

{% block content %}
    {% include 'templates/nav' %}

    {% include 'templates/sidebar' %}
  
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Gestion de {{view}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ constant('URL') }}">Gestión</a></li>
                
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Gestión de {{view}}</h3>
                </header>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-15">
                                <a class="btn btn-outline btn-primary" href="{{view}}/add/">
                                    <i class="icon wb-plus" aria-hidden="true"></i> Agregar Nuevo
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table table-hover dataTable table-striped w-full" id="exampleTableSearch">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Acción</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                        <tbody>
                            {% for d in data if false != data %}
                            <tr id="tr_{{view}}_{{d.id}}">
                                <td>{{ d.id }}</td>
                                <td class="actions">
                                    <a href="{{view}}/edit/{{ d.id }}" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Editar"><i class="icon wb-edit" aria-hidden="true"></i></a>

                                    <a onclick="delete_this('{{view}}',{{ d.id }},true)" class="pointer btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Eliminar"><i class="icon wb-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            {% endfor %}
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
  {% include 'templates/footer' %}
  <script src="public/classic/global/vendor/datatables/jquery.dataTables.js"></script>
  <script src="public/classic/global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="public/classic/global/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="public/classic/global/vendor/datatables-buttons/dataTables.buttons.js"></script>
  <script src="public/classic/global/vendor/datatables-buttons/buttons.print.js"></script>
  <script src="public/classic/global/js/Plugin/datatables.js"></script>
  <script src="public/classic/base/assets/examples/js/tables/datatable.js"></script>

</body>
</html>
{% endblock %}