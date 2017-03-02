<?php
/**
 * Created by PhpStorm.
 * User: Tyler
 * Date: 2/20/2017
 * Time: 10:49 AM
 */

namespace Drupal\quote_module\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeInterface;

/**
 * Form controller for commission entity edit forms.
 *
 * @ingroup quote_module
 */
class commissionEntityForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, NodeInterface $node = Null, $source = Null, $quote_entity = Null) {
    /* @var $entity \Drupal\quote_module\Entity\commissionEntity */
    /* @var $node \Drupal\node\NodeInterface */


    if ($source == 2) {
      $user_id = array('#disabled' => 'TRUE');
      $customer = array('#disabled' => 'TRUE');
      $name = array('#disabled' => 'TRUE');
      $customer_signature = array('#disabled' => 'TRUE');
      $painter_signature = array('#disabled' => 'TRUE');
      $quote = array('#disabled' => 'TRUE');
      $painter_signature_date = array('#disabled' => 'TRUE');
      $customer_signature_date = array('#disabled' => 'TRUE');

      $form = parent::buildForm($form, $form_state);

      $form['user_id'] = array_merge($form['user_id'],$user_id);
      $form['customer'] = array_merge($form['customer'],$customer);
      $form['name'] = array_merge($form['name'],$name);
      $form['field_customer_signature'] = array_merge($form['field_customer_signature'],$customer_signature);
      $form['field_painter_signature'] = array_merge($form['field_painter_signature'],$painter_signature);
      $form['field_quote'] = array_merge($form['field_quote'],$quote);
      $form['field_painter_signature_date'] = array_merge($form['field_painter_signature_date'],$painter_signature_date);
      $form['field_customer_signature_date'] = array_merge($form['field_customer_signature_date'],$customer_signature_date);

    }
    elseif($source == 1) {
      $form = parent::buildForm($form, $form_state);
    }


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label commission entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label commission entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.commission_entity.canonical', ['commission_entity' => $entity->id()]);
  }

}