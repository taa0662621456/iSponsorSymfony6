<?php


namespace App\Doctrine\DQL;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\Node;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\SqlWalker;
use RuntimeException;

final class Hour extends FunctionNode
{
    /** @var Node|string|null */
    public Node|string|null $date;

    public function parse(Parser $parser): void
    {
        try {
            $parser->match(Lexer::T_IDENTIFIER);
        } catch (QueryException $e) {
        }
        try {
            $parser->match(Lexer::T_OPEN_PARENTHESIS);
        } catch (QueryException $e) {
        }

        $this->date = $parser->ArithmeticPrimary();

        try {
            $parser->match(Lexer::T_CLOSE_PARENTHESIS);
        } catch (QueryException $e) {
        }
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        try {
            $platform = $sqlWalker->getConnection()->getDatabasePlatform();
        } catch (Exception $e) {
        }

        if (is_a($platform, MySQLPlatform::class, true)) {
            return sprintf('HOUR(%s)', $sqlWalker->walkArithmeticPrimary($this->date));
        }

        if (is_a($platform, PostgreSQLPlatform::class, true)) {
            return sprintf('EXTRACT(HOUR FROM %s)', $sqlWalker->walkArithmeticPrimary($this->date));
        }

        throw new RuntimeException(sprintf('Platform "%s" is not supported!', get_class($platform)));
    }
}
