<?php
class Token
{
    private $conn;
    private $table_name = "tokens";

    public $token;
    public $usedCount;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    token = :token,
                    usedCount = 0";

        $stmt = $this->conn->prepare($query);

        $this->token = htmlspecialchars(strip_tags($this->token));

        $stmt->bindParam(':token', $this->token);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function generate()
    {
        $token = sha1(mt_rand(1, 90000) . 'DUNDUKSALTYBOOOOOY');

        return $token;
    }

    function exists()
    {
        $query = "SELECT token
                FROM " . $this->table_name . "
                WHERE token = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->token = htmlspecialchars(strip_tags($this->token));

        $stmt->bindParam(1, $this->token);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->token = $row['token'];
            $this->usedCount = $row['usedCount'];

            return true;
        }

        return false;
    }
}
