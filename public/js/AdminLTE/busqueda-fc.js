/// la variable asistentes_solicitados es para saber si se solicitan solo los discipulos del asistente logueado o todos los asistenets
var BusquedaFB = function(input, panel_ppl, panel, url, funcion, sql_adicional) {
	this.tiempoTrascurrido;
	this.input_busqueda=input;
	this.busqueda_registros=""; // variable que va a ser llena con lo que tenga el input llamado "busqueda"
	this.panel=panel;
	this.url=url;
	this.funcion = funcion;
	//this.winPanel=$("#panel-ppl-lideres");
	this.winPanel=panel_ppl;
	var bandera_mas_registros=0;
	alto_panel_ppl=0;
	var alto_panel=0;
	cant_registros_cargados=10;
	this.total_registros=0;
	

	$('.busqueda-fb').click(function(){
		this.select();
	})

	function inicializar(){
	        alto_panel_ppl=panel_ppl.height()+2;
	        alto_panel=$("#"+panel).height()-alto_panel_ppl;
	}
	//cuando la persona se ubica en el input de busqueda aparece el panel de asistentes
	this.muestraPanel = function (html) {
	    

	    panel_ppl.fadeIn(100);
	    panel_ppl.siblings("div.footer").fadeIn(100);
	    panel_ppl.siblings("div.footer").css("display", "flex");
	    html.unbind('click');///primero se eliminan todos los ateriores eventos click
	    html.click(function () {
	    	panel_ppl.fadeOut(100);
	    	panel_ppl.siblings("div.footer").fadeOut(100);
	    });
	    //la siguinte linea impide que cuando le den click al inpu de busqueda se cierre el panel de resultados
	    this.input_busqueda.click(function (e) {
	        e.stopPropagation();

	    });
	}

	this.actualizaPanel = function (html) {
	    setTimeout(function () {
	        panel_ppl.fadeIn(100);

	        panel_ppl.siblings("div.footer").fadeIn(100);
	        panel_ppl.siblings("div.footer").css("display", "flex");

	        html.unbind('click');///primero se eliminan todos los anteriores eventos click
		    html.click(function () {
		    	panel_ppl.siblings("div.footer").fadeOut(100);
		    	panel_ppl.fadeOut(100);
		    });
		    buscarRegistros("remplazar");
	        
	    } , 50);
	    //la siguinte linea impide que cuando le den click al input de busqueda se cierre el panel de resultados
	    this.input_busqueda.click(function (e) {
	        e.stopPropagation();
	    });
	}

	this.validarTecla =function (evento){
	    code=evento.keyCode;
	    if(code>111 && code<122)
	        return false;
	    else if(code>15 && code<32)
	        return false;
	    else if(code>32 && code<46)
	        return false;
	    else if(code>90 && code<94)
	        return false;
	    else if(code>143)
	        return false;
	    else if(code==9)
	        return false;
	    else
	        return true;

	}

	
	this.input_busqueda.keydown(function(ev) {
	  if(validarTecla(ev))
	    {
	        if(this.tiempoTrascurrido)
	        {
	          clearTimeout(this.tiempoTrascurrido);
	        }
	        this.tiempoTrascurrido = setTimeout(buscarRegistros,200, "remplazar");
	    }
	});

	this.buscar_registros = function(){
		buscarRegistros("remplazar");
	}

    panel_ppl.scroll(function () {
    	inicializar();
    	//alert(panel_ppl.scrollTop()+" "+alto_panel);
        if (panel_ppl.scrollTop() > alto_panel && bandera_mas_registros==0 )
        {
        	//alert("condicion cumplida");
            bandera_mas_registros=1;
            buscarRegistros('anadir');
        }
        
    });


	this.cargarPrimerosRegistros = function(){
		buscarRegistros('remplazar');
	}

	this.actualizarSqlAdicional = function(sql_nuevo){
		sql_adicional=sql_nuevo;
	}

	//función para ejecutar busqueda de asistentes
	//accion puede contener anadir o remplazar para 
	//saber si el contenido neuvo debe añadirse o remplazar 
	function buscarRegistros(accion){  
	    busqueda_registros=input.val();
	    
	    //////aqui añade el cargando
	    if(accion=="remplazar")
	    {
	        cant_registros_cargados=0;
	        $("#"+panel+" li").remove();
	        $("#"+panel).append("<li id='cargando-notif'><center><img class='img-responsive' width='30px' src='/img/ajax-loader.gif' /><center></li>");
	    }
	    else
	    {
	        $("#"+panel+" li:last").after("<li id='cargando-notif'><center><img class='img-responsive' width='30px' src='/img/ajax-loader.gif' /><center></li>");
	    }
	    ///la url varia dependiendo de si hay algo en el campo de busqueda

	    var url_l=url+"/"+cant_registros_cargados;

	    if(sql_adicional==""){
	    	sql_adicional="1=1";
	    }
	     sql_adicional=sql_adicional.replace(" ", "~");
	    url_l+="/"+sql_adicional;

	    if(busqueda_registros!=""){
	      url_l+="/"+busqueda_registros;
	    }



	    $.ajax({url:url_l, cache:false, type:"POST",success:function(resp)
	    {

	        if(accion=="remplazar")
	        {
	            //se remueve todo el contenido del panel
	            $("#"+panel+" li").remove();
	            $("#"+panel).append(resp); //se añade el nuevo contenido	
	            alto_panel=$("#"+panel).height()-alto_panel_ppl;
	            //alert("busqueda "+panel_ppl.scrollTop()+" "+alto_panel);         
	            //panel_ppl.scrollTop(0);
	            cant_registros_cargados=cant_registros;// _asistentes es enviada desde el controlador por el metodo ajax 
	        }
	        else
	        {
	            //se añade el nuevo contenido al final
	            $("#"+panel+" li:last").after(resp);
	            /////// quitar el icono cargando
	            $("#"+panel+" #cargando-notif").remove();
	            alto_panel=$("#"+panel).height()-alto_panel_ppl;
	            cant_registros_cargados+=cant_registros;// _asistentes es enviada desde el controlador por el metodo ajax 
	        }
	        
	         
	        panel_ppl.siblings("div.footer").html("Mostrando "+cant_registros_cargados+" resultados de "+total_registros_ajax+"");
	        funcion();
	        
	        
	        
	        this.total_registros=total_registros_ajax;

	        //////bandera se enciende siempre y cuando hayan mas registros por mostrar
	        if(cant_registros_cargados>= this.total_registros){
	          bandera_mas_registros=1;
	        }else
	          bandera_mas_registros=0;  
	    }
	    });
	  }
}