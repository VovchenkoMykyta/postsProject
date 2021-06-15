<?php

namespace MySQL;

final class PostDatabase extends Database {

    static private $tableName = "posts";

    static public function addPost(string $name, string $content, $creationDate, $authorId) {}
    static public function removePost(int $id, int $emitterId) {}
    static public function editPost(int $id, string $name, string $content) {}
    static public function getPost(int $id) {}
    static public function getPostPage (int $offset, int $maxPosts) {}

}
