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
class ContainsZipCode extends Constraint
{
    public $messageZipCode = 'Le code postal doit contenir 5 chiffres.';
}
