<?php
/**
 * Created by PhpStorm.
 * User: Tyler
 * Date: 2/23/2017
 * Time: 6:23 PM
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
class commissionEntityCustomerSignatureForm extends ContentEntityForm {
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var $entity \Drupal\quote_module\Entity\commissionEntity */

        $user_id = array('#disabled' => 'TRUE');
        $form = parent::buildForm($form, $form_state);
        $form['user_id'] = array_merge($form['user_id'],$user_id);

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