<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $products
 */

    $this->layout = 'shopping'
?>
<style>
    img.product-img {
        width: 200px;
        height: 200px;
    }
</style>
<div class="products index small-12 large-11 medium-8 columns content">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-md-4">
                <div class="">
                    <?php echo $this->Html->link($this->Html->image('/uploads/' . $product->image, ['class' => 'product-img']),
                        ['action'=>'view',$product->id],
                        ['escape'=>false,'class'=>'thumbnail']);?>
                    <div class="caption">
                        <h5>
                            <?= $product->name; ?>
                        </h5>
                        <h5>
                            <?= __d('shopping', 'Price: R$ ' . number_format($product->price, 2, ',', '.')) ?>
                        </h5>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
