<?php


require_once('Map.class.php');
require_once('Badass_mess.class.php');
require_once('Anarchy_son.class.php');

class Game {
    private $_data = [];
    private $_action = [];

    public function __construct(array $info)
    {
        $this->_action = $info;
        if ((isset($this->_action['new_game']) && $this->_action['new_game'] === 'NEW GAME') || empty($this->_action)) {
            $this->create_new_game();
        } else if (file_exists("save.game")) {
            $this->_data = unserialize(file_get_contents("save.game"));
            $this->handle_events();
        }
        $this->show_map();
        $this->show_controlers();
        $this->save();
    }
    
    public function __get($att) {
        print("Вы пытаетесь получить значение аттрибута $att, который является приватным" . PHP_EOL);
    }
    public function __set($att, $value) {
        print("Вы пытаетесь установить значение приватного аттрибута $att, равным $value");
    }

    private function save()
    {
        file_put_contents("save.game", serialize($this->_data));
    }
    
    private function create_new_game()
    {
        $this->_data = array();
        $this->_action = array();
        $ship = new Badass_mess(40, 5, "#00FF00", 'badass_mess');
        $this->_data["ships"][$ship->getName()] = $ship;
        $ship = new Anarchy_son(100, 10, "#00F0F0", 'anarchy_son');
        $this->_data["ships"][$ship->getName()] = $ship;
    }
    
    private function handle_events()
    {
        if ($this->_action["rotate"] === "Rotate")
        {
            $this->_data["ships"][$this->_action['name']]->rotate();
        }  
        else if ($this->_action["submit"] === "go")
        {
            $this->_data["ships"][$this->_action['name']]->move();
        }
    }

    private function show_map()
    {
        $map = new Map();
        if (isset($this->_action['shoot']) && $this->_action["shoot"] == "shoot") {
           $this->_data["ships"][$this->_action['name']]->shoot($map);
           $slogan = $this->_data["ships"][$this->_action['name']]->saySlogan();
           echo("<div class='slogan'>$slogan</div>");
        }
        foreach ($this->_data["ships"] as $ship)
        {
            $ship->put_on_map($map);
        }
        $map->print_map();        
    }

    private function show_controlers()
    {
        echo(include("_control.php"));
    }

    static public function doc()
    {
        return(file_get_contents('Game.doc.txt'));
    }
}
?>