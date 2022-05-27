<?php


namespace App\Service;


use App\Entity\BaseTrait;
use App\Entity\Vendor\VendorCodeStorage;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SmsCodeGenerator
{

    public function smsCodeGenerator(Request $request, EntityManagerInterface $em): Response
    {
        $phone = $request->get('phone');

        $rand = rand(1000, 9999);

        $code = new VendorCodeStorage();
        $code->setPhone($phone);
        $code->setCode($rand);

        $em->persist($code);
        $em->flush();

        // Эта строка отправляет смс. Чтобы отправка заработала, необходимо зарегистрироваться на сайте и указать параметры
        //file_get_contents('<a href="https://smsc.ru" class="ext" target="_blank">https://smsc.ru<span
        // class="ext"><span class="element-invisible"> (link is external)</span></span></a>');

        return new JsonResponse(
            [
                'success' => 1,
                'error'   => 0,
                'code'    => $rand,
            ]
        );
    }

    public function isSmsCodeConsist(array $formData, EntityManagerInterface $em): array
    {
        // Достаём код из БД по известному нам мобильному номеру
        $codeFromDataBase = $this->getDoctrine()
            ->getManager()
            ->getRepository(VendorCodeStorage::class)
            ->findOneBy(
                [
                    'phone'   => $formData['phone'],
                    'code'    => $formData['code'],
                    'isLogin' => null,
                ]
            )
        ;

        // Если такого кода в базе нет, возвращаем ошибку
        if (empty($codeFromDataBase)) {
            $data['error'] = 'Неверно введён SMS-код';

            return $data;
        }

        // Проверка, не просрочен ли код
        $createCodeTime = $codeFromDataBase->getcreatedAt();
        $checkTime = (new DateTime())->modify('-5 minutes'); // время действия кода - 5 минут

        if ($checkTime > $createCodeTime) {
            $data['error'] = 'Данный SMS-код уже недействителен. Запросите новый код.';

            return $data;
        }

        // Если же ошибок не обнаружено
        $codeFromDataBase->setIsLogin((bool)1);

        $em = $this->getDoctrine()
            ->getManager()
        ;
        $em->persist($codeFromDataBase);
        $em->flush();

        $data['success'] = 'Пользователь идентифицирован';

        return $data;
    }
}
