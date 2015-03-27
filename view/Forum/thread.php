<?php foreach ($posts as $post) { ?>
    <article>
        <p><?php echo $post['text']?></p>
        <p>
            <address><?php echo $post['username']?><br><?php echo Auth::AccessLevel($post['accesslevel']); ?></address>
            <time><?php echo $post['created']?></time>
        </p>
    </article>
<?php }?>
<div class="ctrlForumReply">
    <a href="/forum/post/<?php echo $thread->id?>" class="ctrlItemButton">Reply</a>
</div>