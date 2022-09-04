<?php

namespace App\Dao;

use App\Model\Article;
use Core\AbstractDao;
use PDO;

class ArticleDao extends AbstractDao
{

    public function getAll(): array
    {
        $sth = $this->dbh->prepare("SELECT * FROM `blog`");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $a = new Article();
            $result[$i] = $a->setIdBlog($result[$i]['id_blog'])
                ->setIdUser($result[$i]['id_user'])
                ->setTitle($result[$i]['title'])
                ->setContent($result[$i]['content'])
                ->setCreatedAt($result[$i]['created_at']);
        }
        return $result;
    }
    public function getById(int $id): ?Article
    {
        $sth = $this->dbh->prepare("SELECT * FROM `article` WHERE id_article = :id_article");
        $sth->execute([":id_article" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        $a = new Article();
        return $a->setIdArticle($result['id_article'])
            ->setTitle($result['title'])
            ->setContent($result['content'])
            ->setCreatedAt($result['created_at']);
    }

    function new (Article $article): void {
        $sth = $this->dbh->prepare(
            "INSERT INTO `blog` (title, content, id_user)
                                        VALUES (:title, :content, :id_user)"
        );
        $sth->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent(),
            'id_user' => $article->getIdUser(),
        ]);
        $article->setIdArticle($this->dbh->lastInsertId());
    }

    public function edit($article): void
    {
        $sth = $this->dbh->prepare("UPDATE `blog` SET title = :title, content = :content WHERE id_blog = :id_blog ");
        $sth->execute([
            ':title' => $article->setTitle(),
            ':content' => $article->setContent(),
            ':id_blog' => $article->setIdBlog()]);

    }

    public function delete(int $id): void
    {
        $sth = $this->dbh->prepare("DELETE FROM `blog` WHERE id_blog = :id_blog");
        $sth->execute([":id_blog" => $id]);
    }

}
