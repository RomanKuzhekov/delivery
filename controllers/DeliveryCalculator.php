<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 16.03.2022
 * Time: 17:53
 */

namespace controllers;
use interfaces\DeliveryCalculatorInterface;

/**
 * Controller
 *
 * Class DeliveryCalculator
 * @package controllers
 */
class DeliveryCalculator implements DeliveryCalculatorInterface
{
    private $content;
    private $errors = [];
    private $price;
    private $date;
    private $period;
    protected $baseUrl = 'https://cdek.ru/api/';
    protected $name;
    protected $source;
    protected $target;
    protected $weight;


    public function run()
    {
        //Получаем данные из формы (название службы, откуда, куда, вес) и запускаем расчет
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->name = $_POST["delivery-name"];
            $this->source = htmlentities($_POST['from']);
            $this->target = htmlentities($_POST['to']);
            $this->weight = (float)htmlentities($_POST['weight']);

            //Проверяем какая служба доставки выбрана и проводим расчет
            $factory = new DeliveryCalculatorFactory();
            try {
                $calculator = $factory->create($this->name);
                $this->content = $calculator->calculate($this->name, $this->source, $this->target, $this->weight);
            } catch (\Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        return $this->render();
    }

    private function render()
    {
        $content = $this->output();
        extract($content);
        $templatePath = $_SERVER["DOCUMENT_ROOT"] . "/views/main.php";
        include $templatePath;
    }

    private function output(): array
    {
        $result = json_decode($this->content, true);

        //Если нужно добавляем условия для расчета

        $this->price = $result['coefficient'] ?: $result['price'];
        $this->date = $result['date'];
        $this->errors = $result['error'];

        return [
            'price' => $this->price ?? 0,
            'date' => $this->date ?? '',
            'period' => $this->period ?? 0,
            'error' => $this->errors,
        ];
    }

    //Отправляем GET запрос и с помощью API компании получаем JSON ответ
    public function getResultApi(string $baseUrl, string $source, string $target, float $weight, string $name): array
    {
        /** @var DeliveryApiCompany $jsonResultApi */
        $jsonResultApi = (new DeliveryApiCompany())->getResult($baseUrl, $source, $target, $weight, $name);
        return json_decode($jsonResultApi, true);
    }
}