{% extends 'templates/header' %}

{% block content %}
    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                {% include('templates/nav') %}

                <section class="devbody">
                    <header class="text-center">
                        <h3>Título del módulo</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                       
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
