<?php

class ArticleController
{
    public function indexAction()
    {
        $mArticle = new ArticleModel();
        $articles = $mArticle->getAll();
        // echo "<pre>";
        // print_r($articles);
        // echo "</pre>";
        // var_dump($articles);
        // die;

        echo $this->render('Views/index.html.php', [
                'articles' => $articles
            ]);
    }

    public function articleAction()
    {

    }

    protected function render($filename, $values = array())
    {
        extract($values);
        ob_start();
        include("$filename");
        return ob_get_clean();
    }

}