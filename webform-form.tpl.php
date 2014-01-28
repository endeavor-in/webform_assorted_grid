<?php
// $Id: webform-form.tpl.php,v 1.1 2009/05/22 03:11:18 quicksketch Exp $

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 */
?>
<?php 
 /*To print the Fieldset*/ 
  $fields = $form['submitted'];
  $v = 0;
  foreach($fields as $name => $array_value):
    if(strpos($name,'#') !== 0):
      if($array_value['#type'] != 'fieldset'):
        print drupal_render($fields[$name]); 
      elseif($array_value['#type'] == 'fieldset'): ?>
        <table width="100%">
          <tr><th colspan="0"><?php print $array_value['#title'];?></th></tr>
          <tr>
          <?php foreach($array_value as $key => $value):
            if(strpos($key,'#') !== 0 && !is_numeric($key)): ?>
              <th> <?php print $array_value[0][$key]['#title']; ?></th>       
            <?php endif;
            endforeach; ?>
          </tr>
          
          <?php foreach($array_value as $key => $value): 
            if(is_numeric($key)): ?> 
              <tr>         
                <?php foreach($value as $form_key => $form_val):  
                  if(strpos($form_key,'#') !== 0 && !is_numeric($form_key)):
                    unset ($value[$form_key]['#title']);  ?>
                    <td><?php print drupal_render($value[$form_key]);?></td>
                  <?php endif; 
                endforeach;?>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </table>
      <?php endif;?>
      <?php unset($form['submitted'][$name]);?>
    <?php endif; ?>  
  <?php endforeach; ?>
  
  <?php
  // Always print out the entire $form. This renders the remaining pieces of the
  //print drupal_render($form);
  print drupal_render_children($form);
  // form that haven't yet been rendered above.
?> 