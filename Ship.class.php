<?php

class Ship {
    private $_name;
    private $_size;
    private $_hull_points;
    private $_pp;
    private $_speed;
    private $_handling;
    private $_shield;
    private $_weapons;
    
    private $_x;
    private $_y;
    private $_angle;
    private $_color;

    public function __construct($x, $y, $color, $name) {
        $this->_x = $x;
        $this->_y = $y;
        $this->_size['x'] = 2;
        $this->_size['y'] = 5;
        $this->_angle = 0;
        $this->_name = $name;
        $this->_color = $color;
    }

    public function saySlogan() {
        return("В атаку");
    } 

    public function __get($att) {
        print("Вы пытаетесь получить значение аттрибута $att, который является приватным" . PHP_EOL);
    }
    public function __set($att, $value) {
        print("Вы пытаетесь установить значение приватного аттрибута $att, равным $value");
    }

    public function getName() {
        return($this->_name);
    }

    public function put_on_map($map)
    {
        if ($this->_angle == 1)
            $shipPiece = '&#9660;';
        else if ($this->_angle == 2)
            $shipPiece = '&#9664;';
        else if ($this->_angle == 3)
            $shipPiece = '&#9650;';
        else
            $shipPiece = '&#9654;';

        $y = min([0, $this->_size['y']]);
        while ($y < max([0, $this->_size['y']]))
        {
            $x = min([0, $this->_size['x']]);
            while ($x < max([0, $this->_size['x']]))
            {
                $map->put($this->_x + $x, $this->_y + $y, $shipPiece, $this->_color);
                $x++;
            }
            $y++;
        }
    }

    public function shoot($map) {
        if ($this->_angle == 1) {
            for ($i = 2; $i < 52; $i++) {
                $map->put($this->_x - 3, $this->_y + $i, '|', "#FF0000");
            }
        }
        else if ($this->_angle == 2){
            for ($i = 3; $i < 53; $i++) {
                $map->put($this->_x - $i, $this->_y - 3, '-', "#FF0000");
            }
        }
        else if ($this->_angle == 3){
            for ($i = 3; $i < 53; $i++) {
                $map->put($this->_x + 2, $this->_y - $i, '|', "#FF0000");
            }
        }
        else {
            for ($i = 2; $i < 52; $i++) {
                $map->put($this->_x + $i, $this->_y + 2, '-', "#FF0000");
            }
        }
    }

    public function rotate()
    {
        $this->_angle = ($this->_angle + 1) % 4;
        $temp = -$this->_size['y'];
        $this->_size['y'] = $this->_size['x'];
        $this->_size['x'] = $temp;
    }
    
    public function move()
    {
        if ($this->_angle % 2 == 0)
            $this->_x += 1 - $this->_angle % 4;
        else if ($this->_angle % 2 == 1)
            $this->_y += 2 - $this->_angle % 4;
        if ($this->_x < 0 or $this->_x >= 150 or $this->_y < 0 or $this->_y >= 100)
            echo "false!".PHP_EOL;
    }

    static public function doc()
    {
        return(file_get_contents('Ship.doc.txt'));
    }
}

?>