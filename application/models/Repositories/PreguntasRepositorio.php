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
    public function getQuestionByCourses($id,$maxPreguntas)
    {

      //almacenamos el número máximo para el random
      $max = $this->_em->createQuery("SELECT MAX(u.id) FROM Entities\\PreguntasJoin u WHERE u.id_join = $id AND u.table_join = 'courses'")->getSingleScalarResult();
      //array donde almacenaremos el listado de preguntas
      $question = array();

      do {

        $query = $this->_em->createQuery("SELECT u FROM Entities\\PreguntasJoin u WHERE u.id_join = $id AND u.table_join = 'courses' AND u.id >= :random")
        ->setParameter('random', rand(0,$max))
        ->setMaxResults(1);
        $re = $query->getSingleResult();

        if(!in_array($max, $question) AND $re != null)
        {
          $question[] = $re->getIdquestion();
        }

      } while (count($question) < $maxPreguntas);

			return $question;
    }

    /**
     * @return row
     */
    public function getOneQuestionTest($id,$pag)
    {

			$query = $this->_em->createQuery("SELECT u FROM Entities\\Evaluacionrespuesta u WHERE u.evaluacionid = $id")
      ->setFirstResult($pag - 1)
      ->setMaxResults(1);
			return $query->getSingleResult();
    }

    /**
     * @return row
     */
    public function getResponseByEvaluation($id)
    {

			$query = $this->_em->createQuery("SELECT u FROM Entities\\Evaluacionrespuesta u WHERE u.evaluacionid = $id AND u.responseid > 0");
			return $query->getResult();
    }

    /**
     * @return row
     */
    public function getResponseNoOk($id,$maxPreguntas)
    {

      //almacenamos el número máximo para el random
      $max = $this->_em->createQuery("SELECT MAX(u.id) FROM Entities\\Evaluacionrespuesta u WHERE u.alumnoid = $id AND u.response != 1")->getSingleScalarResult();
      $tQ = $this->_em->createQuery("SELECT u FROM Entities\\Evaluacionrespuesta u WHERE u.alumnoid = $id AND u.response != 1")->getResult();
      //array donde almacenaremos el listado de preguntas
      $question = array();
      //si el total de preguntas al que tiene acceso el alumno en errradas es menor que el @maxPreguntas, entonces @maxPreguntas = @tQ
      if(count($tQ) < $maxPreguntas)
      {
        $maxPreguntas = count($tQ);
      }

      do {

        $query = $this->_em->createQuery("SELECT u FROM Entities\\Evaluacionrespuesta u WHERE u.alumnoid = $id AND u.response != 1 AND u.id >= :random")
        ->setParameter('random', rand(0,$max))
        ->setMaxResults(1);
        $re = $query->getSingleResult();

        if(!in_array($max, $question) AND $re != null)
        {
          $question[] = $re->getQuestionid();
        }

      }while (count($question) < $maxPreguntas);

			return $question;
    }
}
