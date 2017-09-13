<ul class="sidebar-menu">
    <li class="header">Меню</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="<?= \yii\helpers\Url::to(['/admin']); ?>"><i class="fa fa-link"></i> <span>Главная</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['order/index']); ?>"><i class="fa fa-link"></i> <span>Список заказов</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['catalog/index']); ?>">Справочники</a></li>
    <li><a href="<?= \yii\helpers\Url::to(['product/index']); ?>">Товары</a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Справочники</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?= \yii\helpers\Url::to(['catalog/index']); ?>">Список справочников</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['catalog/create']); ?>">Добавить справочник</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Товары</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?= \yii\helpers\Url::to(['product/index']); ?>">Список товаров</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['product/create']); ?>">Добавить товар</a></li>
      </ul>
    </li>
    <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
    <!--<li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#">Link in level 2</a></li>
        <li><a href="#">Link in level 2</a></li>
      </ul>
    </li>-->
</ul>