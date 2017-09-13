<option 
    value="<?= $item['id']?>" 
    <?php if ($item['id']==$this->model->parent_id) echo "selected"?> 
>
    <?= $tab.$item['name'] ?>
</option>
<?php if (isset($item['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($item['childs'], $tab.'-')?>
    </ul>      
<?php endif; ?>