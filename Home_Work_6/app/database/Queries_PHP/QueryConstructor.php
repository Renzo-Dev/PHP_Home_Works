<?php

class QueryConstructor
{
    private string $host; // localhost / postgres
    private string $port;
    private string $user;
    private string $password;
    private string $dbname;
    private array $options;

    public function __construct($host, $port, $user, $password, $dbname, $options = [])
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->options = $options;
    }

    /**
     * Создает запрос, запрос с генерацией тела ( передаем в параметрах )
     * @param array $query_list Список SQL-запросов для выполнения
     * @return void
     */
    public function Create(array $query_list = []): void
    {
        try {
            $pdo = $this->createPDO();
            if (count($query_list) > 0) {
                foreach ($query_list as $query) {
                    $pdo->exec($query);
                }
            }
            $pdo = null; // Закрываем соединение после выполнения запросов
        } catch (PDOException $exp) {
            if (!$exp->getCode() == "42P07") { // обходим исключение , если таблицы уже созданы в БД
                echo "Error: " . $exp->getMessage();
            }
        }
    }

    public function Insert($query)
    {
        try {
            $pdo = $this->createPDO();
            $pdo->exec($query);
            $pdo = null; // Закрываем соединение после выполнения запросов
        } catch (PDOException $exp) {
            echo "Error: " . $exp->getMessage();
        }
    }

    public function Select($query)
    {
        try {
            $pdo = $this->createPDO();
            $stmt = $pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exp) {
            echo "Error: " . $exp->getMessage();
            return null;
        }
    }

    /**
     * Создает объект PDO с опциями подключения
     * @return PDO
     */
    private function createPDO(): PDO
    {
        $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname";
        $pdo = new PDO($dsn, $this->user, $this->password, $this->options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ErrorMode - генерирует исключение при ошибке
        return $pdo;
    }
}