<?php 
/*
	Projet réalisé par Damien Cornette
*/
 ?>

<div class="white-panel">
	<div class="padding-large">

<div class="page-header">
		<h2>Vous avez <?php echo $nbFavoris; ?> favoris !</h2>
</div>

<?php $title_for_layout = "Liste de vos favoris"; ?>

<?php echo $this->session->flash(); ?>

<table class="table table-striped">
	<caption> Vos favoris </caption>
	<thead>
		<tr>
			<th> Nom </th>
			<th> Population </th>
			<th> Code Insee </th>
			<th> Département </th>
			<th> Région </th>
			<th> Actions </th>
		</tr>
	</thead>
	<tbody>
		<?php for($i=$debut; $i<$fin; $i++): ?>
			<?php $name_for_link = str_replace(' ', '%20', $favoris[$i]->nom_com); ?>
			<tr>
				<td><a href= <?php echo BASE_URL.DS."communes/detail/".$name_for_link; ?> >
					<?php echo $favoris[$i]->nom_com; ?></a></td>
				<td><?php echo $favoris[$i]->population; ?></td>
				<td><?php echo $favoris[$i]->dept.$favoris[$i]->comm; ?></td>
				<td><?php echo $favoris[$i]->nom_dept; ?></td>
				<td><?php echo $favoris[$i]->nom_reg; ?></td>
				<td><a onclick="return confirm('Voulez vous vraiment supprimer cette commune de vos favoris ?');" 
					href= <?php echo BASE_URL."/communes/favoris/delete/".$i; ?> > 
					Supprimer </a>
				</td>	
			</tr>
		<?php endfor; ?>
	</tbody>
</table>

<div class="pagination">
	<ul>
		<li><a href=<?php if($this->request->cPage > 1) {
				echo BASE_URL.DS."communes/favoris?p=".($this->request->cPage-1);
			}
			else {
				echo BASE_URL.DS."communes/favoris?p=".$this->request->cPage;
			} ?>>&larr;</a></li>
		<?php for($i=1; $i<=$nbPages; $i++): ?>
			<li <?php if($this->request->cPage == $i) echo 'class="active"'; ?> >
				<a href= <?php echo BASE_URL.DS."communes/favoris?p=$i"; ?> > <?php echo $i; ?> </a></li>
		<?php endfor; ?>
		<li><a href=<?php if($this->request->cPage < $nbPages) {
				echo BASE_URL.DS."communes/favoris?p=".($this->request->cPage+1);
			}
			else {
				echo BASE_URL.DS."communes/favoris?p=".$this->request->cPage;
			} ?>>&rarr;</a></li>
	</ul>
</div></div></div>