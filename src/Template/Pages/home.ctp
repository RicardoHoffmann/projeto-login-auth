<?php
    $this->assign('title', 'Home');
?>

<style>
    #div-search {
        position: absolute;
        left: 50%;
        top: 50%;

        /*
        *  Where the magic happens
        *  Centering method from CSS Tricks
        *  http://css-tricks.com/centering-percentage-widthheight-elements/
        */
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }

    .buttonHolder{ text-align: center; }

    body {
        background: url(<?=  $this->Url->image('landpage_background.jpg') ?>);
    }
</style>
<div class="row" >
    <div class="small-12 medium-6 columns" id="div-search">

    </div>
</div>
