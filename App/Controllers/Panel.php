<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

class Panel
    extends Controller
{

    public function actionDefault()
    {
        $this->view->news = Article::findAll();
        echo $this->view->render(
            __DIR__ . '/../../Panel/NewsTemplatePanel.php'
        );
    }

    public function actionNew()
    {
        $this->view->article = new Article;
        echo $this->view->render(
            __DIR__ . '/../../Panel/EditorTemplate.php'
        );
    }

    public function actionEdit()
    {
        $this->view->article = Article::findById($_GET['id']);
        echo $this->view->render(
            __DIR__ . '/../../Panel/EditorTemplate.php'
        );
    }

    public function actionSave()
    {
        if (isset($_POST['id'])) {
            $article = Article::findById($_POST['id']);
        } else {
            $article = new Article;
        }
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->author_id = $_POST['author_id'];
        $article->save();
        header('Location: /Panel/');
    }

    public function actionDel()
    {
        $article = Article::findById($_GET['id']);
        $article->delete();
        header('Location: /Panel/');
    }
}