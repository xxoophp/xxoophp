<?php foreach( $article_list as $article ) { ?>
<div class="article-list-item">
	<a class="title" href="<?php echo site_url( 'article/' . $article['id'] ); ?>">
		<?php echo $article['title'] ?>
	</a>
	<p class="summary"><?php echo $article['summary'] ?></p>
</div>
<?php } ?>

<div class="pagation">
	<?php echo $pagination ?>
</div>