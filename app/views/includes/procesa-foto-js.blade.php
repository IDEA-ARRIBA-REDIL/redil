          @if(isset($asistente->id))
          var foto_id={{ $asistente->id }};
          var nombre_foto="{{ $asistente->foto }}";
          @else
            var foto_id="new-{{ Auth::user()->id }}";
            var nombre_foto="default-m.png";
          @endif
          var x=0;
          var y=0;
          var w=0;
          var h=0;
          var recorte=0; ///esta variable es para saber si el usuario si dió clic en el boton recortar
          var error_global=0; //me guarda un nuemro en caso de que la imagen haya devurlto un error

          function actualizaCoordenadas(c)
          {
            x=c.x;
            y=c.y;
            w=c.w;
            h=c.h;
            //alert(w+" alto: "+h+" x: "+x+" y: "+y);
          }

          function limpiaCoordenadas(c)
          {
            x=0;
            y=0;
            w=0;
            h=0;
            //alert(w+" alto: "+h+" x: "+x+" y: "+y);
          }

          function checkCoords()
          {
            if(w>0) return true;
            else if(error_global==0)
            alert("Seleccione un area de la imagen");
            return false;
          }
            
          $(document).ready(function() {
            $("#modal_recorta_foto").modal({
              backdrop: 'static',
              show: false
            });

            $('#foto').change(function(){ 
              if($("#foto").val!="")
              {
                $("#panel-imagen").html('<img src="/img/ajax-loader1.gif" id="cargando" />');
                var formdata = new FormData($("#formulario")[0]);
                $("#modal_recorta_foto").modal("show", "true");
                var ancho_nav=$( window ).width();
                var alto_nav=$( window ).height();
                $.ajax({url:"/asistentes/upload-foto-ajax/"+foto_id+"/"+ancho_nav+"/"+alto_nav, data: formdata, contentType: false, processData: false, type:"POST",success:function(resp)
                    {
                      
                      $("#panel-imagen").html(resp);

                      error_global=error;
                      if(error==0)
                      {
                        //alert(ancho);
                        var anchoImg=ancho;
                        var altoImg=alto;
                        var tam_default=107; ////este es paar saber el tamaño del cuadro de recorte incialmente
                        if(ancho<215 && ancho<alto)
                        {
                          tam_default=(ancho); 
                        }
                        else if(alto<215 && alto<ancho)
                        {
                          //alert("alto alto alto");
                          tam_default=(alto); 
                        }
                        $("#crop").Jcrop({
                          aspectRatio: 1,
                          onSelect: actualizaCoordenadas,
                          onRelease: limpiaCoordenadas,
                          minSize: [100, 100],
                          aspectRatio: 1,
                          bgOpacity: 0.2,
                          bgColor: 'white',
                          addClass: 'jcrop-light',
                          setSelect: [(anchoImg/2)-tam_default, (altoImg/2)-tam_default, (anchoImg/2)+tam_default, (altoImg/2)+tam_default]
                        });
                      }
                    }
                  });
                }
             });

            $('#modal_recorta_foto').on('hidden.bs.modal', function () {
                if(recorte!=1)
                  $("#foto").val("");
                else
                  recorte=0;
                error_global=0;
                
            })

            $('#limpiar-foto').click(function(){ 
              $("#foto-hide").val("");
              <?php
                $fechaSegundos = time(); 
                $strNoCache = "?nocache=$fechaSegundos"; 
              ?>
              @if(isset($asistente->id))
              $("#foto-cortada").attr("src", "/img/fotos/"+nombre_foto+"{{ $strNoCache }}");
              @else
              if($("#genero-f").parent(".iradio_minimal").attr("aria-checked")=="true")
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-f.png");
              }
              else
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-m.png");
              }
              @endif
              $("#div-nueva-foto").hide();
            });

            $('.rotar').click(function(){ 
              $("#panel-imagen").html('<img src="/img/ajax-loader1.gif" id="cargando" />');
              var ancho_nav=$( window ).width();
              var alto_nav=$( window ).height();
              var angulo=$(this).attr("id");
              $.ajax({url:"/asistentes/rota-foto-ajax/"+foto_id+"/"+angulo+"/"+ancho_nav+"/"+alto_nav, type:"POST",success:function(resp)
                  {
                    $("#panel-imagen").html(resp);
                    //alert(ancho);
                    var anchoImg=ancho;
                    var altoImg=alto;
                    var tam_default=107; ////este es paar saber el tamaño del cuadro de recorte incialmente
                    if(ancho<215 && ancho<alto)
                    {
                      tam_default=(ancho); 
                    }
                    else if(alto<215 && alto<ancho)
                    {
                      tam_default=(alto); 
                    }
                    $("#crop").Jcrop({
                      aspectRatio: 1,
                      onSelect: actualizaCoordenadas,
                      onRelease: limpiaCoordenadas,
                      minSize: [100, 100],
                      aspectRatio: 1,
                      bgOpacity: 0.2,
                      bgColor: 'white',
                      addClass: 'jcrop-light',
                      setSelect: [(anchoImg/2)-tam_default, (altoImg/2)-tam_default, (anchoImg/2)+tam_default, (altoImg/2)+tam_default]
                    });
                  }
                });
            });

            $('#recortar').click(function(){ 
              
              
              if(checkCoords())
              {
                $("#modal_recorta_foto").modal("hide");
                $("#foto-cortada").attr("src", "/img/ajax-loader1.gif");
                recorte=1;
                $.ajax({url:"/asistentes/recorta-foto-ajax/"+foto_id+"/"+x+"/"+y+"/"+w+"/"+h, data: { ancho : ancho }, type:"POST",success:function(resp)
                  {
                    $("#foto-cortada").attr("src", resp);
                    $("#foto-hide").val($("#foto").val());
                    $("#div-nueva-foto").show();
                    $("#foto").val("");
                  }
                });

              }
            });

            /*$("#crop").Jcrop({
              aspectRatio: 1,
              onSelect: actualizaCoordenadas
            });*/