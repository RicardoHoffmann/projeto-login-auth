<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */

    use Cake\Routing\Router;
    $this->layout = 'shopping'
?>
<style>
    img.product-img {
        width: 200px;
        height: 200px;
        float: left;
        margin-right: 10%;
    }

    ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        background-color: #eee;
    }

    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }

    ul.breadcrumb li+li:before {
        padding: 8px;
        color: black;
        content: "/\00a0";
    }

    ul.breadcrumb li a {
        color: #222;
        text-decoration: none;
    }

    ul.breadcrumb li a:hover {
        color: #fec503;
        text-decoration: none;
    }

    div.datas h1 {
        font-size: 22px;
    }

    div.datas h2 {
        font-size: 18px;
    }

</style>
<div class="products view large-9 medium-8 columns content">
    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li><?= $this->Html->link('Products', ['controller' => 'Products', 'action' => 'index']) ?></li>
                <li class="active"><?= $product->name ?></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?php echo $this->Html->image('/uploads/' . $product->image, ['class' => 'product-img']);?>
        </div>

        <div class="col-lg-8 col-md-8 datas">
            <h1>
                <?= $product->name ?>
            </h1>
            <h2>
                <?= __d('shopping', 'Price: R$ '. number_format($product->price, 2, ',', '.')) ?>
            </h2>
            <p>
                <input class="button" type="button" value="<?= __d('shopping', 'Add to Cart') ?>" onclick="addCart('<?= $product->id ?>')">
            </p>

        </div>
        <div id="loading"></div>
    </div>
    <script>
        function addCart(id) {
            $.ajax({
                url: '<?= Router::url(['controller' => 'Carts', 'action' => 'add']) ?>' + '/' + encodeURIComponent(id),
                beforeSend: function () {
                    $('#loading').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                }
            })
                .done(function (data) {
                    $('#loading').html('');
                    $('#cart-counter').html(data);
                });
        }
    </script>
</div>
