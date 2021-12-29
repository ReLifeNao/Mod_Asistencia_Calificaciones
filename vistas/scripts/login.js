$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    
$.ajax({
    url:"../ajax/usuario.php?op=verificar",

    dataType:"json",
    data:{
        "logina":logina,
        "clavea":clavea
    },
    type:"post",
    success:function(r){
        console.log(r)
        if(r==null){
            //aqui el verificar alumno y su login
                
            $.ajax({
                url:"../ajax/loginalumnos.php?op=verificar",
        
                dataType:"json",
                data:{
                    "logina":logina,
                    "clavea":clavea
                },
                type:"post",
                success:function(s){
                    console.log(s)
                    if(s==null){
                        bootbox.alert("Usuario o Contraseña incorrectos");
                    }
                    else{
                        $(location).attr("href","escritorio_copy.php");
                        //$(location).attr("href","nada.html");
                    }
                    //bootbox.alert("entro al if"+data);yukio
                },error:function(){
                    //bootbox.alert("entro al if"+data);
                    console.log("error")
                }
            })

   
        }else{
            $(location).attr("href","escritorio.php");
        }
        //bootbox.alert("entro al if"+data);
    },error:function(jqXHR){
        //bootbox.alert("entro al if"+data);
        console.log(jqXHR.responseText)
        console.log("no hay conexion")
    }
})
})