<?php
  include('cabecera.php');
  //if(isset($_SESSION['USER'])==''){

  //}else{
  //  header('Location: /PROYECTO_FUTBOL/login.php');      
  //}
  
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
 $(document).on("ready", function(){                       
      $("#area_tabla table tr td").click(function() {        
        var celda = $(this);
        $(this).css("background-color", "#ddd");        
        var array=Array(150);                        
        array.push(celda.html());   
        
        var cont='';
        for (i in array){
			cont = cont + array[i] + ',';	
        }
        console.log(cont);

      });
  });

	</script>
 

<div id="contenedor" class="content-wrapper">
	<section class="content-header">
		<div align="center">
			<img align="center" src="img/sisfutweb.png" width="340" height="150">
		</div>
	</section>
	<div class="starter-template">
        <div align="center">
        	<h1>ASIENTOS</h1>
        </div>
    </div>
	
	<div class="panel panel-success">
        <div class="panel-heading" align="center">NUMERO DE ASIENTOS</div>
        <div class="panel-body">
        <div id="area_tabla">
        <table border="3" class="table">   
        <tbody>
    <?php
    	require("Conexion.php");
        $con = Conectar(); 
    	
        $sql= 'SELECT partido.equipolocal, partido.equipovisita, estadio.capacidad ,
        	reserva.asiento_selec from partido
			inner join reserva on reserva.idpartido=partido.idpartido 
			inner join estadio on partido.idestadio=estadio.idestadio
			where reserva.idpersona='.$_SESSION['IDPERSONA'].'';
    	$stmt = $con->prepare($sql);
        $result = $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $capa='';
        foreach($rows as $row){
        	$capa=$row->capacidad;
        }                       

        	
			$n=1;
			$fila='';
			$col='';
			$resultado=$capa/4;			
			for ($n1=1; $n1<=4; $n1++)
			{
	?>
			<tr>
	<?php
			for ($n2=1; $n2<=$resultado; $n2++)
			{
			//",$n,"

				echo "<td align='center'>",$n,"</td>";
			?>
			<?php
				$n=$n+1;
			}
		
			?>			
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




<?php
  include('pie.php');
?>