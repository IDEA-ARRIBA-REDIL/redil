<!-- el siguiente es el panel que se llenara con los registrosque seleccione el usuario, se deja vacio -->
        

        <div id="integrantes-seleccionados"> 
        @if($cursos_escuela->count()>0)

            @foreach($cursos_escuela as $curso)
                <div class="col-md-4" style="margin-top:20px">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                      <h3 class="widget-user-username"><a style="color:#fff" href="../../cursos/perfil/{{ $curso->id }}" target="_blank"> {{ $curso->nombre }} </a> </h3>  
                      <h5 class="widget-user-desc">
                      @if($curso->obligatorio)
                      Curso Obligatorio
                      @elseif(!$curso->obligatorio)
                      Curso Opcional
                      @endif
                      </h5>
                    </div>
                    <div class="widget-user-image">
                      <img class="img-circle" src="/img/fotos/default-m.png" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header">2</h5>
                            <span class="description-text">MATERIAS</span>
                          </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-8">
                          <div class="description-block" style="float:right">
                            <a href="../../materias/nuevo" class="btn btn-danger" style="margin-top:10px"> Añadir Materias <i class="fa fa-plus"></i></a>
                          </div><!-- /.description-block -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div>
                  </div><!-- /.widget-user -->
                </div>
            @endforeach
        @else
          <label>No se han creado cursos para la Escuela</label>
        @endif 
        </div>  