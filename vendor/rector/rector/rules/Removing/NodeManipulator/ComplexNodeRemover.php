<?php

declare (strict_types=1);
namespace Rector\Removing\NodeManipulator;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticPropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Core\PhpParser\Comparing\NodeComparator;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\NodeFinder\PropertyFetchFinder;
use Rector\Core\ValueObject\MethodName;
use Rector\DeadCode\SideEffect\SideEffectNodeDetector;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeRemoval\AssignRemover;
use Rector\NodeRemoval\NodeRemover;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Removing\NodeAnalyzer\ForbiddenPropertyRemovalAnalyzer;
final class ComplexNodeRemover
{
    /**
     * @readonly
     * @var \Rector\NodeRemoval\AssignRemover
     */
    private $assignRemover;
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\NodeFinder\PropertyFetchFinder
     */
    private $propertyFetchFinder;
    /**
     * @readonly
     * @var \Rector\NodeNameResolver\NodeNameResolver
     */
    private $nodeNameResolver;
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\Node\BetterNodeFinder
     */
    private $betterNodeFinder;
    /**
     * @readonly
     * @var \Rector\NodeRemoval\NodeRemover
     */
    private $nodeRemover;
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\Comparing\NodeComparator
     */
    private $nodeComparator;
    /**
     * @readonly
     * @var \Rector\Removing\NodeAnalyzer\ForbiddenPropertyRemovalAnalyzer
     */
    private $forbiddenPropertyRemovalAnalyzer;
    /**
     * @readonly
     * @var \Rector\DeadCode\SideEffect\SideEffectNodeDetector
     */
    private $sideEffectNodeDetector;
    public function __construct(\Rector\NodeRemoval\AssignRemover $assignRemover, \Rector\Core\PhpParser\NodeFinder\PropertyFetchFinder $propertyFetchFinder, \Rector\NodeNameResolver\NodeNameResolver $nodeNameResolver, \Rector\Core\PhpParser\Node\BetterNodeFinder $betterNodeFinder, \Rector\NodeRemoval\NodeRemover $nodeRemover, \Rector\Core\PhpParser\Comparing\NodeComparator $nodeComparator, \Rector\Removing\NodeAnalyzer\ForbiddenPropertyRemovalAnalyzer $forbiddenPropertyRemovalAnalyzer, \Rector\DeadCode\SideEffect\SideEffectNodeDetector $sideEffectNodeDetector)
    {
        $this->assignRemover = $assignRemover;
        $this->propertyFetchFinder = $propertyFetchFinder;
        $this->nodeNameResolver = $nodeNameResolver;
        $this->betterNodeFinder = $betterNodeFinder;
        $this->nodeRemover = $nodeRemover;
        $this->nodeComparator = $nodeComparator;
        $this->forbiddenPropertyRemovalAnalyzer = $forbiddenPropertyRemovalAnalyzer;
        $this->sideEffectNodeDetector = $sideEffectNodeDetector;
    }
    public function removePropertyAndUsages(\PhpParser\Node\Stmt\Property $property, bool $removeAssignSideEffect = \true) : void
    {
        $propertyFetches = $this->propertyFetchFinder->findPrivatePropertyFetches($property);
        $assigns = [];
        foreach ($propertyFetches as $propertyFetch) {
            $assign = $this->resolveAssign($propertyFetch);
            if (!$assign instanceof \PhpParser\Node\Expr\Assign) {
                return;
            }
            if ($assign->expr instanceof \PhpParser\Node\Expr\Assign) {
                return;
            }
            if (!$removeAssignSideEffect && $this->sideEffectNodeDetector->detect($assign->expr)) {
                return;
            }
            $assigns[] = $assign;
        }
        $this->processRemovePropertyAssigns($assigns);
        $this->nodeRemover->removeNode($property);
    }
    /**
     * @param Param[] $params
     * @param int[] $paramKeysToBeRemoved
     * @return int[]
     */
    public function processRemoveParamWithKeys(array $params, array $paramKeysToBeRemoved) : array
    {
        $totalKeys = \count($params) - 1;
        $removedParamKeys = [];
        foreach ($paramKeysToBeRemoved as $paramKeyToBeRemoved) {
            $startNextKey = $paramKeyToBeRemoved + 1;
            for ($nextKey = $startNextKey; $nextKey <= $totalKeys; ++$nextKey) {
                if (!isset($params[$nextKey])) {
                    // no next param, break the inner loop, remove the param
                    break;
                }
                if (\in_array($nextKey, $paramKeysToBeRemoved, \true)) {
                    // keep searching next key not in $paramKeysToBeRemoved
                    continue;
                }
                return [];
            }
            $this->nodeRemover->removeNode($params[$paramKeyToBeRemoved]);
            $removedParamKeys[] = $paramKeyToBeRemoved;
        }
        return $removedParamKeys;
    }
    /**
     * @param Assign[] $assigns
     */
    private function processRemovePropertyAssigns(array $assigns) : void
    {
        foreach ($assigns as $assign) {
            // remove assigns
            $this->assignRemover->removeAssignNode($assign);
            $this->removeConstructorDependency($assign);
        }
    }
    /**
     * @param \PhpParser\Node\Expr\PropertyFetch|\PhpParser\Node\Expr\StaticPropertyFetch $expr
     */
    private function resolveAssign($expr) : ?\PhpParser\Node\Expr\Assign
    {
        $assign = $expr->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::PARENT_NODE);
        while ($assign instanceof \PhpParser\Node && !$assign instanceof \PhpParser\Node\Expr\Assign) {
            $assign = $assign->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::PARENT_NODE);
        }
        if (!$assign instanceof \PhpParser\Node\Expr\Assign) {
            return null;
        }
        $isInExpr = (bool) $this->betterNodeFinder->findFirst($assign->expr, function (\PhpParser\Node $subNode) use($expr) : bool {
            return $this->nodeComparator->areNodesEqual($subNode, $expr);
        });
        if ($isInExpr) {
            return null;
        }
        $classLike = $this->betterNodeFinder->findParentType($expr, \PhpParser\Node\Stmt\ClassLike::class);
        $propertyName = (string) $this->nodeNameResolver->getName($expr);
        if ($this->forbiddenPropertyRemovalAnalyzer->isForbiddenInNewCurrentClassNameSelfClone($propertyName, $classLike)) {
            return null;
        }
        return $assign;
    }
    private function removeConstructorDependency(\PhpParser\Node\Expr\Assign $assign) : void
    {
        $classMethod = $this->betterNodeFinder->findParentType($assign, \PhpParser\Node\Stmt\ClassMethod::class);
        if (!$classMethod instanceof \PhpParser\Node\Stmt\ClassMethod) {
            return;
        }
        if (!$this->nodeNameResolver->isName($classMethod, \Rector\Core\ValueObject\MethodName::CONSTRUCT)) {
            return;
        }
        $class = $this->betterNodeFinder->findParentType($assign, \PhpParser\Node\Stmt\Class_::class);
        if (!$class instanceof \PhpParser\Node\Stmt\Class_) {
            return;
        }
        $constructClassMethod = $class->getMethod(\Rector\Core\ValueObject\MethodName::CONSTRUCT);
        if (!$constructClassMethod instanceof \PhpParser\Node\Stmt\ClassMethod) {
            return;
        }
        $params = $constructClassMethod->getParams();
        $paramKeysToBeRemoved = [];
        /** @var Variable[] $variables */
        $variables = $this->resolveVariables($constructClassMethod);
        foreach ($params as $key => $param) {
            $variable = $this->betterNodeFinder->findFirst((array) $constructClassMethod->stmts, function (\PhpParser\Node $node) use($param) : bool {
                return $this->nodeComparator->areNodesEqual($param->var, $node);
            });
            if (!$variable instanceof \PhpParser\Node) {
                continue;
            }
            if ($this->isExpressionVariableNotAssign($variable)) {
                continue;
            }
            if (!$this->nodeComparator->areNodesEqual($param->var, $assign->expr)) {
                continue;
            }
            if ($this->isInVariables($variables, $assign)) {
                continue;
            }
            $paramKeysToBeRemoved[] = $key;
        }
        $this->processRemoveParamWithKeys($params, $paramKeysToBeRemoved);
    }
    /**
     * @return Variable[]
     */
    private function resolveVariables(\PhpParser\Node\Stmt\ClassMethod $classMethod) : array
    {
        return $this->betterNodeFinder->find((array) $classMethod->stmts, function (\PhpParser\Node $subNode) : bool {
            if (!$subNode instanceof \PhpParser\Node\Expr\Variable) {
                return \false;
            }
            return $this->isExpressionVariableNotAssign($subNode);
        });
    }
    /**
     * @param Variable[] $variables
     */
    private function isInVariables(array $variables, \PhpParser\Node\Expr\Assign $assign) : bool
    {
        foreach ($variables as $variable) {
            if ($this->nodeComparator->areNodesEqual($assign->expr, $variable)) {
                return \true;
            }
        }
        return \false;
    }
    private function isExpressionVariableNotAssign(\PhpParser\Node $node) : bool
    {
        $expressionVariable = $node->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::PARENT_NODE);
        return !$expressionVariable instanceof \PhpParser\Node\Expr\Assign;
    }
}
