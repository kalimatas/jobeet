<?php use_stylesheet('jobs.css'); ?>

<div id="jobs">
    <table class="jobs">
        <?php foreach ($jobeet_jobs as $i => $job) : ?>
            <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                <td><?php echo $job->getLocation(); ?></td>
                <td>
                    <?php echo link_to($job->getPosition(), 'job_show_user', $job); ?>
                </td>
                <td><?php echo $job->getCompany() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


