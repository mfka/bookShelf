<?php

class Book implements JsonSerializable {

    private $id = -1;
    private $title = '';
    private $author = '';
    private $description = '';
    private $conn = null;

    public function __construct() {

        $this->conn = Database::getConnection();
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'author' => $this->getAuthor(),
            'description' => $this->getDescription()
        ];
    }

    public function getBookByID($id = null, $limit = null) {
        $query = 'SELECT * FROM books';
        if (!is_null($id)) {
            $query .= ' WHERE id = :id';
            $limit = 1;
        }

        if (!is_null($limit)) {
            $query .= ' LIMIT :limit';
        }

        error_log($query);
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            if (!is_null($id)) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('ERROR IN : ' . __CLASS__ . '/' . __FUNCTION__ . ' - ' . $e->getMessage());
        }
    }

    public function addBook($title = null, $author = null, $desc = null) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO books(title, author, description) VALUES (:title, :author, :desc)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $lastId = $this->conn->lastInsertId();
                return self::getBookById($lastId);
            }
            error_log("Sorry. Book Class didn't insert new Record to Database");
        } catch (PDOException $e) {
            error_log('ERROR IN : ' . __CLASS__ . '/' . __FUNCTION__ . ' - ' . $e->getMessage());
        }
    }

    public function updateBook($id = -1, $title = null, $author = null, $desc = null) {
        $query = "UPDATE books SET ";
        is_null($title) ? '' : $query .= 'title = :title, ';
        is_null($author) ? '' : $query .= 'author = :author, ';
        is_null($desc) ? '' : $query .= 'description = :desc, ';
        $query = preg_replace('/(,)[^,]*$/', '', $query);
        $query .= " WHERE id = :id LIMIT 1";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return self::getBookById($id);
            }
            error_log("Sorry. Book Class didn't update Record in Database");
        } catch (PDOException $e) {
            error_log('ERROR IN : ' . __CLASS__ . '/' . __FUNCTION__ . ' - ' . $e->getMessage());
        }
    }

    public function deleteBook($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM books WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('ERROR IN : ' . __CLASS__ . '/' . __FUNCTION__ . ' - ' . $e->getMessage());
        }
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->name = $title;
    }

    /**
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    public function __destruct() {
        $this->conn = null;
    }

}
