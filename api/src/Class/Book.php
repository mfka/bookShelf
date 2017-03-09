<?php

class Book implements JsonSerializable
{


    private $id;
    private $name;
    private $author;
    private $description;

    public function __construct()
    {
        $this->id = -1;
        $this->name = '';
        $this->author = '';
        $this->description = '';
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'author' => $this->getAuthor(),
            'description' => $this->getDescription()
        ];
    }

    public function getBookByID($id = null, $limit = null)
    {
        $conn = Database::getConnection();

        try {
            $stmt = $conn->prepare('SELECT * FROM books' . (is_null($id) ? '' : 'WHERE id = :id') . (is_null($limit) ? ' LIMIT :limit' : ''));
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':limit', $limit);
            if ($limit === 1) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ($e->getMessage());
        }

    }

    public function create($conn, $name, $author, $description)
    {
        $conn->query("INSERT INTO books(book_name, book_author, book_desc) VALUES ('" . $name . "', '" . $author . "', '" . $description . "')");
        $id = $conn->insert_id;
        return ($this->loadFromDB($conn, $id));
    }

    public function update($conn, $id, $name, $author, $description)
    {
        $conn->query("UPDATE books SET " . (is_null($name) ? '' : 'book_name="' . $name . '",') . (is_null($author) ? '' : 'book_author="' . $author . '",') . (is_null($description) ? '' : 'book_desc="' . $description . '"') . " WHERE id = " . $id);

        return ($this->loadFromDB($conn, $id));
    }

    public function deleteFromDB($conn, $id)
    {
        $conn->query("DELETE FROM books WHERE id=" . $id);
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}
