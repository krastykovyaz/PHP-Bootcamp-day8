<?php

class Map {
    private $_arr = [];
    const MAX_X = 150;
    const MAX_Y = 100;

    public function put($x, $y, $shipPiece, $color) {
        $i = $y * self::MAX_X + $x;
        $this->_arr[$i] = [$shipPiece, $color];
    }

    public function __get($att) {
        print("Вы пытаетесь получить значение аттрибута $att, который является приватным" . PHP_EOL);
    }
    public function __set($att, $value) {
        print("Вы пытаетесь установить значение приватного аттрибута $att, равным $value");
    }
        
    public function print_map()
    {
        print('<div class="table">');
        $y = 0;
        while ($y < self::MAX_Y)
        {
            print("<div class='row'>");
            $x = 0;      
            while ($x < self::MAX_X)
            {
                $i = ($y * self::MAX_X) + $x;
                if (array_key_exists($i, $this->_arr)) {
                    printf("<span class='special' style='background-color: %s;'>%s</span>", $this->_arr[$i][1], $this->_arr[$i][0]);
                }
                else {
                    print('&#9723;');
                }
                $x++;
            }
            print("</div>");
            $y++;
        }
        print('</div>');
    }

    static public function doc()
    {
        return(file_get_contents('Map.doc.txt'));
    }
}