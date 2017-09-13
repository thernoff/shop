<option 
    value="<?= $genre['id']?>" 
    <?php if ($genre['id']==$this->model->parent_id) echo "selected"?> 
    <?php if ($genre['id']==$this->model->id) echo "disabled"?>
    <?php if ($this->model->isParent($genre['id'])) echo "disabled"?>
>
    <?= $tab.$genre['name'] ?>
</option>
<?php if (isset($genre['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($genre['childs'], $tab.'-')?>
    </ul>      
<?php endif; ?>