<?php

require_once('Game.class.php');
require_once('Badass_mess.class.php');
require_once('Anarchy_son.class.php');

$res = [];
if ($_POST["command"])
{
    $game = new Game('save.game');
    $obj1 = new Badass_mess(1);
    $obj2 = new Anarchy_son(1);
    if ($_POST["command"] == "board" || var_dump(is_Badass_mess($obj1) || var_dump(Anarchy_son($obj2)))) 
    {
        $res = $game->show_board();
    }
}


?>