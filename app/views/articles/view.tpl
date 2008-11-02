
	<h1><?=$article['data'][0]['title']?></h1>
	<span><?=$article['data'][0]['creation']?></span>
	<p><?=nl2br($article['data'][0]['content'])?></p>
	
	<a href="<?=Support::createLinkURL("articles") ?>" title="Articles" >Back</a>