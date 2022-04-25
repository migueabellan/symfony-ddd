<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

abstract class RestController
{
    protected Request $request;

    public function __construct(
        RequestStack $requestStack,
        protected TranslatorInterface $translator
    ) {
        $this->request = $requestStack->getCurrentRequest();
        $this->translator = $translator;

        $this->validate();
    }

    abstract protected function expectedParams(): array;
    abstract protected function expectedConstraints(): Collection;

    protected function validate(): void
    {
        $data = $this->expectedParams();
        $constraint = $this->expectedConstraints();

        $validator = Validation::createValidator();
        $errors = $validator->validate($data, $constraint);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $violation) {
                $key = str_replace(array('[', ']'), '', $violation->getPropertyPath());
                $messages[$key][] = $this->translator->trans(
                    $violation->getMessageTemplate(),
                    $violation->getParameters(),
                    'validators'
                );
            }

            throw new BadRequestHttpException(serialize($messages));
        }
    }

    protected function getRequestBody(): array
    {
        return json_decode((string)$this->request->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function json(
        ?array $data,
        int $status = Response::HTTP_OK,
        array $headers = []
    ): JsonResponse {
        $commons = null;

        $response = [
            'data' => $data,
            'commons' => $commons
        ];

        return new JsonResponse($response, $status, $headers);
    }
}
