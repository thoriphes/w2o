<h1>This is the articssles part!!!</h1>

<table>
	<tr>
		<th>Title</th>
		<th>Content</th>
		<th>Creation</th>
	</tr>
	<?php foreach($articles['data'] as $article): ?>
	<tr>
		<td><?=$article['title'] ?></td>
		<td><?=$article['content'] ?></td>
		<td><?=$article['creation'] ?></td>
	</tr>
	<?php endforeach ?>
</table>

<div>Showing a total of <?=$articles['num_rows']?> articles</div>