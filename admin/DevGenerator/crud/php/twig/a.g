{% extends 'templates/header' %}

{% block content %}
    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                {% include('templates/nav') %}

                <section class="devbody">
                    <header class="text-center">
                        <h3>Creación de {{view}}</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                        <h4 class="text-center">Nuevo {{view}}</h4>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-7 center-block" style="float: none;">
                            {% autoescape %}
                                {{ msg|raw }} 
                            {% endautoescape %}

                            <form class="form-horizontal" action="{{view}}/add/" method="{{method}}">
                                <div class="form-group">
                                    <label for="c" class="control-label">Campo *</label>
                                    <input type="text" name="c" class="form-control" placeholder="Escribe algo...">
                                </div>

                                
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                        </div>
                        

                    </article>

                </section>
            </div>
            {% include 'templates/footer' %}
        </div>
    </div>


    {% include 'templates/scripts' %}

</body>
</html>
{% endblock %}
