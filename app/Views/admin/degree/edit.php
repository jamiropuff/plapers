<?php //echo "<pre>", var_dump($planteles), "</pre>"; ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <!-- Info General -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Información General</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="titulo_menu">Título para el Menú</label>
                                    <input type="text" id="titulo_menu" name="titulo_menu" class="form-control" value="<?=$oferta_educativa->titulo_menu;?>">
                                </div>

                                <div class="form-group">
                                    <label for="titulo">Título de la Oferta Educativa</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?=$oferta_educativa->titulo;?>">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="duracion">Duración</label>
                                            <input type="text" id="duracion" name="duracion" class="form-control" value="<?=$oferta_educativa->duracion;?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inicio_clases">Inicio de Clases</label>
                                            <input type="text" id="inicio_clases" name="inicio_clases" class="form-control" value="<?=$oferta_educativa->inicio_clases;?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="descripcion_info_gral">Descripción</label>
                                    <textarea id="descripcion_info_gral" name="descripcion_info_gral" class="form-control mytextarea" rows="10"><?=$oferta_educativa->descripcion;?></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="plan_estudios">Plan de Estudios</label>
                                    <input type="file" id="plan_estudios" name="plan_estudios" class="form-control">
                                    <input type="hidden" id="plan_estudios_old" name="plan_estudios_old" value="<?=$oferta_educativa->url_plan_estudios;?>">
                                    <?php if ($oferta_educativa->url_plan_estudios != '') { ?>
                                    <a href="<?= base_url() ?>/pdf/<?=$oferta_educativa->url_plan_estudios;?>" target="_blank"><?=$oferta_educativa->url_plan_estudios;?></a>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="opciones_titulacion">Opciones de Titulación</label>
                                    <input type="file" id="opciones_titulacion" name="opciones_titulacion" class="form-control">
                                    <input type="hidden" id="opciones_titulacion_old" name="opciones_titulacion_old" value="<?=$oferta_educativa->url_opciones_titulacion;?>">
                                    <?php if ($oferta_educativa->url_opciones_titulacion != '') { ?>
                                    <a href="<?= base_url() ?>/assets/images/titulacion/<?=$oferta_educativa->url_opciones_titulacion;?>" target="_blank"><?=$oferta_educativa->url_opciones_titulacion;?></a>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="rvoe">RVOE</label>
                                    <input type="file" id="rvoe" name="rvoe" class="form-control">
                                    <input type="hidden" id="rvoe_old" name="rvoe_old" value="<?=$oferta_educativa->url_rvoe;?>">
                                    <?php if ($oferta_educativa->url_rvoe != '') { ?>
                                    <a href="<?= base_url() ?>/pdf/<?=$oferta_educativa->url_rvoe;?>" target="_blank"><?=$oferta_educativa->url_rvoe;?></a>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="saveInfoGeneral(<?=$oferta_educativa->id;?>)">Guardar Información General</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Banners -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Banners</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="banner">Banner PC (1920 x 450 px)</label>
                                    <input type="file" id="banner" name="banner" class="form-control">
                                    <span class="text-info">
                                        <?php if ($oferta_educativa->banner != '') { ?>
                                        <img src="<?= base_url() ?>/assets/images/page-banner/<?=$oferta_educativa->banner;?>" height="100" class="mt-2">
                                        <?php } ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="banner_movil">Banner Móvil (400 x 450 px)</label>
                                    <input type="file" id="banner_movil" name="banner_movil" class="form-control">
                                    <span class="text-info">
                                        <?php if ($oferta_educativa->banner_mobile != '') { ?>
                                        <img src="<?= base_url() ?>/assets/images/page-banner/<?=$oferta_educativa->banner_mobile;?>" width="115" class="mt-2">
                                        <?php } ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="banner_posicion">Posición Banner</label>
                                    <select id="banner_posicion" name="banner_posicion" class="form-control">
                                        <option value="center" <?php if($oferta_educativa->banner_posicion == 'center'){ echo 'selected'; } ?>>center</option>
                                        <option value="top" <?php if($oferta_educativa->banner_posicion == 'top'){ echo 'selected'; } ?>>top</option>
                                        <option value="bottom" <?php if($oferta_educativa->banner_posicion == 'bottom'){ echo 'selected'; } ?>>bottom</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="saveBanners(<?=$oferta_educativa->id;?>)">Guardar Banners</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Video</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <input type="text" id="video" name="video" class="form-control" value="<?=$oferta_educativa->video;?>">
                                    <span class="text-info">
                                        <?php if ($oferta_educativa->video != '') { ?>
                                            <iframe width="260" height="200" src="<?=$oferta_educativa->video;?>" title="<?=$oferta_educativa->titulo;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen controls></iframe>
                                        <?php } ?>
                                    </span>
                                </div>


                                <?php
                                $check_video = '';
                                if( isset($oferta_educativa->video_activo) && $oferta_educativa->video_activo == 1){
                                    $check_video = 'checked';
                                }
                                ?>

                                <div class="form-group">
                                    <label for="banner_posicion">Video Activo / Inactivo</label>
                                    <div class="card-body">
                                        <input type="checkbox" id="video_activo" <?=$check_video;?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="saveVideo(<?=$oferta_educativa->id;?>)">Guardar Video</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Inscripción -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Inscripción</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="archivo_inscripcion">Archivo</label>
                                    <input type="file" id="archivo_inscripcion" name="archivo_inscripcion" class="form-control">
                                    <a id="archivo_inscripcion_upd" target="_blank"></a>
                                </div>

                                <div class="form-group">
                                    <button id="btnInscripcion" class="btn btn-primary" onclick="addInscripcion(<?=$oferta_educativa->id;?>)">Agregar Inscripción</button>
                                    <button id="btnCancelInscripcion" class="btn btn-dark" style="display:none;" onclick="cancelInscripcion(<?=$oferta_educativa->id;?>)">Cancelar Edición</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover table-response ">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Archivo</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($inscripcion as $insc): ?>
                                        <tr>
                                            <td><?=$insc->descripcion;?></td>
                                            <td><a href="<?= base_url() ?>/pdf/<?=$insc->url;?>" target="_blank"><?=$insc->url;?></a></td>
                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="editInscripcion(<?=$insc->id;?>,<?=$oferta_educativa->id;?>,'<?=$insc->descripcion;?>','<?=$insc->url;?>','<?= base_url() ?>/pdf/')"></i></td>
                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delInscripcion(<?=$insc->id;?>)"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Inversión -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Inversión</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="inversion">Descripción</label>
                                    <input type="text" id="inversion" name="inversion" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button id="btnInversion" class="btn btn-primary" onclick="addInversion(<?=$oferta_educativa->id;?>)">Agregar Inversión</button>
                                    <button id="btnCancelInversion" class="btn btn-dark" style="display:none;" onclick="cancelInversion(<?=$oferta_educativa->id;?>)">Cancelar Edición</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($inversion as $inver): ?>
                                        <tr>
                                            <td><?=$inver->inversion;?></td>
                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="editInversion(<?=$inver->id;?>,<?=$oferta_educativa->id;?>,'<?=$inver->inversion;?>')"></i></td>
                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delInversion(<?=$inver->id;?>)"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Planteles -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Planteles</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="nombre_plantel">Título</label>
                                    <input type="text" id="nombre_plantel" name="nombre_plantel" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button id="btnTituloPlantel" class="btn btn-primary" onclick="addTituloPlantel(<?=$oferta_educativa->id;?>)">Agregar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1; $plantel_id_old = ''; $boton_descripcion_add = 0; //echo count($planteles); ?>
                                        <?php for ($i = 0; $i < count($planteles); $i++): ?>
                                            <?php $plantel_id = $planteles[$i]['id']; ?>

                                            <?php 
                                            
                                            $op = 'plantel';
                                            $op_button = 'info';
                                            
                                            if( $x == 1 ): 
                                                $plantel_id_old = $plantel_id; 

                                                // Título 1°
                                                echo '
                                                <tr>
                                                    <th class="bg-gray">'.$planteles[$i]['nombre'].'</th>
                                                    <td class="bg-gray text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="modalEditText(\''.$op.'\',\''.addslashes($planteles[$i]['nombre']).'\','.$oferta_educativa->id.','.$planteles[$i]['id'].')"></i></td>
                                                    <td class="bg-gray text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delText(\''.$op.'\','.$planteles[$i]['id'].')"></i></td>
                                                </tr>
                                                ';
                                            endif; 

                                            if ($plantel_id != $plantel_id_old) {
                                                $plantel_id_old = $plantel_id;

                                                if($boton_descripcion_add == 0){
                                                    // Boton para agregar descripciones al Título
                                                    echo '
                                                        <tr>
                                                            <td colspan=3>
                                                                <button class="btn btn-success" onclick="modalAddText(\''.$op_button.'\','.$oferta_educativa->id.','.$planteles[$i-1]['id'].')"><i class="fas fa-plus"></i> Agregar Descripción</button>
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                                $boton_descripcion_add = 0;

                                                

                                                // Título 2° en adelante
                                                echo '
                                                <tr>
                                                    <th class="bg-gray">'.$planteles[$i]['nombre'].'</th>
                                                    <td class="bg-gray text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="modalEditText(\''.$op.'\',\''.addslashes($planteles[$i]['nombre']).'\','.$oferta_educativa->id.','.$planteles[$i]['id'].')"></i></td>
                                                    <td class="bg-gray text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delText(\''.$op.'\','.$planteles[$i]['id'].')"></i></td>
                                                </tr>
                                                ';
                                            }


                                             //echo count($planteles[$i]['info']);
                                            ?>

                                            <?php 
                                            if($x > 1){
                                                if( count($planteles[$i]['info']) > 0 ){
                                                    for ($j = 0; $j < count($planteles[$i]['info']); $j++): ?>
                                                        <tr>
                                                            <td><?=$planteles[$i]['info'][$j]->info;?></td>
                                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="modalEditText('info','<?=addslashes($planteles[$i]['info'][$j]->info);?>',<?=$oferta_educativa->id;?>,<?=$planteles[$i]['id'];?>,<?=$planteles[$i]['info'][$j]->id;?>)"></i></td>
                                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delText('info',<?=$planteles[$i]['info'][$j]->id;?>)"></i></td>
                                                        </tr>

                                                        <?php
                                                        if( ($i == count($planteles)-1) && ($j == count($planteles[$i]['info'])-1) ){
                                                            // Boton para agregar descripciones al Título (último botón)
                                                            echo '
                                                                <tr>
                                                                    <td colspan=3>
                                                                        <button class="btn btn-success" onclick="modalAddText(\''.$op_button.'\','.$oferta_educativa->id.','.$planteles[$i]['id'].')"><i class="fas fa-plus"></i> Agregar Descripción</button>
                                                                    </td>
                                                                </tr>
                                                            ';
                                                        }
                                                    endfor;
                                                }else{
                                                    echo '
                                                    <tr>
                                                        <td colspan=3>
                                                            <button class="btn btn-success" onclick="modalAddText(\''.$op_button.'\','.$oferta_educativa->id.','.$planteles[$i]['id'].')"><i class="fas fa-plus"></i> Agregar Descripción</button>
                                                        </td>
                                                    </tr>
                                                    ';
                                                    $boton_descripcion_add = 1;
                                                }
                                            }
                                            $x++;
                                        endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Promociones -->
            <div class="col-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Promociones</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="orden_promo">Ordenamiento de la Promoción</label>
                                    <input type="text" id="orden_promo" name="orden_promo" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="archivo_promo">Archivo (1020 x 1100 px)</label>
                                    <input type="file" id="archivo_promo" name="archivo_promo" class="form-control">
                                    <a id="archivo_promo_upd" target="_blank"></a>
                                </div>

                                <div class="form-group">
                                    <button id="btnPromocion" class="btn btn-primary" onclick="addPromocion(<?=$oferta_educativa->id;?>)">Agregar Promoción</button>
                                    <button id="btnCancelPromocion" class="btn btn-dark" style="display:none;" onclick="cancelPromocion(<?=$oferta_educativa->id;?>)">Cancelar Edición</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover table-response ">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Archivo</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($promociones as $promos): ?>
                                        <tr>
                                            <td><?=$promos->orden;?></td>
                                            <td>
                                                <img src="<?= base_url() ?>/assets/images/promo/<?=$promos->promociones;?>" width="50"> 
                                                <a href="<?= base_url() ?>/assets/images/promo/<?=$promos->promociones;?>" target="_blank"><?=$promos->promociones;?></a>
                                            </td>
                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="editPromocion(<?=$promos->id;?>,<?=$oferta_educativa->id;?>,<?=$promos->orden;?>,'<?=$promos->promociones;?>','<?= base_url() ?>/assets/images/promo/')"></i></td>
                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delPromocion(<?=$promos->id;?>)"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Eventos -->
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Eventos</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="orden_evento">Ordenamiento del Evento</label>
                                    <input type="text" id="orden_evento" name="orden_evento" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="archivo_evento">Archivo (800 x 560 px)</label>
                                    <input type="file" id="archivo_evento" name="archivo_evento" class="form-control">
                                    <a id="archivo_evento_upd" target="_blank"></a>
                                </div>

                                <div class="form-group">
                                    <label for="titulo_evento">Título del evento</label>
                                    <input type="text" id="titulo_evento" name="titulo_evento" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fecha_inicio_evento">Fecha de inicio</label>
                                            <input type="date" id="fecha_inicio_evento" name="fecha_inicio_evento" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fecha_fin_evento">Fecha de finalización</label>
                                            <input type="date" id="fecha_fin_evento" name="fecha_fin_evento" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button id="btnEvento" class="btn btn-primary" onclick="addEvento(<?=$oferta_educativa->id;?>)">Agregar Evento</button>
                                    <button id="btnCancelEvento" class="btn btn-dark" style="display:none;" onclick="cancelEvento(<?=$oferta_educativa->id;?>)">Cancelar Edición</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover table-response ">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Archivo</th>
                                            <th>Título</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha finalización</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($eventos as $evento): ?>
                                        <tr>
                                            <td><?=$evento->orden;?></td>
                                            <td>
                                                <img src="<?= base_url() ?>/assets/images/events_degree/<?=$evento->imagen;?>" width="50"> 
                                                <a href="<?= base_url() ?>/assets/images/events_degree/<?=$evento->imagen;?>" target="_blank"><?=$evento->imagen;?></a>
                                            </td>
                                            <td><?=$evento->titulo;?></td>
                                            <td><?=$evento->fecha_inicio;?></td>
                                            <td><?=$evento->fecha_fin;?></td>
                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="editEvento(<?=$evento->id;?>,<?=$oferta_educativa->id;?>,<?=$evento->orden;?>,'<?=$evento->titulo;?>','<?=$evento->fecha_inicio;?>','<?=$evento->fecha_fin;?>','<?=$evento->imagen;?>','<?= base_url() ?>/assets/images/events_degree/')"></i></td>
                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delEvento(<?=$evento->id;?>)"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Instalaciones -->
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3>Instalaciones</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label for="texto_instalaciones">Texto Instalaciones</label>
                                    <input type="text" id="texto_instalaciones" name="texto_instalaciones" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button id="btnInstalacion" class="btn btn-primary" onclick="addInstalaciones(<?=$oferta_educativa->id;?>)">Agregar</button>
                                    <button id="btnCancelInstalacion" class="btn btn-dark" style="display:none;" onclick="cancelInstalacion(<?=$oferta_educativa->id;?>)">Cancelar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover table-response ">
                                    <thead>
                                        <tr>
                                            <th>Texto</th>
                                            <th>Fotos</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($instalaciones as $instalacion): ?>
                                        <tr>
                                            <td><?=$instalacion->texto;?></td>
                                            <td class="text-center"><i class="fas fa-image text-info cur-pointer" onclick="fotosInstalacion(<?=$instalacion->id;?>)"></i></td>
                                            <td class="text-center"><i class="fas fa-pencil-alt text-warning cur-pointer" onclick="editInstalacion(<?=$instalacion->id;?>,<?=$oferta_educativa->id;?>,'<?=$instalacion->texto;?>')"></i></td>
                                            <td class="text-center"><i class="fas fa-trash-alt text-danger cur-pointer" onclick="delInstalacion(<?=$instalacion->id;?>)"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            

        </div>
    </div>
</section>


<!-- Modal - titulo plantel -->
<div class="modal fade" id="modaPlantelText" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="titlePlantelModal" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <div class="form-group">
                            <label for="info_plantel">Título</label>
                            <input type="text" id="info_plantel" name="info_plantel" class="form-control">
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnPlantelModal" type="button" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal - fotos instalaciones -->
<div class="modal fade" id="modaFotoInstalaciones" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Instalaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <div class="form-group">
                            <label for="foto_instalaciones">Foto de instalaciones</label>
                            <input type="file" id="foto_instalaciones" name="foto_instalaciones" class="form-control">
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover table-response ">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnSaveFotoModal" type="button" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>