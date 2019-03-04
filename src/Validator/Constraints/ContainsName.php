<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 09/01/19
 * Time: 21:28
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsName extends Constraint
{
    public $messageName = 'Le champ doit contenir au minimum 2 caractères.';
}
