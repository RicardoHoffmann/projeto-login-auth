<center>
    <?php if ($showCaptcha) {
             echo $this->Html->tag("div", "", [
                    'class' => 'g-recaptcha',
                    'data-siteKey' => $siteKey
              ]);
             echo $this->Html->script("https://www.google.com/recaptcha/api.js?hl={$lang}");
        }
    ?>
</center>