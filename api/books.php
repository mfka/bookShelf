<?php
require_once __DIR__ . '/src/config.php';
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
    echo json_encode($addBook->addBook($_POST['title'], $_POST['author'], $_POST['desc']));
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $values);
    $editBook = new Book();
    echo json_encode($editBook->updateBook($values['id'], $values['title'], $values['author'], $values['desc']));
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $values);
    $delBook = new Book();
    $delBook->deleteBook($values['id']);
}
