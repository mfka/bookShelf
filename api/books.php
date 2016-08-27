<?php

include ('src/db_actions.php');
include ('src/book.class.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $bookId = intval($_GET['id']);
    } else {
        $bookId = null;
    }
    $conn = Database::getConnection();
    $books = new Book();
    $booksList = $books->loadFromDB($conn, $bookId);
    Database::closeConnection();
    echo json_encode($booksList);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = Database::getConnection();
    $addBook = new Book();
    echo json_encode($addBook->create($conn, $_POST['name'], $_POST['author'], $_POST['description']));
    Database::closeConnection();
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $conn = Database::getConnection();
    parse_str(file_get_contents("php://input"), $put_vars);
    $editBook = new Book();
    echo json_encode($editBook->update($conn, $put_vars['id'], $put_vars['name'], $put_vars['author'], $put_vars['descrpition']));
    Database::closeConnection();
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $conn = Database::getConnection();
    parse_str(file_get_contents("php://input"), $del_vars);
    $delBook = new Book();
    $delBook->deleteFromDB($conn, $del_vars['id']);
    Database::closeConnection();
}

