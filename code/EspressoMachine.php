<?php
namespace Kary;
class EspressoMachine {

    public function makeEspresso(CoffeeGrinds $grinds): Espresso {
        return new Espresso();
    }

}
