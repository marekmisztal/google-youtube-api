<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Channel;
use App\Domain\Repository\ChannelRepository;
use Doctrine\DBAL\Connection;

class DbalChannelRepository extends DbalBaseRepository implements ChannelRepository
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Channel $channel)
    {
        $dql = "INSERT INTO channel 
                    (externalId, title, createdAt) 
                VALUES 
                    (:externalId, :title, :createdAt)
        ";
        $stmt = $this->connection->prepare($dql);
        $stmt->bindValue('externalId', $channel->getExternalId());
        $stmt->bindValue('title', $channel->getTitle());
        $stmt->bindValue('createdAt', $channel->getCreatedAt());
        $stmt->executeQuery();
    }

    public function alreadyExists(string $externalId)
    {
        $dql = "SELECT 1 
                FROM channel
                WHERE
                    externalId = :externalId
        ";
        $stmt = $this->connection->prepare($dql);
        $stmt->bindValue('externalId', $externalId);
        $result = $stmt->executeQuery();

        return ($result->fetchOne() === false ? false : true);
    }
}
