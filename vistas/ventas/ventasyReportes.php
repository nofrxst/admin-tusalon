<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql="SELECT id_venta,
				fechaCompra,
				id_cliente,
				art.nombre
			from ventas  inner join articulos as art  group by id_venta";
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<div class="artibg2">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Ventas</label></caption>
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td> Productos</td>
					<td>Total de compra</td>
					
					
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					<td>
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							}
						 ?>
					</td>
					
					<td>
						<?php echo .$obj->obtenDatosArticulo($ver[3]) ?>
					</td>
					<td>
						<?php 
							echo "S/.".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					
				</tr>
		<?php endwhile; ?>
			</table>
			</div>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>