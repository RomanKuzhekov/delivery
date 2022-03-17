<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 16.03.2022
 * Time: 12:29
 */

namespace controllers;

/**
 * Быстрая доставка
 *
 * Class FastDeliveryCalculator
 * @package controllers
 */
class FastDeliveryCalculator extends DeliveryCalculator
{
    public function calculate(string $name, string $source, string $target, float $weight)
    {
        $arResult = $this->getResultApi($this->baseUrl, $source, $target, $weight, $name);

        $arResult['date'] = date("Y-m-d", strtotime($arResult['date'].'- 2 days')); // Быстрая доставка на 2 дня раньше чем медленная

        //количество дней начиная с сегодняшнего, но после 18.00 заявки не принимаются.
        if (date("H") < 18) { //считаем с текущего дня
            $period = floor(abs(strtotime(date("Y-m-d")) - strtotime($arResult['date'])) / 86400);
        } else { //считаем с следующего дня
            $period = floor(abs(strtotime(date("Y-m-d", strtotime(date("Y-m-d").'+ 1 days'))) - strtotime($arResult['date'])) / 86400);
        }

        return json_encode(
            [
                'price' => $arResult['price'],
                'date' =>  $arResult['date'],
                'period' => $period ?: 1,
                'errors' => $arResult['error']
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}