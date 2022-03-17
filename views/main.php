<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание</title>
</head>
<body>

<div class="content">
    <h2>Онлайн-расчет стоимости доставки</h2>
    <form method="post">
        <p><label>Откуда:</label> <input type="text" size="10" name="from" value="<?=$_POST['from']?>" required></p>
        <p><label>Куда:</label> <input type="text" size="10" name="to" value="<?=$_POST['to']?>" required></p>
        <p><label>Вес (в кг.):</label> <input type="text" size="10" name="weight" value="<?=$_POST['weight']?>" required></p>
        <br>
        <b>Службы доставки:</b>
        <select name="delivery-name">
            <option value="fast" <? if($_POST['delivery-name'] == 'fast') echo 'selected'; ?>>Быстрая доставка</option>
            <option value="slow" <? if($_POST['delivery-name'] == 'slow') echo 'selected'; ?>>Медленная доставка</option>
        </select>
        <p><input type="submit" value="Расчет"></p>
    </form>
    <hr>
    <? if (!empty($content)): ?>
        <h3>Результат:</h3>
        <p class="error"><?=$content['error']?></p>
        <p>Цена доставки: <b><?=$content['price']?></b> руб.</p>
        <p>Дата доставки: <b><?=$content['date']?></b></p>
    <? endif; ?>
</div>

</body>
</html>