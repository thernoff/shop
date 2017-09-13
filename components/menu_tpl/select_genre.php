<option 
    value="<?= $genre['id']?>" 
    <?php if ($genre['id'] == $this->model->genre_id) echo "selected"?> 
>
    <?= $tab.$genre['name'] ?>
</option>
<?php if (isset($genre['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($genre['childs'], $tab.'-')?>
    </ul>      
<?php endif; ?>