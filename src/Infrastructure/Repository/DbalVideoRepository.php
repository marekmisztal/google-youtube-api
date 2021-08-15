<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Video;
use App\Domain\Repository\VideoRepository;
use Doctrine\DBAL\Connection;

class DbalVideoRepository extends DbalBaseRepository implements VideoRepository
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Video $video)
    {
        $dql = "INSERT INTO video 
                    (externalId, title, description, publishedAt, createdAt) 
                VALUES 
                    (:externalId, :title, :description, :publishedAt, :createdAt)
        ";
        $stmt = $this->connection->prepare($dql);
        $stmt->bindValue('externalId', $video->getExternalId());
        $stmt->bindValue('title', $video->getTitle());
        $stmt->bindValue('description', $video->getDescription());
        $stmt->bindValue('publishedAt', $video->getPublishedAt());
        $stmt->bindValue('createdAt', $video->getCreatedAt());
        $stmt->executeQuery();
    }

    public function alreadyExists(string $externalId)
    {
        $dql = "SELECT 1 
                FROM video
                WHERE
                    externalId = :externalId
        ";
        $stmt = $this->connection->prepare($dql);
        $stmt->bindValue('externalId', $externalId);
        $result = $stmt->executeQuery();

        return ($result->fetchOne() === false ? false : true);
    }
}
