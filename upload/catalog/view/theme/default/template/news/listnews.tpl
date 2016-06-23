<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php 
        foreach ($news as $n) {
          echo "
            <div class='row'>
              <div class='col-sm-4'>
                <img src='image/{$n['image']}' alt='{$n['title']}' class='img-thumbnail img-responsive' />
              </div>
              <div class='col-sm-8'>
                <p><a href='{$n['href']}'><strong>{$n['title']}</strong></a></p>
                <p><i class='fa fa-calendar'></i> $text_published_at ". date('H:i', strtotime($n['posted_date'])) ."  $text_on 
                " . date('d/m/Y', strtotime($n['posted_date'])) . "
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-eye'></i>  $text_views   {$n['hits']}
                </p>
                ".strip_tags(html_entity_decode( $n['brief']))."
              </div>
            </div>
            <br/>
          ";
        }
      ?>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"></div>
      </div>
    
      <?php echo $content_bottom; ?>
      </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>