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

class ContainsSiretValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        } elseif (!preg_match('/\d{14}/', $value, $matches)) {
            $this->context->buildViolation($constraint->messageSiret)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
