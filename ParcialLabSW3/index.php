<!--Autores:Luisa María Gómez Galindez
            Jhon Dennis Caicedo Díaz
            Eduardo Nicolás Pérez Paredes-->
<?php  
    function construirCadena($dependencia, $subdependencia, $numDocumeto)
    {
        return "8." . $dependencia . "." . $subdependencia . "/" . $numDocumeto;
    }

    function guardarJSON($dependencia, $subdependencia)
    {   
        $dependencia = intval($dependencia);
        $subdependencia = intval($subdependencia);
        $datos = file_get_contents("dependencias.json");
        $datosDependencias = json_decode($datos, true);
        if($datosDependencias['arrayDependencias'][0]['dependencia'] == $dependencia)
        {
            if($datosDependencias['arrayDependencias'][0]['arraySubdependencias'][0]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][0]['arraySubdependencias'][0]['numDocumento'] = $datosDependencias['arrayDependencias'][0]['arraySubdependencias'][0]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][0]['arraySubdependencias'][0]['numDocumento']);            
            }
            if($datosDependencias['arrayDependencias'][0]['arraySubdependencias'][1]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][0]['arraySubdependencias'][1]['numDocumento'] = $datosDependencias['arrayDependencias'][0]['arraySubdependencias'][1]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][0]['arraySubdependencias'][1]['numDocumento']);            
            }            
        }
        if($datosDependencias['arrayDependencias'][1]['dependencia'] == $dependencia)
        {
            if($datosDependencias['arrayDependencias'][1]['arraySubdependencias'][0]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][1]['arraySubdependencias'][0]['numDocumento'] = $datosDependencias['arrayDependencias'][1]['arraySubdependencias'][0]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][1]['arraySubdependencias'][0]['numDocumento']);            
            }
            if($datosDependencias['arrayDependencias'][1]['arraySubdependencias'][1]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][1]['arraySubdependencias'][1]['numDocumento'] = $datosDependencias['arrayDependencias'][1]['arraySubdependencias'][1]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][1]['arraySubdependencias'][1]['numDocumento']);            
            }            
        }
        if($datosDependencias['arrayDependencias'][2]['dependencia'] == $dependencia)
        {
            if($datosDependencias['arrayDependencias'][2]['arraySubdependencias'][0]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][2]['arraySubdependencias'][0]['numDocumento'] = $datosDependencias['arrayDependencias'][2]['arraySubdependencias'][0]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][2]['arraySubdependencias'][0]['numDocumento']);            
            }
            if($datosDependencias['arrayDependencias'][2]['arraySubdependencias'][1]['subdependencia'] == $subdependencia)
            {
                $datosDependencias['arrayDependencias'][2]['arraySubdependencias'][1]['numDocumento'] = $datosDependencias['arrayDependencias'][2]['arraySubdependencias'][1]['numDocumento'] + 1;
                $numDocumeto = intval($datosDependencias['arrayDependencias'][2]['arraySubdependencias'][1]['numDocumento']);            
            }            
        }
        $nuevosDatos = json_encode($datosDependencias);
        file_put_contents('dependencias.json', $nuevosDatos);  
        $resultado = construirCadena($dependencia,$subdependencia,$numDocumeto);
        return $resultado;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DEPENDENCIAS FIET</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <h1>DEPENDENCIAS FIET</h1>
        <h2>Esta aplicación le permitirá archivar los documentos de las siguientes
            <br/>    dependencias y sus respectivas subdependencias: 
            <br/>    - Decanatura (decano, secretaria general).
            <br/>    - Departamento de sistemas (jefe de departamento, tesoreria).
            <br/>    - Departamento de electronica (jefe de departamento, tesoreria).
        </h2>
        <form action="index.php" method="post">           
            <div>
                <input type="submit" name="boton" value="Archivar documento" onclick="this.form.submit()" class="formulario2">
                <?php
                $boton="";        
                if(isset($_POST['boton']))$boton=$_POST['boton'];
                if($boton)
                {     
                    $dep = $_POST["dependencia"];
                    $subDep = $_POST["subdependencia"];
                    $res = guardarJSON($dep, $subDep);?>
                    <input type="text" id="caja" class="consecutivo" value="<?php echo $res; ?>"/>
                    <script>
                        var dep = <?php echo $dep;?>;
                        if(dep == 1)
                        {
                            document.getElementById("caja").style.backgroundColor = "red";   
                        }   
                        else if(dep == 4)
                        {
                            document.getElementById("caja").style.backgroundColor = "green";   
                        }                    
                        else
                        {
                            document.getElementById("caja").style.backgroundColor = "blue";   
                        } 
                    </script>
                <?php
                }
                ?>
            </div>
            <div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <select id="0" name="dependencia" class="formulario">
                    <option>--Seleccione una dependencia--</option>
                    <option value="1">Decanatura</option>
                    <option value="4">Departamento de sistemas</option>
                    <option value="5">Departamento de electrónica</option>                
                </select>
            </div>
            <div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <select id="1" name="subdependencia" class="formulario1">
                    <option>--Seleccione una subdependencia--</option>
                </select>
            </div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>       
            $("#0").on("change",function()
            {
                var selec = "";
                var opcionDependencia = $(this).val();
                if(opcionDependencia == "1")
                {
                    selec += '<option value = "0">--Seleccione una subdependencia--</option>';
                    selec += '<option value = "1">Decano</option>';
                    selec += '<option value = "2">Secretaría General</option>';
                    $("#1").html(selec);
                    $("#1").on("change",function()
                    {
                        var opcionSubDependencia = $(this).val();                       
                    });
                }
                else if(opcionDependencia == "4")
                {
                    selec += '<option value = "0">--Seleccione una subdependencia--</option>';
                    selec += '<option value = "1">Jefe de Departamento</option>';
                    selec += '<option value = "2">Tesoreria</option>'; 
                    $("#1").html(selec);
                    $("#1").on("change",function()
                    {
                        var opcionSubDependencia = $(this).val();                       
                    });
                }
                else
                {
                    selec += '<option value = "0">--Seleccione una subdependencia--</option>';
                    selec += '<option value = "1">Jefe de Departamento</option>';
                    selec += '<option value = "2">Tesoreria</option>'; 
                    $("#1").html(selec);
                    $("#1").on("change",function()
                    {
                        var opcionSubDependencia = $(this).val();                       
                    });
                }
            });
        </script>        
    </body>
</html>