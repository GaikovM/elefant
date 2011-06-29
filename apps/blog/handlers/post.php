<?php

$page->layout = $appconf['Blog']['post_layout'];

require_once ('apps/blog/lib/Filters.php');

$p = new blog\Post ($this->params[0]);

$page->title = $appconf['Blog']['title'];

$post = $p->orig ();
$post->full = true;
$post->url = '/blog/post/' . $post->id . '/' . blog_filter_title ($post->title);
$post->tag_list = explode (',', $post->tags);

echo $tpl->render ('blog/post', $post);

switch ($appconf['Blog']['comments']) {
	case 'facebook':
		echo $this->run ('social/facebook/comments', $post);
		break;
}

$page->add_script (sprintf (
	'<link rel="alternate" type="application/rss+xml" href="http://%s/blog/rss" />',
	$_SERVER['HTTP_HOST']
));

?>