<?= $this->insert('templates/header') ?>

    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                <?= $this->insert('templates/nav') ?>

                <section class="devbody">
                    <header class="text-center">
                        <h3>Creación de {{view}}</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                        <h4 class="text-center">Nuevo {{view}}</h4>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-block" style="float: none;">

                            <form class="form-horizontal" id="{{view}}_form">

                                <div class="alert hide" id="ajax_{{view}}"></div>

                                    
                                <div class="form-group">
                                    <label for="c" class="control-label">Campo *</label>
                                    <input type="text" name="c" class="form-control" id="c" placeholder="Escribe algo...">
                                </div>
                                    
                                <button type="button" id="{{view}}_submit" class="btn btn-primary">Agregar</button>
                                
                            </form>
                        </div>
                        

                    </article>

                </section>
            </div>
            <?= $this->insert('templates/footer') ?>
        </div>
    </div>


    <?= $this->insert('templates/scripts') ?>
    <script src="public/dev/js/{{view}}/create.js"></script>

</body>
</html>
