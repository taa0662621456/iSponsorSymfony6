<?php
/*
 * TODO: ссюда я перенесу обработку запроса на предмет выделения Роута, объекта и т.д.
 *
 */


namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;


class RequestDispatcher
{
    /**
     * @var string
     */
    public $object;
    public $crud;
    /**
     * @var false|string|string[]|null
     */
    public $route;
    /**
     * @var string
     */
    public $type;
    /**
     * @var false|string|string[]|null
     */
    public $path;
    /**
     * @var RequestStack
     */
    public $requestStack;
    /**
     * @var string
     */
    public $typeEnGb;
    /**
     * @var string
     */
    public $objectEnGb;
    /**
     * @var string
     */
    public $objectRepository;
    /**
     * @var string
     */
    private $objectAttach;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $object = (string)ucfirst(current(explode('_', $this->requestStack->getMasterRequest()->attributes->get('_route'), 2)));
        $this->object = '\\App\\Entity\\' . $object . '\\' . $object . 's'; //TODO: не продумано для Entity
        $this->objectAttach = $object . 'Attachment';
        $this->objectRepository = '\\App\\Repository\\' . $object . '\\' . $object . 'sRepository';
        //$this->objectRepository = $object . 'Repository'; //TODO: не продумано для Entity
        $this->objectEnGb = '\\App\\Entity\\' . $object . '\\' . $object . 'sEnGb'; //TODO: не продумано для Entity
        $crud = explode('_', $this->requestStack->getMasterRequest()->attributes->get('_route'), 2);
        $this->crud = $crud[1];
        $this->route = mb_strtolower($object);
        $this->type = '\\App\\Form\\' . $object . '\\' . $object . 'Type';
        $this->typeEnGb = '\\App\\Form\\' . $object . '\\' . $object . 'EnGbType';
        $this->path = mb_strtolower($object . '/' . $object . 's/' . $crud[1] . '.html.twig');
        //TODO: не продумана структура папок, в частности не клеится с Categories (окончание не "y")
    }

    /**
     * @return false|string|string[]|null
     */
    public function route()
    {
        return $this->route;

    }

    /**
     * @return string
     */
    public function object()
    {
        return $this->object;

    }

    /**
     * @return string
     */
    public function objectRepository()
    {
        return $this->objectRepository;
    }

    /**
     * @return string
     */
    public function objectEnGb()
    {
        return $this->objectEnGb;
    }

    /**
     * @return string
     */
    public function objectType()
    {
        return $this->type;

    }

    /**
     * @return string
     */
    public function objectEnGbType()
    {
        return $this->typeEnGb;
    }

    /**
     * @return mixed
     */
    public function crudAction()
    {
        return $this->crud;

    }

    /**
     * @return false|string|string[]|null
     */
    public function layOutPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function objectAttachment()
    {
        return $this->objectAttach;
    }

}
