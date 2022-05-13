<?php
//Функция для отправки запроса в сторону приложения Мой Склад
function send_request($link, $header, $data, $method)
{
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,'');
    curl_setopt($curl,CURLOPT_URL, $link);
    curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl,CURLOPT_HEADER, false);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return array( $code, $out ); 
}


//Функция для прохождения авторизации
function auth($login, $password)
{
    $link = "https://online.moysklad.ru/api/remap/1.2/security/token"; //Формируем URL для запроса
    $header=["Authorization:Basic ".base64_encode($login.":".$password)]; //Определяем значение хидера
    $method = "POST"; //Определяем метод запроса
    $data = "";
    
    //Отправляем запрос
    $result = send_request($link, $header, $data, $method);

    return $result;
}

//Функция для получения списка сотрудников
function get_employees($access_token)
{
    $link = "https://online.moysklad.ru/api/remap/1.2/entity/employee"; //Формируем URL для запроса
    $header=["Authorization:Bearer ".$access_token]; //Определяем значение хидера
    $method = "GET"; //Определяем метод запроса
    $data = "";
    
    //Отправляем запрос
    $result = send_request($link, $header, $data, $method);

    return $result;
}


//Функция для создания сотрудника
function create_employee($access_token, $data)
{
    $link = "https://online.moysklad.ru/api/remap/1.2/entity/employee"; //Формируем URL для запроса
    $header=["Authorization:Bearer ".$access_token, 'Content-Type:application/json']; //Определяем значение хидера
    $method = "POST"; //Определяем метод запроса
    
    //Отправляем запрос
    $result = send_request($link, $header, $data, $method);

    return $result;
}


//Функция для изменения сотрудника
function update_employee($access_token, $emp_id, $data)
{
    $link = "https://online.moysklad.ru/api/remap/1.2/entity/employee/".$emp_id; //Формируем URL для запроса
    $header=["Authorization:Bearer ".$access_token, 'Content-Type:application/json']; //Определяем значение хидера
    $method = "PUT"; //Определяем метод запроса
    
    //Отправляем запрос
    $result = send_request($link, $header, $data, $method);

    return $result;
}

//Функция для удаления сотрудника
function delete_employee($access_token, $emp_id)
{
    $link = "https://online.moysklad.ru/api/remap/1.2/entity/employee/".$emp_id; //Формируем URL для запроса
    $header=["Authorization:Bearer ".$access_token, 'Content-Type:application/json']; //Определяем значение хидера
    $method = "DELETE"; //Определяем метод запроса
    $data = "";
    
    //Отправляем запрос
    $result = send_request($link, $header, $data, $method);

    return $result;
}
