<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 16.03.2022
 * Time: 21:51
 */

namespace controllers;

/**
 * Внешний сервис API компании, осуществляющей доставку
 *
 *
 * Class DeliveryApiCompany
 * @package controllers
 */
class DeliveryApiCompany
{

    // Получить для набора отправлений стоимость и сроки доставки в контексте списка транспортных компаний и одной выбранной
    // Формат полученных от транспортных компаний данных должен быть приведен к единому виду
    public function getResult(string $baseUrl, string $source, string $target, float $weight, $name)
    {

        //Получаем данные по API по заданному урлу
    //    $data = json_decode(file_get_contents("{$baseUrl}?from={$source}&to={$target}&weight={$weight}&type={$name}"), true);


        //эмуляция данных полученных по API
        $data['price'] = 600;
        $data['date'] = '2022-03-28';
        $data['error'] = null;

        //Формат полученных от транспортных компаний данных должен быть приведен к единому виду
        return json_encode(
            [
                'price' => $data['price'],
                'date' => $data['date'],
                'errors' => $data['error']
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}