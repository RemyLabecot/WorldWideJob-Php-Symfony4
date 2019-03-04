<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 09/01/19
 * Time: 17:18
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsPhoneValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}
        (?:[\s.-]?\d{3}){2})$/', $value, $matches)) {
            $this->context->buildViolation($constraint->messagePhone)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
