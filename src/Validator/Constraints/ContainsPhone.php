<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 09/01/19
 * Time: 16:47
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsPhone extends Constraint
{
    public $messagePhone = 'Le numéro de telephone doit contenir minimum 10 chiffres';
}
