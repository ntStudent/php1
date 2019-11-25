<?php

class ArticleController
{
    protected $get;

    public function __construct($get)
    {
        $this->get = $get;
    }


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

    public function oneAction()
    {
        $mArticle = new ArticleModel();

        $id = $this->get['id'];
        $article = $mArticle->getById($id);

        echo $this->render('Views/one.html.php', [
                'article' => $article
            ]);
    }

    protected function render($filename, $values = array())
    {
        extract($values);
        ob_start();
        include("$filename");
        return ob_get_clean();
    }

}