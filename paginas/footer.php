<footer class="py-3 bg-primary" style="align-self: flex-end; width: 100%">
      <div class="container">
        <hr class="bg-white">
        <p class="m-0 text-center text-white">Copyright &copy; Ftos. de Contabilidad 01 - 2019</p>
      </div>      
</footer>

    <!-- Bootstrap core JavaScript -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/jquery/jquery2.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>

    <script src="files_login/login-register.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <!-- Para modulos de categorias -->
    <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script> 
        <script src="js/superfish.js"></script>           
        <script src="js/easyResponsiveTabs.js"></script>        
        <!-- <script src="js/jquery.waypoints.min.js"></script> -->
        <!-- Main JS -->
        <script src="js/jquery.numeric.js"></script>
        
    

 <script>
  $(function(){ 
    /*ver imagen grande en modal*/
    document.querySelectorAll(".modal-container img").forEach(el=>{
      el.addEventListener("click",function(ev){
        ev.stopPropagation();
        this.parentNode.classList.add("active");
      })
    })

    document.querySelectorAll(".modal-container").forEach(el=>{
      el.addEventListener("click",function(ev){
        this.classList.remove("active");
      })
    })
    //cargar pdf
    $("#btnReporteUs").click(function(event) {
      $("#capa").load('paginas/php/reporteUsuarios.php');
    });
  //crear cuenta  	
    $('#btnCrear').click(function(){
        var1 = $('#correo').val();
        var2 = $('#usuario').val();
        var3 = $('#password').val();
        if (var1 == 0 || var2 == 0 || var3 == 0 ) {
            swal(
              '¡Atención!',
              'Completa todos los campos',
              'warning'
            )  
        }else{
          var email = $('#correo').val();
          var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
          if (caract.test(email) == false){
           swal(
              '¡Atención!',
              'Ingresa Un correo valido',
              'warning'
            )                   
          }else{
            datos =  $('#formCrearCuenta').serializeArray();            
            $.ajax({
                 type:"POST",
                 data:datos,
                 url:"paginas/php/agregarCuenta.php",
                 success:function(r){               
                  
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'Gracias por registrarte',
                          'success'
                        )
                        setTimeout("location.href='paginas/log_in.php'", 1500);                 
                    }else if (r == 2) {
                        swal(
                          '¡Atención!',
                          '¡El usuario ya existe!',
                          'warning'
                        )
                    }else if (r == 3) {
                        swal(
                          '¡Atención!',
                          '¡El correo ya esta en uso!',
                          'warning'
                        )
                    }else{
                        swal(
                          'Error!',
                          'No se pudo completar el registro',
                          'error'
                        )                                       
                    }
                 }
            });            
          }
                  
        }
    	
    });
// login
    $('#btnLogin').click(function(){
        var1 = $('#usu').val();
        var2 = $('#pass').val();        
        if (var1 == 0 || var2 == 0) {
            swal(
              '¡Atención!',
              'Completa todos los campos',
              'warning'
            )  
        }else{
            datosf =  $('#formLogin').serializeArray();
            $.ajax({
                 type:"POST",
                 data:datosf,
                 url:"paginas/php/controLogin.php",
                 beforeSend:function(){
                    $('#btnLogin').val("Validando....");
                    },
                 success:function(datos){
                    $('#btnLogin').val("Ingresar");             
                    if (datos == "1") {
                        swal(
                          '¡Exito!',
                          'Cuenta validada, redireccionando...',                      
                          'success'
                        )
                        setTimeout("location.href='index.php'", 1300);          
                    }else if(datos == "2"){
                      swal(
                      '¡Error!',
                      'El usuario no existe',
                      'error'
                      )  
                    }else{
                        swal(
                          '¡Error!',
                          'Datos Erroneos',
                          'error'
                        )  
                    }
                 }
            });     
         }      
    });
// Agregar categoria
 $('#frmAgregaCategoria').on('submit',function(e){
        e.preventDefault();
        var1 = $('#ncat').val();
        if (var1 == 0) {
            swal(
              '¡Atención!',
              'Agrega un nombre a la categoria',
              'warning'
            )
            var1.focus();  
        }else{
            $.ajax({
                type:"POST",
                url:"paginas/php/agregarCategoria.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                 success:function(r){               
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'Categoria Agregada con exito',
                          'success'
                        )
                        setTimeout("location.reload()", 1100);                    
                    }else if(r == 2){
                        swal(
                          '¡Atención!',
                          'La imagen es muy grande',
                          'warning'
                        )                                       
                    }else if(r == 3){
                        swal(
                          '¡Atención!',
                          'La imagen no cumple el formato',
                          'warning'
                        )                                       
                    }else{
                        swal(
                          '¡Error!',
                          'No se pudo Agregar la categoria',
                          'error'
                        )                                       
                    }
                 }
            });   
        }
      
    });

//agregar Usuario
  $('#addUsuario').click(function(){
        var1 = $('#correoA').val();
        var2 = $('#usuarioA').val();
        var3 = $('#contraA').val();
        if (var1 == 0 || var2 == 0 || var3 == 0) {
            swal(
              '¡Atención!',
              'Completa los campos Obligatorios',
              'warning'
            )  
        }else{
          var email = var1;
          var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
          if (caract.test(email) == false){
           swal(
              '¡Atención!',
              'Ingresa Un correo valido',
              'warning'
            )                   
          }else{
            datos =  $('#frmAgregarUsuarioA').serializeArray();            
            $.ajax({
                 type:"POST",
                 data:datos,
                 url:"paginas/php/agregarCuenta.php",
                 success:function(r){               
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'Usuario Agregado con exito',
                          'success'
                        )
                        setTimeout("location.reload()", 1100);                    
                    }else{
                        swal(
                          'Error!',
                          'No se pudo Agregar el usuario',
                          'error'
                        )                                       
                    }
                 }
            });            
          }
                  
        }
      
    });

// modificar usuario
    $('#btnModificarUsuario').click(function(){
        datosuser =  $('#formModificar').serialize();
        $.ajax({
             type:"POST",
             data:datosuser,
             url:"paginas/php/modificarUsuario.php",
             success:function(r){               
                if (r == 1) {
                    swal(
                      '¡Exito!',
                      'Datos Actualizados con Exito',
                      'success'
                    )
                    setTimeout("location.reload()", 1100);                 
                }else{
                    swal(
                      'Error!',
                      'No se pudieron actulizar los datos',
                      'error'
                    )                                       
                }
             }
        });
    });
    recargarLista();
    recargarList();
    $('#categoria').change(function(){
      recargarLista();      
    })
     $('#categ').change(function(){
      recargarList();      
    })
    // funcion para cargar las subcategorias del select 
    function recargarLista(){
      $.ajax({
        type:"POST",
        data:"categoria=" + $('#categoria').val(),
        url:"paginas/php/mostrarSubcats.php",        
        success:function(r){   
          $('#subcategoria').html(r);          
        }        
      });
    }
    function recargarList(){
      $.ajax({
        type:"POST",
        data:"categoria=" + $('#categ').val(),
        url:"paginas/php/mostrarSubcats.php",        
        success:function(r){   
          $('#subcateg').html(r);          
        }        
      });
    }

    // agregar anuncio
      $('#formPublicarAnuncio').on('submit',function(e){
        e.preventDefault();
        var1 = $('#nombreA').val();
        var2 = $('#precioA').val();
        var3 = $('#categoria').val();
        var4 = $('#subcategoria').val();        
        if (var1 == 0 || var2 == 0 || var3 == 0 || var4 == 0 ) {
            swal(
              '¡Atención!',
              'Faltan algunos campos',
              'warning'
            )  
        }else{
            // datos =  $('#formPublicarAnuncio').serialize();            
            $.ajax({
                 type:"POST",
                 url:"paginas/php/agregarAnuncio.php",
                 data: new FormData(this),
                 contentType: false,
                 cache: false,
                 processData:false,
                 success:function(r){    
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'Anuncio Agregado con exito',
                          'success'
                        )
                        setTimeout("location.reload()", 1100);                    
                    }else if(r == 2){
                        swal(
                          '¡Atención!',
                          'La imagen es muy grande',
                          'warning'
                        )                                       
                    }else if(r == 3){
                        swal(
                          '¡Atención!',
                          'La imagen no cumple el formato',
                          'warning'
                        )
                      }else{
                        swal(
                          '¡Error!',
                          'No se pudo Agregar el anuncio',
                          'error'
                        )                                       
                    }
                 }
            });
        }
      
    });

    /*agregar subcategoria*/
  $('#addsubCategoria').click(function(){
    datos = $('#frmAgregarsubcategoria').serialize();
    $.ajax({
      type: "POST",
      data: datos,
      url: "paginas/php/agregarSubcategoria.php",
      success:function(r){
        if(r==1){
         swal(
            '¡Exito!',
            'Sub categoria Agregada con exito',
            'success'
          )
         setTimeout("location.reload()", 1000);   
        }else{
           swal(
            'Error!',
            'No se pudo agregar la sub categoria',
            'error'
          )    
        }
       }
    });
  });

  //modificar foto de perfil
   $('#file-submit').on('submit',function(e){
        e.preventDefault();
            $.ajax({
                type:"POST",
                url:"paginas/php/modificarImagenCuenta.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                 success:function(r){               
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'Foto modificada con exito',
                          'success'
                        )
                        setTimeout("location.reload()", 1000);                    
                    }else if(r == 2){
                        swal(
                          'warning',
                          'La imagen es muy grande',
                          '¡Atención!'
                        )                                       
                    }else if(r == 3){
                        swal(
                          '¡Atención!',
                          'La imagen no cumple el formato',
                          'warning'
                        )                                       
                    }else{
                        swal(
                          'Error!',
                          'No se pudo modificar la foto',
                          'error'
                        )                                       
                    }
                 }
            });   
      
    });

  /*modificar categorias seleccionadas*/
  $('#btnModCates').click(function(){
     swal({
      title: '¿Estás seguro de modificar sus categorias?',          
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $('#formModCates').submit();
      }
  });

   
  });

  $('#contactForm').on('submit',function(e){
    e.preventDefault();

    correo = $('#emailc').val();
    mensa = $('#mensajec').val();
    if (correo == 0 && mensa == 0){
       swal(
          '¡Atención!',
          'Complete los campos requeridos',
          'warning'
        )   
    }else{
       $.ajax({
          type:"POST",
          url:"paginas/php/agregarComentario.php",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
           success:function(r){               
              if (r == 1) {
                  swal(
                    '¡Exito!',
                    'Mensaje enviado con exito',
                    'success'
                  )
                $("#contactForm")[0].reset();                    
              }else{
                  swal(
                    'Error!',
                    'No se pudo enviar el mensaje',
                    'error'
                  )                                       
              }
           }
      });   
    }

  });

  $('#btnCambiarContra').click(function(){
        dato1 = $('#vieja').val();
        dato2 = $('#nueva').val();
        dato3 = $('#rnueva').val();
        if (dato1 == 0 || dato2 == 0 || dato3 == 0) {
           swal(
                '¡Atención!',
                'Completa todos los campos',
                'warning'
              ) 
        }else{
          if (dato2.length < 4 || dato3.length < 4) {
             swal(
                '¡Atención!',
                'La contraseña debe de tener como minimo 4 caracteres',
                'warning'
              )
          }else{
            dataContra =  $('#formCambiarPass').serialize();
            $.ajax({
                 type:"POST",
                 data:dataContra,
                 url:"paginas/php/cambiarContra.php",
                 success:function(r){               
                    if (r == 1) {
                        swal(
                          '¡Exito!',
                          'La contraseña de cambio correctamente',
                          'success'
                        )
                        $('#cambioPass').modal('hide');                
                         $("#formCambiarPass")[0].reset();
                    }else if (r == 2) {
                        swal(
                          '¡Atención!',
                          'Las contraseñas no son iguales ',
                          'warning'
                        )                
                    }else if (r == 3) {
                        swal(
                          '¡Atención!',
                          'La contraseña antigua es incorrecta',
                          'error'
                        )                
                    }else{
                        swal(
                          '¡Error!',
                          'No se pudo cambiar la contraseña',
                          'error'
                        )                                       
                    }
                 }
            });
          }
        }
    });

});
</script>

  </body>

</html>