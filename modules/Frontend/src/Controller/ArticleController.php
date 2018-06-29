<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\Template;
use Core\Common\View;
use Exception;

class ArticleController extends AbstractController
{
    protected $types = ['posts', 'videos'];

    public function __construct(array $params)
    {
        $data = $this->getData($params);

        if (! is_array($data)) {
            throw new Exception('API response is not array!');
        }

        if (count($data) > 1) {
            throw new Exception('API response must have only 1 record!');
        }

        if (count($data) == 1) {
            $data = $data[0];

            if (! isset($data->type)) {
                throw new Exception("Property (post) is missing!");
            }

            $this->params['posts'] = $data;

            switch ($data->type) {
                case 'post':
                    return $this->textArticle();

                case 'video':
                    return $this->videoArticle();
            }

            throw new Exception("Post type unexpeted! ($data->type)");
        }
    }

    private function textArticle()
    {
        Template::setTemplate('frontend/layout/layout');
        $this->setViewLoaded();

        $featuredImage = $this->resolveFeaturedImage();

        if ($featuredImage) {
            $this->params['featured_image'] = $featuredImage;
        }

        new View('frontend/articles/text-article', $this->params);
    }

    private function videoArticle()
    {
        Template::setTemplate('frontend/layout/layout');
        $this->setViewLoaded();
        new View('frontend/articles/video-article', $this->params);
    }

    private function resolveFeaturedImage()
    {
        $post = $this->params['posts'];
        if (isset($post->featured_media)) {

            $params = [
                'id' => $post->featured_media
            ];
            $featuredImage = ApiWpHelper::getData($params, 'media');

            return $featuredImage;
        }

        return false;
    }

}