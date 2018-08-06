<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

/* @var $item \common\modules\testimonials\widgets\CommentView */
?>

<div class="comment-item" data-id="<?= $item->comment->id ?>">
    <div class="panel panel-default">
        <div class="panel-body">
            <p class="comment-content">
                <?php if ($item->comment->isActive()): ?>
                    <?= Yii::$app->formatter->asNtext($item->comment->text) ?>
                <?php else: ?>
                    <i>Comment is deleted.</i>
                <?php endif; ?>
            </p>
            <div>
                <div class="pull-left">
                    <?= Yii::$app->formatter->asDatetime($item->comment->created_at) ?>
                </div>
                <div class="pull-right">3
                    <span class="comment-reply">Reply</span>
                </div>
            </div>
        </div>
    </div>
    <div class="margin">
        <div class="reply-block"></div>
        <div class="comments">
            <?php $i=1; ?>
            <?php foreach ($item->children as $children): ?>
                <?php echo '--'; ?><?= $this->render('_comment', ['item' => $children]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
