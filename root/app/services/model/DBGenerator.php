<?

class DBGenerator
{
    private $host;  // Database host

    private $dbname;  // Database name

    private $username;  // Database username

    private $password;  // Database password

    private $database;

    private $port;

    private $type;

    protected function __construct()
    {
        try {
            // Create a new PDO connection
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);

            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->database = $pdo;
            echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    protected function connect()
    {
        return (new self());
    }

    protected function getHost()
    {
        return $this->host;
    }

    protected function getDBName()
    {
        return $this->dbname;
    }

    protected function getUsername()
    {
        return $this->username;
    }

    protected function getPort()
    {
        return $this->port;
    }

    protected function setHost($host = null)
    {
        $this->host = $host;
        return $this;
    }

    protected function setDBName($dbname = null)
    {
        $this->dbname = $dbname;
        return $this;
    }

    protected function setUsername($username = null)
    {
        $this->username = $username;
        return $this;
    }

    protected function setPort($port = null)
    {
        $this->port = $port;
        return $this;
    }

    protected function setPassword($password = null)
    {
        $this->password = $password;
        return $this;
    }
}
