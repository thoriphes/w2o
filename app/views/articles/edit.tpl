<h1>Edit Article</h1>

<form method="post">

	<fieldset>
	
		<label for='articles_title'><span class='fieldName'>Name:</span> <input type='text' id='articles_title' name='title' value='<?=str_replace("'", "&apos;", $article['data'][0]['title'])?>'/></label>
		<label for='articles_content'><span class='fieldName'>Content:</span> <textarea id='articles_content' name='content'><?=$article['data'][0]['content']?></textarea></label>
		<input type="submit" value="Edit" />
	
	</fieldset>

</form>