<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use AppBundle\Filter\QueryFilter;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param QueryFilter $queryFilter
     * @return User[]
     */
    public function getUsersByQueryFilter(QueryFilter $queryFilter): array
    {
        $sql = <<<SQL
select data.id from (
select 
	u.id as id,
	(select value from user_info uic where uic.user_id = u.id and item='country') as country,
    (select value from user_info uis where uis.user_id = u.id and item='state') as state
from user u) data
SQL;

        $sql .= ' WHERE '.$queryFilter->getCondition();
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

        foreach ($queryFilter->getParams() as $i => $param) {
            $stmt->bindValue(++$i, $param);
        }
        $stmt->execute();

        return array_map(function ($id) {
            return $this->find($id);
        }, $stmt->fetchAll());
    }
}
