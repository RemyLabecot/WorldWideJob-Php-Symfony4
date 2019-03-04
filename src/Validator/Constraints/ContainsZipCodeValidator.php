<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 09/01/19
 * Time: 21:29
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsZipCodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[0-9]{5}$/', $value, $matches)) {
            $this->context->buildViolation($constraint->messageZipCode)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
