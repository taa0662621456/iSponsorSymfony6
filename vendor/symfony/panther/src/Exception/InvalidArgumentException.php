<?php

/*
 * This file is part of the Panther project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\Panther\Exception;

/**
 * Base InvalidArgumentException for Panther component.
 *
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
}
