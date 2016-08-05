<?php
namespace Entities;

/**
* @Entity
 * @Table(name="tests")
 */

class Tests
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
    protected $alumnoid;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $questions;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $is_time;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $minutes;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $evaluation;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $question_type;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $level_question;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $num_question;

		/**
     * @Column(type="datetime")
     **/
    protected $createdtest;

		public function __construct()
    {
        $this->createdtest = new \DateTime("now");
    }

	 	public function getId()
    {
        return $this->id;
    }

		public function getCreatedtest()
    {
        return $this->createdtest;
    }

}
