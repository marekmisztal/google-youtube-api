<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

abstract class DbalBaseRepository
{
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollback()
    {
        $this->connection->rollback();
    }
}