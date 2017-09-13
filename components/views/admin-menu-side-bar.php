<ul class="sidebar-menu">
    <li class="header">Меню</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="<?= \yii\helpers\Url::to(['/admin']); ?>"><i class="fa fa-link"></i> <span>Главная</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['order/index']); ?>"><i class="fa fa-list"></i><span>Список заказов</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['product/index']); ?>"><i class="fa fa-shopping-bag"></i><span>Товары</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['catalog/index']); ?>"><i class="fa fa-book"></i><span>Справочники</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['discount/index']); ?>"><i class="fa fa-thumbs-o-up"></i><span>Скидки</span></a></li>
    <li><a href="<?= \yii\helpers\Url::to(['user-record/index']); ?>"><i class="fa fa-user"></i><span>Пользователи</span></a></li>
    
    <li class="treeview">
      <a href="#"><i class="fa fa-file"></i><span>Статические страницы</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?= \yii\helpers\Url::to(['page/index']); ?>"><span>Страницы</span></a></li>
        <li><a href="<?= \yii\helpers\Url::to(['page-category/index']); ?>">Категории</a></li>
      </ul>
    </li>
</ul>