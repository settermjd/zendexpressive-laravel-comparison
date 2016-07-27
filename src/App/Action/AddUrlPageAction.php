<?php

namespace App\Action;

use App\Entity\Url;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zenapply\GoogleShortener\Google;
use Zend\Db\TableGateway\TableGateway;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Form\Annotation\AnnotationBuilder;

class AddUrlPageAction
{
    private $router;
    private $template;
    private $table;
    private $form;

    /** @var Google */
    private $gooGl;

    public function __construct(
        TableGateway $table,
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        \ArrayObject $config
    ) {
        $this->router = $router;
        $this->template = $template;
        $this->table = $table;
        $this->form = (new AnnotationBuilder())->createForm(Url::class);
        $this->gooGl = new Google($config['shortener']['api_key_one']);
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        if ($request->getMethod() == 'POST') {
            $entity = new Url();
            $this->form->bind($entity);
            $this->form->setData($request->getParsedBody());

            if ($this->form->isValid()) {
                /** @var Url $entity */
                $entity = $this->form->getData();
                $this->table->insert([
                    'shortened_url' => $this->gooGl->shorten($entity->getOriginalUrl()),
                    'original_url'  => $entity->getOriginalUrl(),
                ]);

                return new RedirectResponse('/');
            }
        }

        return new HtmlResponse($this->template->render('app::add-url-page', [
            'form' => $this->form,
        ]));
    }
}
