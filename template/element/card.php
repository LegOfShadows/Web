<div class="card">
    <img style="width:180px;height: 240px;float:left;" src="<?php echo 'http://mtgimage.com/card/'.$data['image'].'.jpg';?>">
    <h4><?php echo $data['name'] ?></h4>
    <p><?php echo $data['cost'] ?><p>
    <p><?php echo $data['text'] ?></p>
    <p><?php echo $data['power'] . '/' . $data['toughness'];?></p>
</div>
<div class="clear"></div>