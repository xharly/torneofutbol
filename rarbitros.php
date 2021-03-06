<?php
	session_start();
	if((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) OR ($_SESSION["privilegio"] == 2) ){		
		header("Location: sesion.php");
	}
	include_once('conn.php');	
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/main.css">
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				if(opcion==1)
				{
					window.location= "muestra_arbitro.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_arbitro.php?id="+val;
				}
				else if (opcion==3)
				{
					window.location= "d_edita_permisos.php?id="+val;
				}
				else if (opcion==4)
				{
					window.location= "edita_fotos_arbitro.php?id="+val;
				}
				//window.location= "d_productos.php?b="+document.getElementById(val).value;		
			}
		</script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php include_once("menu.php") ?>

		<!-- Lista de Arbitros -->
		<div id="page">
			<div id="content-other">
				<div class="text-right">
					<a href="form_arbitros.php" class="btn btn-primary">Agregar Arbitro</a>
				</div>				
				<?php
					if (isset($_SESSION["alerta"])) { ?>
						<label class="alerta"><?php echo $_SESSION["alerta"];?></label>
					<?php unset($_SESSION["alerta"]);
					}
				?>
				<div class="datagrid">
					<table class="table">
		                <thead>
		                    <tr class="headings">                        
		                        <th class="column-title">Foto </th>
		                        <th class="column-title">Nombre </th>
		                        <th class="column-title">rol </th>                        
		                        <th class="column-title no-link last"><span class="nobr">Acciones</span></th>                        
							</tr>
						</thead>
                        <tbody>
							<?php
								$productosq=mysql_query("select * from arbitros");								
							
								if(mysql_num_rows($productosq)>0)
									while($productosf=mysql_fetch_assoc($productosq)) { ?>
                            			<tr>                                    
                                			<td class=" ">									
												<?php 
													if (file_exists("arbitrosimagenes/".$productosf['fotoArbitro'])==1) { ?>
		                                            	<img width="120px" height="100px" src="<?php echo "arbitrosimagenes/".$productosf['fotoArbitro']?>">
													<?php }
													else { ?>
		                                            	<img class="img-responsive" src="images/0.jpg">
													<?php }
											   	?>
											</td>
                                			<td class=" "><?php echo $productosf['nombreArbitro'];?> <?php echo $productosf['ap_arbitro'];?> <?php echo $productosf['am_arbitro'];?></td>
                                			<td><?php echo $productosf['rol'];?></td>
                                			<td class=" last">
                                				<select class="form-control" onchange="opciones(<?php echo $productosf['idArbitro'];?>)" id="opciones<?php echo $productosf['idArbitro'];?>">
													<option value="">Selecciona...</option>
													<option value="1">Ver</option>
													<option value="2">Modificar</option>
													<option value="4">Edita foto</option>
												</select>
											</td>
										</tr>									
									<?php }
								else { ?>
	                                <tr>
										<td colspan="4" class="text-center">No hay arbitros agregados.</td>
									</tr>	
								<?php } 
							?>          
                        </tbody>
					</table>
                </div>
			</div>
        </div>

      	<!--Pie de pagina-->
      	<div id="footer">
		  <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
