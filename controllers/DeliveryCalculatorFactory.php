<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 17.03.2022
 * Time: 16:40
 */

namespace controllers;


use interfaces\DeliveryCalculatorInterface;

/**
 * Фабрика
 *
 * Class DeliveryCalculatorFactory
 * @package controllers
 */
class DeliveryCalculatorFactory
{
    private const MAP = [
        'slow' => SlowDeliveryCalculator::class,
        'fast' => FastDeliveryCalculator::class,
    ];

    public function create(string $type)
    {
        $serviceName = self::MAP[mb_strtolower($type)] ?? null;
        if ($serviceName === null) {
            throw new \Exception("Такая служба доставки еще не реализована");
        }

        return new $serviceName();
    }
}