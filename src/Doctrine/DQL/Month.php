<?php


namespace App\CoreBundle\Doctrine\DQL;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\Node;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

final class Month extends FunctionNode
{
    /** @var Node|string|null */
    public $date;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        $platform = $sqlWalker->getConnection()->getDatabasePlatform();

        if (is_a($platform, MySQLPlatform::class, true)) {
            return sprintf('MONTH(%s)', $sqlWalker->walkArithmeticPrimary($this->date));
        }

        if (is_a($platform, PostgreSQLPlatform::class, true)) {
            return sprintf('EXTRACT(MONTH FROM %s)', $sqlWalker->walkArithmeticPrimary($this->date));
        }

        throw new \RuntimeException(sprintf('Platform "%s" is not supported!', get_class($platform)));
    }
}