<?php

namespace App;

use PDO;
use PDOException;

/**
 * MyPDO êëàññ äëÿ ğàáîòû ñ áä
 */
class MyPDO extends PDO
{
    /**
     * @var mixed|string
     */
    private $host;
    /**
     * @var mixed|string
     */
    private $db;
    /**
     * @var mixed|string
     */
    private $user;
    /**
     * @var mixed|string
     */
    private $pass;
    /**
     * @var mixed|string
     */
    private $charset;
    /**
     * @var string
     */
    private $dsn;
    /**
     * @var array
     */
    private $options;

    /**
     * @param $host
     * @param $db
     * @param $user
     * @param $pass
     * @param $charset
     */
    public function __construct(
        $host = 'localhost',
        $db = 'test',
        $user = 'root',
        $pass = '',
        $charset = 'utf8mb4'
    )
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->charset = $charset;

        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {

            parent::__construct($this->dsn, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {

            die('Îøèáêà ïîäêëş÷åíèÿ ê áàçå äàííûõ: ' . $e->getMessage());
        }
    }
}
