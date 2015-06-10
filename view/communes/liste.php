<?php 
/*
	Projet réalisé par Damien Cornette
*/
 ?>

<div class="white-panel">
	<div class="padding-large">

<div class="page-header">
		<h2>Nous avons trouvé <?php echo $nbCommunes; ?> communes !</h2>
</div>

<?php $title_for_layout = "Résultat de votre recherche"; ?>

<table class="table table-striped">
	<caption> Communes correspondant à votre recherche </caption>
	<thead>
		<tr>
			<th> Nom </th>
			<th> Population </th>
			<th> Code Insee </th>
			<th> Département </th>
			<th> Région </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($communes as $k => $v): ?>
			<?php $name_for_link = str_replace(' ', '%20', $v->nom_com) ?>
			<tr>
				<td><a href= <?php echo BASE_URL.DS."communes/detail/".$name_for_link ?> >
					<?php echo $v->nom_com ?></a></td>
				<td><?php echo $v->population ?></td>
				<td><?php echo $v->dept.$v->comm ?></td>
				<td><?php echo $v->nom_dept ?></td>
				<td><?php echo $v->nom_reg ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="pagination">
	<ul>
		<li><a href=<?php if($this->request->cPage > 1) {
				echo BASE_URL.DS."communes/liste?p=".($this->request->cPage-1);
			}
			else {
				echo BASE_URL.DS."communes/liste?p=".$this->request->cPage;
			} ?>>&larr;</a></li>
		<?php for($i=1; $i<=$nbPages; $i++): ?>
			<li <?php if($this->request->cPage == $i) echo 'class="active"'; ?> >
				<a href= <?php echo BASE_URL.DS."communes/liste?p=$i"; ?> > <?php echo $i; ?> </a></li>
		<?php endfor; ?>
		<li><a href=<?php if($this->request->cPage < $nbPages) {
				echo BASE_URL.DS."communes/liste?p=".($this->request->cPage+1);
			}
			else {
				echo BASE_URL.DS."communes/liste?p=".$this->request->cPage;
			} ?>>&rarr;</a></li>
	</ul>
</div></div></div>