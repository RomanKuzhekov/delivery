<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 16.03.2022
 * Time: 12:30
 */

namespace controllers;

/**
 * Медленная доставка
 *
 * Class SlowDeliveryCalculator
 * @package controllers
 */
class SlowDeliveryCalculator extends DeliveryCalculator
{
    private const BASE_COST = 150;
    private $coefficient = 1;

    public function calculate(string $name, string $source, string $target, float $weight)
    {
        $arResult = $this->getResultApi($this->baseUrl, $source, $target, $weight, $name);

        $this->coefficient = $arResult['price'] - (self::BASE_COST * $this->coefficient);

        return json_encode(
            [
                'coefficient' => $this->coefficient,
                'date' => $arResult['date'],
                'error' => $arResult['error']
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}