<?php

class Book implements JsonSerializable {

    private $id;
    private $name;
    private $author;
    private $description;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->author = '';
        $this->description = '';
    }

    public function jsonSerialize() {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'author' => $this->author,
            'description' => $this->description
        ];
    }

    public function loadFromDB($conn, $id) {
        $result = $conn->query("SELECT*FROM books" . (is_null($id) ? '' : ' WHERE id=' . $id));
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        if (!is_null($id)) {
            return $books[0];
        } else {
            return $books;
        }
    }

    public function create($conn, $name, $author, $description) {
        $conn->query("INSERT INTO books(book_name, book_author, book_desc) VALUES ('" . $name . "', '" . $author . "', '" . $description . "')");
        $id = $conn->insert_id;
        return($this->loadFromDB($conn, $id));
    }

    public function update($conn, $id, $name, $author, $description) {
        $conn->query("UPDATE books SET " . (is_null($name) ? '' : 'book_name="' . $name . '",') . (is_null($author) ? '' : 'book_author="' . $author . '",') . (is_null($description) ? '' : 'book_desc="' . $description . '"') . " WHERE id = " . $id);

        return($this->loadFromDB($conn, $id));
    }

    public function deleteFromDB($conn, $id) {
        $conn->query("DELETE FROM books WHERE id=" . $id);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAuthor($author) {
        $this->name = $author;
    }

    public function setDescription($description) {
        $this->name = $description;
    }

}
