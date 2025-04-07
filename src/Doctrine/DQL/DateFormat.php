<?php


namespace App\Doctrine\DQL;

use Doctrine\ORM\Query\AST\ArithmeticExpression;
use Doctrine\ORM\Query\AST\ASTException;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\Node;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\SqlWalker;

final class DateFormat extends FunctionNode
{
    public ?ArithmeticExpression $date = null;

    public ?Node $pattern = null;

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
        $this->date = $parser->ArithmeticExpression();
        try {
            $parser->match(Lexer::T_COMMA);
        } catch (QueryException $e) {
        }
        $this->pattern = $parser->StringPrimary();
        try {
            $parser->match(Lexer::T_CLOSE_PARENTHESIS);
        } catch (QueryException $e) {
        }
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        try {
            return sprintf('DATE_FORMAT(%s, %s)', $this->date->dispatch($sqlWalker), $this->pattern->dispatch($sqlWalker));
        } catch (ASTException $e) {
        }
    }
}
