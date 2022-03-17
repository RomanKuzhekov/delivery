<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 16.03.2022
 * Time: 12:11
 */

namespace interfaces;


interface DeliveryCalculatorInterface
{
    public function getResultApi(string $baseUrl, string $source, string $target, float $weight, string $name): array;
}