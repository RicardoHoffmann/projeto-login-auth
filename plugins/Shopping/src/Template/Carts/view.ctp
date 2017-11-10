<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
?>

<style>
    .button.warning {
        float: left;
        margin-right: 10px;
    }

    div.cart-empty {
        margin-left: 25%;
    }
    small {
        text-align: center;
        font-size: 20px;
        margin-left: 25%;
        color: #DCDDDE;
    }
</style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('shopping', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('shopping', 'Purchase'), ['plugin' => 'Shopping', 'controller' => 'Products', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <?php echo $this->Form->create('Cart', ['url' => ['action' => 'update']]);?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($products) && !empty($products)) { ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th><?= __d('shopping', 'Product Name') ?></th>
                        <th><?= __d('shopping', 'Price') ?></th>
                        <th><?= __d('shopping', 'Quantity') ?></th>
                        <th><?= __d('shopping', 'Total') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0;?>
                    <?php foreach ($products as $product):?>
                        <tr>
                            <td><?= $product->name ?></td>
                            <td><?= __('R$ ' . number_format($product->price, 2, ',', '.')) ?>
                            </td>
                            <td><div class="col-xs-3">
                                    <?php echo $this->Form->control('count.', ['type' => 'number', 'label' => false, 'class'=>'form-control input-sm', 'value' => $product->count]);?>
                                    <?php echo $this->Form->hidden('product_id', ['label' => false, 'class'=>'form-control input-sm', 'value' => $product->id]);?>
                                </div></td>
                            <td><?= __('R$ '. number_format($product->count * $product->price, 2, ',', '.')) ?>
                            </td>
                        </tr>
                        <?php $total = $total + ($product->count * $product->price) ?>
                    <?php endforeach;?>

                    <?php if ($total != 0) { ?>
                        <tr class="success">
                            <td colspan=3></td>
                            <td><?= __('R$ ' . number_format($total, 2, ',', '.')) ?>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
                <p class="text-right">
                    <?= $this->Form->submit('Update', [
                        'url' => [
                            'action' => 'update'
                        ], 'class' => 'button warning'
                    ]) ?>
                    <?= $this->Form->button(__d('shopping', 'Payment'), ['class' => 'button success']) ?>
                </p>
            <?php } else { ?>
                <div class="cart-empty">
                    <?= $this->Html->image('cart.png') ?>
                </div>
                <small><?= __d('shopping', 'Cart is Empty') ?></small>
            <?php } ?>



        </div>
    </div>
    <?php echo $this->Form->end();?>
</div>

