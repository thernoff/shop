<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Категории</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
        <?php foreach ($categories as $category): ?>
            <?php if (isset($category['childs'])):?>
                <li class="dropdown menu-item">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-gamepad fa-fw"></i><?= $category['name'];?></a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <ul class="links list-unstyled">  
                                        <li>
                                            <a href="<?= Url::to(['main/category', 'productId' => $productId, 'categoryId' => $category['id']] ); ?>">
                                                <?= $category['name']; ?>
                                            </a>
                                        </li>

                                        <?php foreach ($category['childs'] as $child): ?>
                                            <li><a href="<?= Url::to(['main/category', 'productId' => $productId, 'categoryId' => $child['id']] ); ?>"><?= '-' . $child['name']; ?></a></li>
                                        <?php endforeach;?>

                                    </ul>
                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </li><!-- /.yamm-content -->                    
                    </ul><!-- /.dropdown-menu -->            
                </li><!-- /.menu-item -->
            <?php else: ?>
                <li class="dropdown menu-item">
                    <a href="<?= Url::to(['main/category', 'productId' => $productId, 'categoryId' => $category['id']] ); ?>" >
                        <i class="icon fa fa-gamepad fa-fw"></i>
                        <?= $category['name'];?>
                    </a>      
                </li><!-- /.menu-item -->
            <?php endif;?>
        <?php endforeach; ?>
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->