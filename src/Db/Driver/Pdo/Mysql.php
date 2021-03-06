<?php
namespace FMUP\Db\Driver\Pdo;

use FMUP\Db\Driver\Pdo;

class Mysql extends Pdo
{
    public function getDriver()
    {
        return 'mysql';
    }

    /**
     * @param string $sql
     * @param array $options
     * @return \PDOStatement
     * @throws \FMUP\Db\Exception
     */
    public function prepare($sql, array $options = array())
    {
        if (defined('\Pdo::MYSQL_ATTR_USE_BUFFERED_QUERY') && !isset($options[\Pdo::MYSQL_ATTR_USE_BUFFERED_QUERY])) {
            $options[\Pdo::MYSQL_ATTR_USE_BUFFERED_QUERY] = true;
        }
        return parent::prepare($sql, $options);
    }
}
