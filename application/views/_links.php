<p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Welcome <?php echo $username; ?>!</p>

<?php
foreach ($menu as $menu_item)
{
    echo '<li>';
    echo '<a href="' . $menu_item['url'] . '" title="' . $menu_item['description'] . '">';
    if (isset($menu_item['icon'])) {
        echo '<span class="glyphicon glyphicon-' . $menu_item['icon'] . '" aria-hidden="true"></span> ';
    }
    echo $menu_item['title'] . '</a></li>';
}
?>
