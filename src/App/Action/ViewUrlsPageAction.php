<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class ViewUrlsPageAction
{
    private $router;
    private $template;
    private $table;

    public function __construct(
        TableGateway $table,
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null
    )
    {
        $this->router   = $router;
        $this->template = $template;
        $this->table = $table;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $urls = $this->table->select(function (Select $select) {});

        $data = [
            'urls' => $urls
        ];

        return new HtmlResponse($this->template->render('app::view-urls-page', $data));
    }
}
