<ul class="nav nav-pills nav-stacked">
    <?php if (is_array($steps)): ?>
        <?php foreach ($steps as $step): ?>

            <?php
                $action = Yii::app()->controller->action->id;
                $class = ($action == $step->code) ? "active" : (($step->status != MigrateSteps::STATUS_DONE) ? "disabled" : "");
                $title = $step->sorder." - ".$step->title;
                if ($step->status == MigrateSteps::STATUS_DONE){
                    $title = '<span class="glyphicon glyphicon-ok-sign text-success"></span> '.$title;
                }
            ?>

            <li class="<?=$class?>">
                <?php echo CHtml::link($title, array("migrate/{$step->code}")); ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
<div id="btn-reset">
    <?php
        if(MigrateSteps::model()->count("status =".MigrateSteps::STATUS_DONE) > 0){
            $class = "btn btn-danger";
        }else{
            $class = "btn btn-danger disabled";
        }
    ?>
    <a href="<?php echo Yii::app()->createUrl("migrate/resetAll"); ?>" title="<?php echo Yii::t('frontend', 'Click to reset all steps.'); ?>" class="<?php echo $class; ?>"><?php echo Yii::t('frontend', 'Reset All'); ?></a>
</div>