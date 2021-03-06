<?php

/**
 * JobeetCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class JobeetCategory extends BaseJobeetCategory
{
    public function getActiveJobs($max = 10)
    {
        //$query = Doctrine_Query::create()
            //->from('JobeetJob j')
            //->where('j.category_id = ?', $this->getId())
            //->limit($max);
        $query = $this->getActiveJobsQuery()
            ->limit($max);

        return $query->execute();

        //return Doctrine_Core::getTable('JobeetJob')->getActiveJobs($query);
    }

    public function getActiveJobsQuery()
    {
        $query = Doctrine_Query::create()
            ->from('JobeetJob j')
            ->where('j.category_id = ?', $this->getId());

        return Doctrine_Core::getTable('JobeetJob')->addActiveJobsQuery($query);
    }

    public function countActiveJobs()
    {
        //$query = Doctrine_Query::create()
            //->from('JobeetJob j')
            //->where('j.category_id = ?', $this->getId());

        //return Doctrine_Core::getTable('JobeetJob')->countActiveJobs($query);

        return $this->getActiveJobsQuery()->count();
    }

    public function getLatestPost()
    {
        return $this->getActiveJobs(1)->getFirst();
    }

    //public function getSlug()
    //{
        //return Jobeet::slugify($this->getName());
    //}
}
