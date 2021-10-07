<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;


class RequestDispatcher
{
    /**
     * @var string
     */
    public string $object;


    public string $crud;
    /**
     * @var false|string|string[]|null
     */
    public string|array|null|false $route;
    /**
     * @var string
     */
    public string $type;
    /**
     * @var string
     */
    public string $path;
    /**
     * @var RequestStack
     */
    public RequestStack $requestStack;
    /**
     * @var string
     */
    public string $typeEnGb;
    /**
     * @var string
     */
    public string $objectEnGb;
    /**
     * @var string
     */
    public string $objectRepository;
    /**
     * @var string
     */
    private string $objectAttach;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $object = (string)ucfirst(current(explode('_', $this->requestStack->getMainRequest()->attributes->get('_route'), 2))) ?? 'Object';

        //$object = $object . 's';
        //$this->object = $object;
        $this->object = '\\App\\Entity\\' . $object . '\\' . $object . 's';
        $this->objectAttach = $object . 'Attachment';

        //$objectRepository = $object . 'sRepository';
        //$this->objectRepository = $objectRepository::createRepository();
        $this->objectRepository = '\\App\\Repository\\' . $object . '\\' . $object . 'sRepository';
        //$this->objectRepository = $object . 'Repository'; //TODO: не продумано для Entity

        //$objectEnGb = $object . 'sEnGb';
        //$this->objectEnGb = $objectEnGb::createObject();
        $this->objectEnGb = '\\App\\Entity\\' . $object . '\\' . $object . 'sEnGb';


        $crud = explode('_', $this->requestStack->getMainRequest()->attributes->get('_route'), 2);
        $this->crud = $crud[1];

        $this->route = mb_strtolower($object);

        //$objectType = $object . 'Type';
        //$objectEnGbType = $object . 'EnGbType';
        //$this->type = $objectType::createType();
        //$this->typeEnGb = $objectType::createEnGbType();
        $this->type = '\\App\\Form\\' . $object . '\\' . $object . 'Type';
        $this->typeEnGb = '\\App\\Form\\' . $object . '\\' . $object . 'EnGbType';

        $this->path = mb_strtolower($object . '/' . $object . 's/' . $crud[1] . '.html.twig');
        //TODO: не продумана структура папок, в частности не клеится с Categories (окончание не "y")
    }

    /**
     * @return string
     */
    public function route(): string
    {
        return $this->route;

    }

    /**
     * @return string
     */
    public function object(): string
    {
        return $this->object;

    }

    /**
     * @return string
     */
    public function objectRepository(): string
    {
        return $this->objectRepository;
    }

    /**
     * @return string
     */
    public function objectEnGb(): string
    {
        return $this->objectEnGb;
    }

    /**
     * @return string
     */
    public function objectType(): string
    {
        return $this->type;

    }

    /**
     * @return string
     */
    public function objectEnGbType(): string
    {
        return $this->typeEnGb;
    }

    /**
     * @return string
     */
    public function crudAction(): string
    {
        return $this->crud;

    }

    /**
     * @return string
     */
    public function layOutPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function objectAttachment(): string
    {
        return $this->objectAttach;
    }

}
