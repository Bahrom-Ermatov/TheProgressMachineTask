<?php
    //Импортируем функции
    require_once "functions.php";

    //Проходим авторизацию
    $login = "admin@bahrom-ermatov";
    $password = "observer";

    $result = auth($login, $password);

    //Проверяем код ошибки
    if ($result[0]!=201) {
        exit("Возникла ошибка при авторизации");
    }

    //Получаем токен
    $access_token = json_decode($result[1], true)["access_token"];     //Access токен

    //Получаем список сотрудников
    $result = get_employees($access_token);

    //Проверяем код ошибки
    if ($result[0]!=200) {
        exit("Возникла ошибка при получении списка сотрудников");
    }
    print_r($result);


    //Создаем нового сотрудника
    $data = array(
        "firstName"=> "Дмитрий",
        "middleName"=> "Иванович",
        "lastName"=> "Менделеев",
        "inn"=> "222490425273",
        "position"=> "Директор",
        "phone"=> "+7(999)888-7766",
        "description"=> "Описание"
    );

    $result = create_employee($access_token, $data);
    //Проверяем код ошибки
    if ($result[0]!=200) {
        exit("Возникла ошибка при создании нового сотрудника");
    }

    $emp_id = json_decode($result[1], true)["id"];


    //Переименование сотрудника
    $data = array(
        "firstName"=> "Леонид",
    );

    $result = update_employee($access_token, $emp_id, $data);

    //Проверяем код ошибки
    if ($result[0]!=200) {
        exit("Возникла ошибка при изменении сотрудника");
    }


    //Удаление сотрудника
    $result = delete_employee($access_token, $emp_id);

    //Проверяем код ошибки
    if ($result[0]!=200) {
        exit("Возникла ошибка при удалении сотрудника");
    }
    
?>
