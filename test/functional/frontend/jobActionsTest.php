<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

//$browser = new sfTestFunctional(new sfBrowser());
$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->

  with('request')->begin()->
    isParameter('module', 'job')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    info(' 1.1 - Expired jobs are not listed ')->
    checkElement('.jobs td.position:contains("expired")', false)->
  end()
;

$max = sfConfig::get('app_max_jobs');

$browser->
    info('1 - The homepage')->
    get('/')->
    info(sprintf(' 1.2 - Only %s jobs are listed for a category', $max))->

    with('response')->
        checkElement('.category_programming tr', $max)
;

$browser->info('1 - The homepage')->
    get('/')->
    info(' 1.3 - A category has a link to the category page only if too many jobs')->
    with('response')->begin()->
        checkElement('.category_design .more_jobs', true)->
        checkElement('.category_programming .more_jobs', true)->
    end()
;

$browser->info('1 - The homepage')->
    get('/')->
    info(' 1.4 - Jobs are sorted by date')->
    with('response')->begin()->
        checkElement(sprintf('.category_programming tr:first a[href*="/%d/"]', 
        $browser->getMostRecentProgrammingJob()->getId()))->
    end()
;

// 2
$job = $browser->getMostRecentProgrammingJob();

$browser->info('2 - The job page')->
    get('/')->

    info(' 2.1 - Each job is clickable')->
    click('Web Developer', array(), array('position' => 1))->
    with('request')->begin()->
        isParameter('module', 'job')->
        isParameter('action', 'show')->
        isParameter('company_slug', $job->getCompanySlug())->
        isParameter('location_slug', $job->getLocationSlug())->
        isParameter('position_slug', $job->getPositionSlug())->
        isParameter('id', $job->getId())->
    end()->

    info('  2.2 - A non-existent job forwards the user to a 404')->
    get('/job/foo-inc/milano-italy/0/painter')->
    with('response')->isStatusCode(404)
;
    //info('  2.3 - An expired job page forwards the user to a 404')->
    //get(sprintf('/job/sensio-labs/paris-france/%d/web-developer', $browser->getExpiredJob()->getId()))->
    //with('response')->isStatusCode(404)
//

// form
$browser->
    info(' 3.2 - Submit a Job with invalid values')->

    get('job/new')->
    click('Preview your job', array('job' => array(
        'company' => 'Sensio Labs',
        'position' => 'Developer',
        'location' => 'Location',
        'email' => 'not.an.email'
    )))->

    with('form')->begin()->
        hasErrors(3)->
        isError('description', 'required')->
        isError('how_to_apply', 'required')->
        isError('email', 'invalid')->
    end()
;

?>

