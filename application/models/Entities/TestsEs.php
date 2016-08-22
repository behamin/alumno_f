<?php
namespace Entities;

/**
* @Entity
 * @Table(name="tests")
 */

class TestsEs
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_test;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $name_test;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $id_course;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $id_theme_part;


	 	public function getIdtest()
    {
        return $this->id_test;
    }

		public function getnametest()
    {
        return $this->name_test;
    }

		public function getIdcourse()
    {
        return $this->id_course;
    }

		public function getIdthemepart()
    {
        return $this->id_theme_part;
    }


}
