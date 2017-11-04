<li class="heading"><?= __d('Audit','Logs') ?></li>
<li><?= $this->Html->link(__d('Audit','Audit'), ['controller' => 'AuditLogs', 'action' => 'index']) ?></li>
<li><?= $this->Html->link(__d('Audit','Access'), ['controller' => 'UserAccessLogs', 'action' => 'index']) ?></li>