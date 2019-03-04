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
class ContainsSiret extends Constraint
{
    public $messageSiret = 'Le champ doit contenir 14 chiffres.';
}
