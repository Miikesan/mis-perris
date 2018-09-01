<?php

$aceptar = $_GET["aceptar"];
$xnom = $_POST["xnom"];
$email = $_POST["email"];
$xmsg = $_POST["xmsg"];

// echo "<br><br><br>**** entra = ".$aceptar." - ".$error." - ".$xnom." - ".$email." - ".$xmsg;

if ($aceptar)
       {

	   $error=9;

	if (empty($xmsg))
	{
		$error=3;
	}	

	if (empty($email))
	{
		$error=2;
	}	

	if (empty($xnom))

	{
		$error=1;
	}	
	
	
// valida email
	$mail_correcto = 0; 
//compruebo unas cosas primeras 
	if ((strlen($email) >= 6) and (substr_count($email,"@") == 1) and (substr($email,0,1) != "@") and (substr($email,strlen($email)-1,1) != "@"))
	       { 
		if ((!strstr($email,"'")) and (!strstr($email,"\"")) and (!strstr($email,"\\")) and (!strstr($email,"\$")) and (!strstr($email," "))) 
		        { 
//miro si tiene caracter . 
			if (substr_count($email,".")>= 1)
			      { 
//obtengo la terminacion del dominio 
			             $term_dom = substr(strrchr ($email, '.'),1); 
//compruebo que la terminación del dominio sea correcta 
			             if (strlen($term_dom)>1 and strlen($term_dom)<5 and (!strstr($term_dom,"@")) )
				  { 
//compruebo que lo de antes del dominio sea correcto 
				           $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
				           $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
				           if ($caracter_ult != "@" && $caracter_ult != ".")
								{ 
					           $mail_correcto = 1; 
                					} 
								else
									{
									$error7=21;
									}	
             				  }
								else
									{
									$error7=22;
									}	
        			      }
								else
									{
									$error7=23;
									}	
						  
       		        } 
								else
									{
									$error7=24;
									}	

    	       }
								else
									{
									$error7=25;
									}	
			   

	if ($mail_correcto==0) 
	       {
		$error=4;
	        }


       }  // fin validacion	


// echo "<br><br>datos = ".strlen($email)." - ".substr_count($email,"@")." - ".substr($email,0,1)." - ".substr($email,strlen($email)-1,1);

// echo "<br>error = ".$error." -----> ".$error7;	   
	   
if ($error==9)
  {
//Estoy recibiendo el formulario, compongo el cuerpo 


// envia correo a Operaciones

    $cuerpo = "Formulario enviado: \n"; 
    $cuerpo .= "Nombre: ".$xnom. "\n"; 
    $cuerpo .= "email: ".$email. "\n"; 
    $cuerpo .= "Comentarios: ".$xmsg. "\n"; 
    $titulo =  "Contacto web";

    mail("contacto@misperris.cl",$titulo,$cuerpo, "From: ".$email." "); 

	$aceptar=0;
	$xnom="";
	$email="";
	$xmsg="";
	
  }


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>5inco - Centro de Innovación Colaborativa</title>
  
  
 <link rel="stylesheet" media="screen" href="css/style.css">
 <link rel="icon" type="image/png" href="images/favicon.png" />
 
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>

</head>
<body>

<header>

<nav>
<ul>
<a href="index.html"><li>Home</li></a>
<a href="#"><li>Nosotros</li>
<a href="contacto.php"><li>Contacto</li></a>
</ul>
</nav><h1>5inco - Centro de Innovación Colaborativa</h1>
</header>
<div class="iconos">
<div class="container">
<h2>Formulario de Contacto</h2>
      <p class="nospace btmspace-30">Todos los campos son obligatorios.</p>

       <?php
			echo "<form width='100%' name='form1' method='post' action=''>";
			
			echo "<center>
  <span style='color: #FFF;'>Nombre:</span><br><input type='text' name='xnom' value='$xnom' ><br><br>	
<span style='color: #FFF;'>Correo:</span></b><br>&nbsp;<input type='text' name='email' value='$email' ><br><br>
<br><span style='color: #FFF;'>Mensaje:</span><br><br>
	<textarea name='xmsg' rows='5' class='size2' value='$xmsg'></textarea><br><br>
	<center><a class='boton2' onclick='Grabar();' >Enviar</a></center></div>
<b>
				
			";
	   
	   						
			if ($error==1)
				{
					echo "<br><font color=\"#fff\" size='2'><b>Debe ingresar el Nombre";
					}
			elseif ($error==2)
				{
					echo "<br><font color=\"#fff\" size='2'><b>Debe ingresar el Correo";
					}
			elseif ($error==3)
				{
					echo "<br><font color=\"#fff\" size='2'><b>Debe ingresar el texto del Mensaje";
					}
			elseif ($error==4)
				{
					echo "<br><font color=\"#fff\" size='2'><b>Dirección de Correo incorrecto";
					}
			elseif ($error==9)
				{
					echo "<font color=\"#fff\" size='2'><b>Hemos recibido correctamente su mensaje. Gracias por contactarnos.";
					}

?>
</div>
<!-- particles.js container -->
<div id="particles-js"></div>

<footer> © 2016 by 5inco. - Centro de Innovación ColaBorativa</footer>

<!-- scripts -->
<script src="js/particles.js"></script>
<script src="js/app.js"></script>


<script language="JavaScript">
function Grabar()
     {
	form1.action = "http://www.5inco.cl/contacto.php?aceptar=1#footer";
	form1.submit();
    }
</script>


<script type="text/javascript" src="script.js"></script>

</body>
</html>