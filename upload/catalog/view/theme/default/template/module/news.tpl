<div class="list-group">
  <h4 href="javascript:;" class="list-group-item active">
    <?=$module_title?>
  </h4>
  <?php foreach ($news as $n) { ?>
    <?php if ($n['news_id'] == $news_id) { ?>
      <a href="<?php echo $n['href']; ?>" class="list-group-item active">
      <img src="<?php echo $n['thumb']; ?>" width="80px" height="60px" alt="<?php echo $n['name']; ?>" style="float:left; margin-right:20px;" /> <?php echo $n['name']; ?>
      <br style="clear:both" /></a>
    <?php } else { ?>
      <a href="<?php echo $n['href']; ?>" class="list-group-item">
      <img src="<?php echo $n['thumb']; ?>" width="80px" height="60px" alt="<?php echo $n['name']; ?>"  style="float:left; margin-right:20px;" /> <?php echo $n['name']; ?>
      <br style="clear:both" /></a>
    <?php } ?>
  <?php } ?>
</div>
