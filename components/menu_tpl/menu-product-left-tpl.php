<div class="side-menu animate-dropdown outer-bottom-xs">
            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Категории</div>        
            <nav class="yamm megamenu-horizontal" role="navigation">
            <ul class="nav">
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-gamepad fa-fw"></i><?= $category['name'];?></a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <ul class="links list-unstyled">  
                                    <li><a href="category.html"><?= $category['name'];?></a></li>
                                    <?php if (isset($category['childs'])):?>
                                        <?php foreach ($category['childs'] as $child): ?>
                                            <li><a href="category.html"><?= '-' . $child['name']; ?></a></li>
                                        <?php endforeach;?>
                                    <?php endif; ?>    
                                </ul>
                            </div><!-- /.col -->
                           
                        </div><!-- /.row -->
                    </li><!-- /.yamm-content -->                    
                </ul><!-- /.dropdown-menu -->            
            </li><!-- /.menu-item -->
            </ul><!-- /.nav -->
            </nav><!-- /.megamenu-horizontal -->
            </div><!-- /.side-menu -->