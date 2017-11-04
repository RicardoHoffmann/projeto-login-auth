<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<style>
    .rounded-img img {
        width: 8rem;
        display: block;
        margin: 2rem auto;
        text-align: center;
        border-radius: 50%;
        box-shadow: 2px 2px 5px #888888;
    }
</style>

<nav class="large-3 medium-4 columns" id="actions-sidebar" style="text-align:center">
    <p class="rounded-img">
        <?php
            $email_hash = md5(strtolower(trim($user->email)));
            echo $this->Html->image(
                'https://www.gravatar.com/avatar/' . $email_hash . "?s=160",
                ['alt' => 'Sua conta', 'title' => 'Sua conta', 'style' => 'margin-top: 25px']
            );
        ?>
    </p>
    <h4>
        <?=
            $this->Html->tag(
                'span',
                __d('Accounts/profile', '{0} {1}', $user->first_name, $user->last_name),
                ['class' => 'full_name']
            )
        ?>
    </h4>
        <?=
            $this->Html->link(
                __d('Accounts/profile', 'Change avatar'),
                'https://gravatar.com',
                ['target' => '_blank']
            );
    ?>
    |
    <?=
        $this->Html->link(__d('Accounts/profile', 'Change Password'), [
                'plugin' => 'Accounts/Profile',
                'controller' => 'Users',
                'action' => 'changePassword']
        );
    ?>
</nav>

<div class="users form large-9 medium-8 columns content">
    <div class="large-6 columns strings">
        <h6 class="subheader"><?= __d('Accounts/profile', 'Username') ?></h6>
        <p><?= h($user->username) ?></p>
        <h6 class="subheader"><?= __d('Accounts/profile', 'Email') ?></h6>
        <p><?= h($user->email) ?>&nbsp;[<?= $this->Html->link(__d('Accounts/profile', 'update'), [
                    'plugin' => 'Accounts/Profile',
                    'controller' => 'Users',
                    'action' => 'changeEmail']
            ); ?>]</p>
        <?php
        if (!empty($user->api_token)):
            ?>
            <h6 class="subheader"><?= __d('Accounts/profile', 'API Token') ?></h6>
            <p><?= $user->api_token ?></p>
        <?php endif; ?>
        <h6 class="subheader"><?= __d('Accounts/profile', 'Recent Activity') ?></h6>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th><?= __d('Accounts/profile', 'Date/Time'); ?></th>
                <th><?= __d('Accounts/profile', 'IP'); ?></th>
                <th><?= __d('Accounts/profile', 'Browser'); ?></th>
                <th><?= __d('Accounts/profile', 'Login Attempt'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($accessLogs as $log):
                ?>
                <tr>
                    <td><?= $log->created ?></td>
                    <td><?= $log->ipv4_address ?></td>
                    <td><?= h(substr(strrchr($log->browser, " "), 1)) ?></td>
                    <td>
                        <center>
                            <?php if ($log->success == 1) {
                                echo '<i style="color: green;" class="fi-check" title="' . __d('Accounts/profile', 'Successful') . '"></i>';
                            } else {
                                echo '<i style="color: red;" class="fi-x" title="' . __d('Accounts/profile', 'Unsuccessful') . '"></i>';
                            } ?>
                        </center>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
            </tbody>
        </table>
        <?php
        if (!empty($user->social_accounts)):
            ?>
            <h6 class="subheader"><?= __d('Accounts/profile', 'Social Accounts') ?></h6>
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th><?= __d('Accounts/profile', 'Avatar'); ?></th>
                    <th><?= __d('Accounts/profile', 'Provider'); ?></th>
                    <th><?= __d('Accounts/profile', 'Link'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($user->social_accounts as $socialAccount):
                    $escapedUsername = h($socialAccount->username);
                    $linkText = empty($escapedUsername) ? __d('Accounts/profile', 'Link to {0}', h($socialAccount->provider)) : h($socialAccount->username)
                    ?>
                    <tr>
                        <td><?=
                            $this->Html->image(
                                $socialAccount->avatar,
                                ['width' => '90', 'height' => '90']
                            ) ?>
                        </td>
                        <td><?= h($socialAccount->provider) ?></td>
                        <td><?=
                            $this->Html->link(
                                $linkText,
                                $socialAccount->link,
                                ['target' => '_blank']
                            ) ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
                </tbody>
            </table>
            <?php
        endif;
        ?>
    </div>
</div>
