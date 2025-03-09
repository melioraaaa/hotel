<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "hotel"; // Имя базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $roomType = implode(", ", $_POST['roomType']); // Преобразуем массив в строку
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Подготовка SQL запроса
    $sql = "INSERT INTO bookings (check_in, check_out, adults, children, room_type, first_name, last_name, middle_name, phone, email)
    VALUES ('$checkIn', '$checkOut', '$adults', '$children', '$roomType', '$firstName', '$lastName', '$middleName', '$phone', '$email')";

    // Выполнение запроса
    if ($conn->query($sql) === TRUE) {
        echo "Бронирование успешно создано!"; // Сообщение об успехе
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error; // Сообщение об ошибке
    }
}

// Закрытие соединения
$conn->close();
?>