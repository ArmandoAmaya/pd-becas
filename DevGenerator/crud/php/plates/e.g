<?= $this->insert('templates/header') ?>

    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                <?= $this->insert('templates/nav') ?>


                <section class="devbody">
                    <header class="text-center">
                        <h3>Edición de {{view}}</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                        <h4 class="text-center">Editar {{view}}</h4>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-7 center-block" style="float: none;">
                            <?= $msg ?>

                            <form class="form-horizontal" action="{{view}}/edit/<?= $data['id'] ?>" method="{{method}}">
                                
                                <div class="form-group">
                                    <label for="c" class="control-label">Campo *</label>
                                    <input type="text" name="c" class="form-control" placeholder="Escribe algo..." value="<?= $data['c'] ?>">
                                </div>

                                
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </div>
                        

                    </article>

                </section>
            </div>
            <?= $this->insert('templates/footer') ?>

        </div>
    </div>


    <?= $this->insert('templates/scripts') ?>


</body>
</html>

