<?php
require_once __DIR__ . '/src/autoLoader.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $bookId = null;
    $limit = null;
    if (isset($_GET['id'])) {
        $bookId = intval($_GET['id']);
        $limit = 1;
    }
    $books = new Book();
    $booksList = $books->getBookByID($bookId, $limit);
    echo json_encode($booksList);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addBook = new Book();
    echo json_encode($addBook->create($conn, $_POST['name'], $_POST['author'], $_POST['description']));
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);
    $editBook = new Book();
    echo json_encode($editBook->update($conn, $put_vars['id'], $put_vars['name'], $put_vars['author'], $put_vars['descrpition']));
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $del_vars);
    $delBook = new Book();
    $delBook->deleteFromDB($conn, $del_vars['id']);
}
