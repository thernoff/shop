<li class="dropdown menu-item">
<a href="<?= \yii\helpers\Url::to(['genre/view', 'id'=>$genre['id']]) ?>"><?= $genre['name'] ?></a>

<?php if (isset($genre['childs'])):?>
    <ul class="dropdown-menu mega-menu">
        <?= $this->getMenuHtml($genre['childs']); ?>
    </ul>
<?php endif; ?>
</li>