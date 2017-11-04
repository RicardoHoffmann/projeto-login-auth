<?php

namespace Accounts\Authz\View\Helper;

use Cake\View\Helper;

class MenuHelper extends Helper
{
    public $helpers = ['Html'];

    function show($menu=null)
    {
        echo "<ul class=\"dropdown menu\" data-dropdown-menu>";
        $this->recursiveMenu($menu);
        echo "</ul>";
    }

    function showMobile($menu=null)
    {
        echo "<ul class=\"vertical menu\" data-drilldown>";
        $this->recursiveMenu($menu);
        echo "</ul>";
    }

    function recursiveMenu($array)
    {
        if (count($array)) {
           // echo "\n<ul>\n";
            foreach ($array as $vals) {
                if ($vals['plugin'] && $vals['controller'] && $vals['action']) {
                    echo "<li id=\"" . $vals['id'] . "\">" . $this->Html->link($vals['name'], [
                            'plugin' => $vals['plugin'],
                            'controller' => $vals['controller'],
                            'action' => $vals['action']
                        ]);
                } elseif ($vals['controller'] && $vals['action']) {
                    echo "<li id=\"" . $vals['id'] . "\">" . $this->Html->link($vals['name'], [
                            'controller' => $vals['controller'],
                            'action' => $vals['action']
                        ]);
                } else {
                    echo "<li>";
                    echo "<a href=\"#\" id=\"" . $vals['id'] . "\">" . $vals['name'] . "</a>";

                }

                if (count($vals['children'])) {
                    echo "<ul class=\"vertical menu\">";
                    $this->recursiveMenu($vals['children']);
                    echo "</ul>";
                }
                echo "</li>\n";
            }
           // echo "</ul>\n";
        }
    }

}



//<ul class="dropdown menu" data-dropdown-menu>
//                <li>
//                    <a href="#">One</a>
//                    <ul class="menu vertical">
//                        <li><a href="#">One</a></li>
//                        <li><a href="#">Two</a></li>
//                        <li><a href="#">Three</a></li>
//                        <li>
//                            <a href="#">One Again</a>
//                            <ul class="menu vertical">
//                                <li><a href="#">One</a></li>
//                                <li><a href="#">Two</a></li>
//                                <li><a href="#">Three</a></li>
//                            </ul>
//                        </li>
//                    </ul>
//                </li>
//                <li><a href="#">Two</a></li>
//                <li><a href="#">Three</a></li>
//            </ul>