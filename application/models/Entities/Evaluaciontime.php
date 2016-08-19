<?php
namespace Entities;

/**
* @Entity
 * @Table(name="evaluaciontime")
 */

class Evaluaciontime
{

		/**
		 * @Id @GeneratedValue @Column(type="integer")
		 * @var int
		 **/
		protected $id;

		/**
		 * @Column(type="integer")
		 * @var int
		 **/
		protected $evaluacionid;

		/**
		 * @Column(type="integer")
		 * @var int
		 **/
		protected $time;

		/**
		 * @Column(type="integer")
		 * @var int
		 **/
		protected $time_total;

	 	public function getId()
    {
        return $this->id;
    }

		public function getEvaluacionid()
    {
        return $this->evaluacionid;
    }

		public function getTime()
    {
        return $this->time;
    }

		public function getTotaltime()
    {
        return $this->time_total;
    }

		public function setEvaluacionid($evaluacionid)
    {
        $this->evaluacionid = $evaluacionid;
    }

		public function setTime($time)
    {
        $this->time = $time;
    }

		public function setTotaltime($time_total)
    {
        $this->time_total = $time_total;
    }

}
