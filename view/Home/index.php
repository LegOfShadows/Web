<?php foreach ($posts as $post) {?>
<div class="wrpItem">
	<h3><?php echo $post['title']?></h3>
	<div class="wrpItemBody">
		<p class="ctrlItemText"><?php echo $post['text']?></p>
		<p class="ctrlItemLink"><?php echo Html::CreateLink('Read More','/forum/thread/'.$post['thread'],array('class'=>'ctrlItemButton'))?></p>
		<div class="ctrlItemSignature">
			<span class="ctrlItemSignatureName"><?php echo $post['username']?></span>
			<span class="ctrlItemSignatureDate"><?php echo $post['created']?></span>
		</div>
	</div>
</div>
<?php }?>