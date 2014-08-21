<div id="main" class="clearfix" role="main">
<h2>Most popular brands</h2>
<div class="container">
    <div class="popular-brand-cameras">
        <ul class="model-strip brands">
        <?php 
        $index = 1;
        foreach ($top_models as $model) { 
            if ($model->id==$index) {?>
            <li class="model-image">
                <a href="<?php echo URL; ?>brand/index/<?php echo $model->brand; ?>" class="model-link">
                    <img src="<?php echo $model->large_image_url; ?>">
                </a><br>
                <a href="<?php echo URL; ?>brand/index/<?php echo $model->brand; ?>"><?php echo $model->brand; ?></a>
            </li>
            <?php $index=$index + 1;
            }
        } 
        ?>
        </ul>
        <ul class="model-strip brands" style="margin-top:4px">
        <?php 
        $brandIndex = 1;
        $modelIndex = 1;
        foreach ($top_models as $model) { 
            if ($model->id==$brandIndex) {
                $brandIndex=$brandIndex + 1;?>
            <li class="model-image">
            <?php 
            }
            if ($modelIndex < 3) {?>
                <span>
                    <a href="<?php echo URL; ?>model/index/<?php echo $model->brand; ?>/<?php echo $model->raw_model; ?>"><?php echo str_replace($model->brand .' ','',$model->name); ?></a>
                    ,
                </span>
            <?php 
            $modelIndex=$modelIndex + 1;
            }
            else {
                $modelIndex = 1;?>
                <span>
                    <a href="<?php echo URL; ?>model/index/<?php echo $model->brand; ?>/<?php echo $model->raw_model; ?>"><?php echo str_replace($model->brand .' ','',$model->name); ?></a>
                    ,
                </span>
                <a href="<?php echo URL; ?>brand/index/<?php echo $model->brand; ?>">more...</a>
            </li>
            <?php
            }    
        }
        ?>
        </ul>
	</div>
</div>

<h2>All camera brands</h2>
<div class="container">
<?php
    echo '<table id="brands" class="display">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Brand</th>
                    <th>Models count</th>
                </tr>
            </thead>';
      echo '<tbody>';

    foreach($brands as $brand) {
      echo '<tr>';
      echo '<td>' . $brand->rank . '</td>';
      echo '<td><a href="' .URL .'brand/index/' .$brand->brand .'">' .$brand->brand . '</a></td>';
      echo '<td>' . $brand->models_count . '</td>';
      echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
?>
</div>

<h2>Most used lenses</h2>
<div class="container">
<?php
    echo '<table id="lenses" class="display">
            <thead>
                <tr>
                    <th>Lense</th>
                    <th>Pictures count</th>
                </tr>
            </thead>';
      echo '<tbody>';

    foreach($lenses as $lense) {
      echo '<tr>';
      echo '<td><a href="' .URL .'lense/index/' .preg_replace("/[^a-zA-Z0-9]+/", "", $lense->name)  .'">' .$lense->name . '</a></td>';
      //echo '<td>' . $lense->name . '</td>';
      echo '<td>' . $lense->count . '</td>';
      echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
?>
</div>
