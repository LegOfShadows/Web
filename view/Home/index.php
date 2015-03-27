<?php foreach ($posts as $post) {?>
<article>
    <h3><?php echo $post['title']?></h3>
    <p><?php echo $post['text']?></p>
    <p><?php echo Html::CreateLink('Read More','/forum/thread/'.$post['thread'],array('class'=>'ctrlItemButton'))?></p>
    <div>
        <address><?php echo $post['username']?></address>
        <time><?php echo $post['created']?></time>
    </div>
</article>
<?php }?>