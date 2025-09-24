<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\Cropperjs\Factory\CropperInterface;

class Cropper
{
    //TODO: добавить Cropper сервис для файлов-изображений cover and profile avatar
    // help https://github.com/konshensx16/symfony_ux/blob/master/src/Controller/CropperController.php
    public function cropper(CropperInterface $cropper, Request $request): void
    {
        //TODO: method not found
        $filename = $this->getParameter('root_dir').'/public/img/img.png';
        $crop = $cropper->createCrop($filename);
        $crop->setCroppedMaxSize(1000, 500);
/*        $form = $this->createFormBuilder(['crop' => $crop])
            ->add('crop', CropperType::class,
                [
                    'public_url' => '/img/img.png',
                    'aspect_ratio' => 2000 / 1500,
                    'attr' => [
                        'data-controller' => 'cropper'
                    ]
                ])
            ->add('save', SubmitType::class)
            ->getForm();*/


/*        $encoded = ($crop->getCroppedImage());
        $resource = (imagecreatefromstring($encoded));

        imagepng($resource, $filename);*/
    }

}