<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class UauriosRepositorio
 * @package Repositories
 */
class PreguntasRepositorio extends EntityRepository
{

    /**
     * @return array
     */
    public function getQuestionByCourses($id)
    {
      $max = $this->_em->createQuery("SELECT MAX(u.id) FROM Entities\\PreguntasJoin u WHERE u.id_join = 20 AND u.table_join = 'courses'")->getSingleScalarResult();;
			$query = $this->_em->createQuery("SELECT u FROM Entities\\PreguntasJoin u WHERE u.id_join = 20 AND u.table_join = 'courses' AND u.id >= :random")
      ->setParameter('random', rand(0,$max))
      ->setMaxResults(40);
			return $query->getResult();
    }
}
