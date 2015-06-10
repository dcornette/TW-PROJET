<?php 
/*
	Projet réalisé par Damien Cornette
*/
 ?>

<div class="white-panel">
	<div class="padding-large">
<form class="form-horizontal" method="post" action=<?php echo BASE_URL.DS."communes/detail"; ?>>
	<fieldset>  
	<legend>Faites votre recherche</legend> 

	<!-- ######################### Bouton Radio #######################################-->
	<div class="control-group">
		<div class="controls">  
			<label class="radio">
			  <input type="radio" name="choix" value="1" checked onclick="$('#choix1').slideToggle(); 
			  $('#choix2').css('display','none');">
			  Choix par nom de commune exacte
			</label>
			<label class="radio">
			  <input type="radio" name="choix" value="2" onclick="$('#choix2').slideToggle();
			  $('#choix1').css('display','none');">
			  Autre choix
			</label>
		</div>  
	</div> 
	
	<!-- ###################### 1ère partie du formulaire #############################-->
	<div class="control-group" id="choix1">  
		<label class="control-label" for="nom">Nom</label>  
		<div class="controls">  
			<input type="text" class="input-xlarge" id="nom" name="nom" placeholder="Nom de la commune"> 
		</div>
		<div class="form-actions">  
        	<button type="submit" class="btn btn-primary">Rechercher
        		<i class="icon-search icon-white"></i></button>
    	</div> 
	</div>  

	<!-- ####################### 2ème partie du formulaire ############################-->
	<div class="control-group" id="choix2" style="display:none;">  

		<!-- ####################### Population ############################-->
		<label class="control-label" for="population">Population</label>
		<div class="controls">  
			<input type="text" class="input-small" placeholder="Min" name="min" id="population" pattern="[0-9]*">
  			<input type="text" class="input-small" placeholder="Max" name="max" pattern="[0-9]*">
		</div> 

		<br />
		<!-- ####################### Département ############################-->
		<label class="control-label" for="dept">Département</label>  
		<div class="controls">  
			<select id="dept" name="dept">
				<option value=""> Choisir un département </option>
				<?php for ($i=0; $i < count($departements); $i++): ?> 
					<option value= <?php echo $departements[$i]->code ?> > 
						<?php echo $departements[$i]->code.' '.$departements[$i]->nom ?> 
					</option>		
				<?php endfor; ?>
			</select>
		</div> 

		<br />
		<!-- ####################### Région ############################-->
		<label class="control-label" for="region">Région</label>
		<div class="controls">  
			<select id="region" name="region">
				<option value=""> Choisir une région </option>
				<?php for ($i=0; $i < count($regions); $i++): ?> 
					<option value= <?php echo $regions[$i]->code ?> > 
						<?php echo $regions[$i]->code.' '.$regions[$i]->nom ?> 
					</option>		
				<?php endfor; ?>
			</select>
		</div> 

		<div class="form-actions">  
        	<button type="submit" class="btn btn-primary" formaction=
        		<?php echo BASE_URL.DS."communes/liste"; ?>>Rechercher
        	 <i class="icon-search icon-white"></i></button>
    	</div> 
	</div>  

    </fieldset>  
</form>
</div>
</div>