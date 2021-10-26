<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;


class RequestDispatcher
{
    /**
     * @var string
     */
    public string $object;


    public string $crudAction;
    /**
     * @var string
     */
    public string $route;
    /**
     * @var string
     */
    public string $type;
    /**
     * @var string
     */
    public string $templatePath;
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
    private string $objectAttachment;
    /**
     * @var string
     */
    private string $localeFilter;
    /**
     * @var string
     */
    private string $locale;
    /**
     * @var string
     */
    public string $objectLanguageLayer;


    public function __construct(RequestStack $requestStack,
                                string $pathToEntity,
                                string $pathToRepository,
                                string $pathToType)
    {
        $this->requestStack = $requestStack;
        #
        $object = $crudAction = explode('_', $this->requestStack->getMainRequest()->attributes->get('_route', 3));
        $object = (string)current($object);
        $object = ucfirst($object) ?? 'Object';
        #
        $crudAction = $crudAction[1];
        $crudAction = (string)mb_strtolower($crudAction);
        #
        $route = (string)mb_strtolower($object);
        #
        $locale = (string)$this->requestStack->getMainRequest()->attributes->get('_locale');
        $localeFilter = (string)$this->requestStack->getMainRequest()->attributes->get('_locale_filter');
        #
        $templatePath = (string)mb_strtolower($object . '/' . $object . '/' . $crudAction . '.html.twig');

        ## this ##
        $this->locale = $locale;
        $this->localeFilter = $localeFilter;
        #
        $this->object = $pathToEntity . $object . '\\' . $object;
        $this->objectAttachment = $pathToEntity . $object . '\\'. $object . 'Attachment';
        $this->objectRepository = $pathToRepository . $object . '\\' . $object . 'Repository';
        $this->objectLanguageLayer = $object . '_' . $localeFilter;
        #
        $this->route = $route;
        #
        $this->crudAction = $crudAction;
        #
        $this->type = $pathToType . $object . '\\' . $object . 'Type';
        #
        $this->templatePath = $templatePath;

        #
        $this->typeEnGb = $pathToType . $object . '\\' . $object . 'EnGbType';
        $this->objectEnGb = $pathToEntity . $object . '\\' . $object . 'EnGb';
        #
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
        return $this->crudAction;

    }

    /**
     * @return string
     */
    public function layOutPath(): string
    {
        return $this->templatePath;
    }

    /**
     * @return string
     */
    public function objectAttachment(): string
    {
        return $this->objectAttachment;
    }

    /**
     * @return string
     */
    public function objectLanguageLayer(): string
    {
        return $this->objectLanguageLayer;
    }

    /**
     * @return string
     */
    public function locale(): string
    {
        return $this->locale;
    }
    /**
     * @return string
     */
    public function localeFilter(): string
    {
        return $this->localeFilter;
    }

}
