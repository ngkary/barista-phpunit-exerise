<?php
namespace Kary;

use Kary\EspressoMachine;
use Kary\Grinder;

class Barista {

    /**
     * @var EspressoMachine
     */
    protected $espressonMachine;

    /**
     * @var Grinder
     */
    protected $grinder;

    public function setGrinder(Grinder $grinder)
    {
        $this->grinder = $grinder;
    }
    public function setEspressonMachine(EspressoMachine $espressonMachine) {
        $this->espressonMachine = $espressonMachine;
    }

    public function sayHello() {
        return "Hello to you too";
    }

    public function orderEspresso(): Espresso
    {
        $grinds = $this->grinder->grind();
        return $this->espressonMachine->makeEspresso($grinds);
    }
}
