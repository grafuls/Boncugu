<div id="main" class="clearfix" role="main">
<h2>Most popular <?php echo $brand .' '; ?>models</h2>
<div class="container">
    <div class="popular-brand-cameras">
        <ul class="model-strip brands">
        <?php 
        $index = 1;
        foreach ($models as $model) { 
            if ($index < 6) {?>
            <li class="model-image">
                <a href="<?php echo URL; ?>model/index/<?php echo $model->brand; ?>/<?php echo $model->raw_model; ?>" class="model-link">
                    <?php 
                    if ($model->large_image_url!='') { 
                        echo '<img src="' .$model->large_image_url .'">';
                    }
                    else {
                        echo '<img src="' .URL .'public/img/camera_icon.png">';
                    }
                    ?>
                </a><br>
                <a href="<?php echo URL; ?>model/index/<?php echo $model->brand; ?>/<?php echo $model->raw_model; ?>"><?php echo $model->name; ?></a>
            </li>
            <?php $index=$index + 1;
            }
            else {
                break;
            }
        } 
        ?>
        </ul>
    </div>
</div>

<h2>All <?php echo $brand .' '; ?>models</h2>
<div class="container">
<?php
    echo '<table id="brands" class="display">
            <thead>
            <tr>
                <th>Rank</th>
                <th>Model</th>
                <th>Megapixels</th>
                <th>LCD Screen Size</th>
                <th>Memory Type</th>
            </tr>
            </thead>';
      echo '<tbody>';

    $rank = 1;
    foreach($models as $model) {
      echo '<tr>';
      echo '<td>' . $rank . '</td>';
      echo '<td><a href="' .URL .'model/index/' .$model->brand .'/' .$model->raw_model .'">';
      echo str_replace($model->brand .' ','',$model->name);
      echo '</a></td>';
      echo '<td>' . $model->megapixels . '</td>';
      echo '<td>' . $model->lcd_screen_size . '</td>';
      echo '<td>' . $model->memory_type . '</td>';
      echo '</tr>';
      $rank = $rank + 1;
    }

    echo '</tbody>';
    echo '</table>';
?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#brands').dataTable();
    });
</script>
