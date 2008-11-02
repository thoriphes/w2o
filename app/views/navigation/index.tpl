Navigation:
<ul>
<?foreach($links['data'] as $link): ?>
	<li><a href="<?=Support::createLinkURL(strtolower($link['title'])) ?>" title="<?=$link['title']?>"><?=$link['title']?></a></li>
<?endforeach; ?>
</ul>