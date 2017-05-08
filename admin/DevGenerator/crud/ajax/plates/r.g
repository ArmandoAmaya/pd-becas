<?= $this->insert('templates/header') ?>

    <div class="container devcontainer">
        <div class="panel panel-default devpanel">
            <div class="panel-body">
                <?= $this->insert('templates/nav') ?>

                <section class="devbody">
                    <header class="text-center">
                        <h3>Gestión de (Título)</h3>
                        <hr>
                    </header>
                    <article class="col-md-12 col-xs-12 col-sm-12">
                        <h4 class="text-center">Título</h4>
            
                        <?php if (false != $data): ?>
                            
                        <table class="table table-bordered">
                            <thead>
                                <th>id</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $d): ?>
                                <tr id="tr_{{view}}_<?= $d['id']  ?>">
                                    <td style="vertical-align:middle;"><?= $d['id'] ?></td>
                                    <td style="vertical-align:middle;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Acción</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{view}}/edit/<?= $d['id']  ?>"><i class="fa fa-edit"></i> Editar</a></li>
                                                <li><a onclick="deleteModal('{{view}}','<?= $d['id']  ?>',true)"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>                 
                                <?php endforeach ?>                             
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="alert alert-info">
                            <strong>Información </strong> No existen registros en la db.
                        </div>
                        <?php endif ?>
                            
                        
                        
                    
                        <a href="{{view}}/add/" class="btn btn-info"><i class="fa fa-plus"></i> Crear Nuevo</a>
                    </article>

                </section>

            </div>
            <?= $this->insert('templates/footer') ?>
        </div>
    </div>
    
    <?= $this->insert('templates/scripts') ?>

</body>
</html>

