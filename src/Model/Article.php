<?php

namespace App\Model;

class Article 
{
protected int $id_blog;
protected int $id_user;
protected string $title;
protected string $content;
protected string $created_at;


public function toArray(): array
{
    return [
        "id_blog" => $this->id_blog,
        "id_user" => $this->id_user,
        "title" => $this->title,
        "content" => $this->content,
        "created_at" => $this->created_at
    ];
}
/**
 * Get the value of id_blog
 *
 * @return int
 */
public function getIdBlog(): int
{
return $this->id_blog;
}

/**
 * Set the value of id_blog
 *
 * @param int $id_blog
 *
 * @return self
 */
public function setIdBlog(int $id_blog): self
{
$this->id_blog = $id_blog;

return $this;
}

/**
 * Get the value of id_user
 *
 * @return int
 */
public function getIdUser(): int
{
return $this->id_user;
}

/**
 * Set the value of id_user
 *
 * @param int $id_user
 *
 * @return self
 */
public function setIdUser(int $id_user): self
{
$this->id_user = $id_user;

return $this;
}

/**
 * Get the value of title
 *
 * @return string
 */
public function getTitle(): string
{
return $this->title;
}

/**
 * Set the value of title
 *
 * @param string $title
 *
 * @return self
 */
public function setTitle(string $title): self
{
$this->title = $title;

return $this;
}

/**
 * Get the value of content
 *
 * @return string
 */
public function getContent(): string
{
return $this->content;
}

/**
 * Set the value of content
 *
 * @param string $content
 *
 * @return self
 */
public function setContent(string $content): self
{
$this->content = $content;

return $this;
}

/**
 * Get the value of created_at
 *
 * @return string
 */
public function getCreatedAt(): string
{
return $this->created_at;
}

/**
 * Set the value of created_at
 *
 * @param string $created_at
 *
 * @return self
 */
public function setCreatedAt(string $created_at): self
{
$this->created_at = $created_at;

return $this;
}
}