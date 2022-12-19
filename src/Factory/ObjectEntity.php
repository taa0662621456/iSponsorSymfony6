<?php
//https://symfony.com/doc/current/the-fast-track/ru/8-doctrine.html

namespace App\Factory;


use JetBrains\PhpStorm\Pure;

abstract class ObjectEntity
{

    public static function createObjectLanguageLayer(string $localFilterReq = null, $object = null): object
    {
        // хелпер: https://overcoder.net/q/15100/%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D0%B5-%D1%8D%D0%BA%D0%B7%D0%B5%D0%BC%D0%BF%D0%BB%D1%8F%D1%80%D0%B0-%D0%BA%D0%BB%D0%B0%D1%81%D1%81%D0%B0-php-%D1%81%D0%BE-%D1%81%D1%82%D1%80%D0%BE%D0%BA%D0%BE%D0%B9
        //TODO: получить localFilter и создать экземпляр класса со сконтактинированным именем,
        //перед этим диспетчер получает имя объекта,
        //клас должен быть с полным пространством имени,
        //$class = '\Foo\Bar\MyClass';
//        /**
//         * $class
//         * $objectLanguageLayer = \\App\\Entity\\ . $object . '\\' . $object . 's\\' . $object . '_' . $localFilterReq;
//         * return new $objectLanguageLayer() // если делать в классе-объекте
//         * return new $objectLanguageLayer() extend $object // если делать в отдельном классе-фабрике
//         */
        return new static ();
    }
}
