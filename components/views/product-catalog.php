<?php
use yii\helpers\Url;
?>
<div class="sidebar-widget product-tag wow fadeInUp">
                <h3 class="section-title"><?= $catalog->name; ?></h3>
                <div class="sidebar-widget-body outer-top-xs">
                        <div class="tag-list">
                            <?php foreach ($catalogElements as $catalogElement):?>
                            <a class="item" title="Phone" href="<?= Url::to(['/main/tag', 'productId' => $productId, 'catalogId' => $catalog->id, 'catalogElementId' => $catalogElement->id]) ;?>">
                                <?= $catalogElement->title; ?>
                            </a>
                            <?php endforeach; ?>
                        </div><!-- /.tag-list -->
                </div><!-- /.sidebar-widget-body -->
        </div><!-- /.sidebar-widget -->