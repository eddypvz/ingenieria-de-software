<?php
include_once('header.php');

?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Listado de archivos</h3>
                <div>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">Nombre de archivo</th>
                                <th class="border-top-0">Subido por</th>
                                <th class="border-top-0">Fecha de subida</th>
                                <th class="border-top-0">Operaciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $strQuery = "SELECT
                                            F.id_file,
                                            F.name, 
                                            F.sw_date_created, 
                                            F.status, 
                                            F.file_url,
                                            CONCAT(U.name, ' ',U.lastname) AS 'UserName', 
                                            U.user as 'UserSlug'  
                                         FROM file AS F
                                         JOIN user AS U ON U.id_user = F.id_user
                                         WHERE F.status = 'saved'
                                         AND F.id_user = {$_SESSION['login_data']['id']}";
                            $files = $db->get_array($strQuery);

                            foreach ($files as $file) {
                                ?>
                                <tr>
                                    <td><?= $file['name'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($file['sw_date_created'])) ?></td>
                                    <td><?= $file['UserName'] ?> (<?= $file['UserSlug'] ?>)</td>
                                    <td>
                                        <select class="form-select shadow-none row border-top fileOperation" data-file="<?= $file['id_file'] ?>" data-url="<?= $file['file_url'] ?>">
                                            <option class="default">-- Seleccione una operación --</option>
                                            <option value="download">Descargar</option>
                                            <option value="delete">Eliminar</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once('footer.php');