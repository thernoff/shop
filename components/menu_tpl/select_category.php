<option 
    value="<?= $item['id']?>" 
    <?php if ($item['id']==$this->model->parent_id) echo "selected"?> 
    <?php if ($item['id']==$this->model->id) echo "disabled"?>
    <?php if ($this->model->isParent($item['id'])) echo "disabled"?>
>
    <?= $tab.$item['name'] ?>
</option>
<?php if (isset($item['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($item['childs'], $tab.'-')?>
    </ul>      
<?php endif; ?>