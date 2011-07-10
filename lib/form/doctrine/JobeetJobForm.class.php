<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {
      $this->removeFields();

      $this->validatorSchema['email'] = new sfValidatorAnd(array(
          $this->validatorSchema['email'], 
          new sfValidatorEmail()
      ));

      // type
      $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
          'choices' => Doctrine_Core::getTable('JobeetJob')->getTypes(),
          'expanded' => true
      ));

      $this->validatorSchema['type'] = new sfValidatorChoice(array(
          'choices' => array_keys(Doctrine_Core::getTable('JobeetJob')->getTypes())
      ));

      // logo
      $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
          'label' => 'Company logo'
      ));

      $this->validatorSchema['logo'] = new sfValidatorFile(array(
          'required' => false,
          'path' => sfConfig::get('sf_upload_dir'.'/jobs'),
          'mime_types' => 'web_images'
      ));
    
      // labels
      $this->widgetSchema->setLabels(array(
          'category_id' => 'Category',
          'is_public' => 'Public?',
          'how_to_apply ' => 'How to apply?',
      ));

      // help
      $this->widgetSchema->setHelp(
          'is_public', 'Where the job can also be published.'
      );

      // format
      $this->widgetSchema->setNameFormat('job[%s]');
  }

  protected function removeFields()
  {
      unset(
          $this['created_at'], $this['updated_at'],
          $this['expires_at'], $this['is_activated'],
          $this['token']
      );
  }
}
