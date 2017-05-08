{% extends 'templates/header' %}

{% block content %}
    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                {% include('templates/nav') %}

                <section class="devbody">
                    <header class="text-center">
                        <h3>Título de este módulo</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                        <h4 class="text-center">Título de la sección</h4>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <form class="form-horizontal" id="{{view}}_form">

                                <div class="alert hide" id="ajax_{{view}}"></div>

                                    
                                <div class="form-group">
                                    <label for="c" class="control-label">Campo *</label>
                                    <input type="text" name="c" class="form-control" id="c" placeholder="Placeholder del campo">
                                </div>

                                    
                                <div class="col-md-12">
                                    <button type="button" id="{{view}}_submit" class="btn btn-primary">Acción</button>
                                </div>
                                
                                
                            </form>
                        </div>
                        

                    </article>

                </section>
            </div>
            {% include 'templates/footer' %}
        </div>
    </div>


    {% include 'templates/scripts' %}
    <script src="public/dev/js/{{view}}.js"></script>

</body>
</html>
{% endblock %}
