<?php
namespace KaryTest;

use Kary\Barista;
use Kary\CoffeeGrinds;
use Kary\Cookie;
use Kary\CookieJar;
use Kary\Espresso;
use Kary\EspressoMachine;
use Kary\Grinder;
use PHPUnit\Framework\TestCase;

class BaristaTest extends TestCase
{
    /**
     * TODO #1 - this test is failing. Change Barista.php to make it pass.
     */
    public function testSayHello() {
        $barista = new Barista();
        $response = $barista->sayHello();
        $this->assertSame('Hello to you too', $response);
    }

    /**
     * TODO #2 - The barista uses the espresso machine to make the espresso.
     *           Make sure we get the espresso created by the machine, and not some other one.
     *           Hint: set a mock espresso machine on the barista and tell it how to respond.
     *
     */
    public function testMakeEspresso() {
        $mockEspresso = $this->getMockBuilder(Espresso::class)->getMock();

        $mockBarista = $this->getMockBuilder(Barista::class)->setMethods(['orderEspresso'])->getMock();
        $mockBarista->expects($this->once())->method('orderEspresso')->willReturn($mockEspresso);

        //$this->barista = new Barista();
        $drink = $mockBarista->orderEspresso();
        $this->assertSame($mockEspresso, $drink);
    }

    /**
     * TODO #3 - We want to also be able to order cookies from the Barista.
    The Barista will get cookies from a CookieJar that he has.
    - First write the test. (It will be similar to the one above).
    - Then run it to make sure it fails.
    - Finally, write the code to make it pass.
     */
    /**
     * @var CookieJar
     */
    public function testOrderCookie() {
        $cookie = CookieJar::extractACookie();
        $this->assertEquals(new Cookie(), $cookie);
    }

    /**
     * TODO #4 - In the process of making espresso, the Barista should use the coffee bean Grinder.
    We never tested that the grinder actually gets used. If she uses the pre-ground coffee
    to make espresso this would be a bug! How do we know? We need a test.
    Modify the testMakeEspresso method to ensure that the Barista uses a mock Grinder.
    Hint: The difficulty here is that the Grinder::grind method is static.
    The easy way to fix this is to make it an instance method (i.e. not static).
    Bonus: Can you write the test and keep the grind method static?
     */
    public function testUseGrinder(){
        $mockEspresso = $this->getMockBuilder(Espresso::class)->getMock();

        $mockEspressoMachine = $this->getMockBuilder(EspressoMachine::class)
            ->setMethods(['makeEspresso'])
            ->getMock();

        $mockEspressoMachine->expects($this->once())
            ->method('makeEspresso')
            ->willReturn($mockEspresso);

        $mockGrinder = $this->getMockBuilder(Grinder::class)->getMock();

        $mockGrinder->expects($this->once())
            ->method('grind')
            ->willReturn(new CoffeeGrinds());

//        $mockBarista = $this->getMockBuilder(Barista::class)
//            ->setMethods(['orderEspresso'])
//            ->getMock();
//
//        $mockBarista->expects($this->once())
//            ->method('orderEspresso')
//            ->willReturn($mockEspresso);

        $barista = new Barista();
        $barista->setGrinder($mockGrinder);
        $barista->setEspressonMachine($mockEspressoMachine);

        $result = $barista->orderEspresso();
        $this->assertSame($mockEspresso, $result);
    }

}