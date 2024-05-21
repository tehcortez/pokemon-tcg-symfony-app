<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/error', name: 'app_error')]
    public function show(\Throwable $exception): Response
    {
        $this->logger->error($exception->getMessage(), ['exception' => $exception]);

        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        return $this->render(
            'error.html.twig',
            [
            'status_code' => $statusCode,
            'status_text' => Response::$statusTexts[$statusCode] ?? 'An error occurred',
            'exception' => $exception,
            ]
        );
    }
}
