<?php 
/*
	Projet réalisé par Damien Cornette
*/

// Variable définissant les charnières
$tncc = array(
	'0'		=> '',
	'1'		=> '',
	'2'		=> 'Le',
	'3' 	=> 'La',
	'4' 	=> 'Les',
	'5' 	=> 'L\'',
	'6' 	=> 'Aux',
	'7' 	=> 'Las',
	'8' 	=> 'Los');
 ?>

<div class="white-panel">
	<div class="padding-large">
		<div class="page-header">
			<h2>Commune de <?php echo $tncc[$detail->tncc].' '.$detail->nom_com; ?> 
				<small><a href= <?php echo BASE_URL."/communes/detail/".$detail->nom_com."/add"; ?>  >
				 Ajouter aux favoris !</a></small>
			</h2>	
		</div>

		<?php echo $this->session->flash(); ?>

		<div class="row">
			<div class="span4">
				<dl class="dl-horizontal">
  					<dt>Région : </dt>
  					<dd><?php echo $detail->nom_reg; ?></dd>
  					<dt>Département : </dt>
  					<dd><?php echo $detail->nom_dept.' ('.$detail->dept.')'; ?></dd>
  					<dt>Commune : </dt>
  					<dd><?php echo $detail->dept.$detail->comm; ?></dd>
  					<dt>Population : </dt>
  					<dd><?php echo $detail->population; ?> habitants</dd>
  					<dt>Latitude : </dt>
  					<dd><?php echo $detail->latitude; ?></dd>
  					<dt>Longitude : </dt>
  					<dd><?php echo $detail->longitude; ?></dd>
				</dl>
			</div>
			<div class="span5">
				<div id="map_detail"></div>
			</div>
		</div>
	</div>
</div>