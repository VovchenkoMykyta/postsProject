<?php

namespace MySQL;

/**
 * Extended class to work with posts database.
 */
final class PostDatabase extends Database {

    /**
     * Name of the current table.
     * @var string $tableName
     */
    static private $tableName = "posts";

    /**
     * Amount of characters in small content of the post.
     * @var int $smallContentSize
     */
    static private $smallContentSize = 250;

    /**
     * Adding a new post to database.
     * @param string $name Name of the future post.
     * @param string $content Content of the future post.
     * @param int $authorId Id of the author of future post.
     * @return array Returns empty array in case of successfull delete. Or array with errors.
     */
    static public function addPost (string $name, string $content, int $authorId) {

        $errors = [];

        $isPostExists = self::getPostByName($name);
        if ($isPostExists) $errors[] = "Post with this name already exists";

        $isAuthorExists = UserDatabase::getUserById($authorId);
        if (!$isAuthorExists) $errors[] = "Such author does not exists";

        $insertResult = static::insert(
            self::$tableName,
            [
                "name"          => $name,
                "content"       => $content,
                "creation_date" => date("Y-m-d H:i:s"),
                "user_id"     => $authorId
            ]
        );

        if (!$insertResult) $errors[] = "Server database error";

        return $errors;

    }

    /**
     * Remove post from database by id.
     * @param int $id Id of the post to be deleted.
     * @param int $emitterId Id of the user who trying to delete.
     * @return array Returns empty array in case of successfull delete. Or array with errors.
     */
    static public function removePost (int $id, int $emitterId) {

        $errors = [];

        $post = self::getPostById($id);

        if(!$post) $errors[] = "Such post does not exists";

        if($post && $post["user_id"] != $emitterId) $errors[] = "Only author can delete this post";

        if ($errors) return $errors;

        $deleteResult = static::delete(self::$tableName, $id);
        if (!$deleteResult) $errors[] = "Server database error";

        return $errors;

    }

    /**
     * Editing an existing post in database.
     * @param int $id Id of the post to be edited.
     * @param string $name Future name of the post.
     * @param string $content Future content of the post.
     * @return array Returns empty array in case of successfull edit. Or array with errors.
     */
    static public function editPost (int $id, string $name, string $content) {

        $errors = [];

        $post = self::getPostById($id);
        if(!$post) $errors[] = "Such post does not exists";

        if ($errors) return $errors;

        $updateResult = static::update(
            self::$tableName,
            ["name" => $name, "content" => $content],
            $id
        );

        if (!$updateResult) $errors[] = "Server database error";

        return $errors;

    }

    /**
     * Get one post by id.
     * @param int $id Id of the post to search.
     * @return array Returns array with post data or empty array.
     */
    static public function getPostById (int $id) {

        $post = static::selectOne(self::$tableName, "id", $id);
        if ($post) $post["small_content"] = self::getSmallContent($post["content"]);

        return $post;

    }

    /**
     * Get one post by name.
     * @param string $name Name of the post to search.
     * @return array Returns array with post data or empty array.
     */
    static public function getPostByName (string $name) {

        $post = static::selectOne(self::$tableName, "name", $name);
        if ($post) $post["small_content"] = self::getSmallContent($post["content"]);

        return $post;

    }

    /**
     * Get list of posts according to selected page.
     * @param int $offset Page number to select.
     * @param int $maxPosts Maximum amount of posts on one page.
     * @param string $orderDirection Direction of the sorted result. ASC or DESC only.
     * @return array Returns array with posts data or empty array.
     */
    static public function getPostPage (int $offset, int $maxPosts, string $orderDirection = "DESC") {

        if ($orderDirection !== "DESC" && $orderDirection !== "ASC") return [];

        $selectResult = static::selectPage(
            self::$tableName,
            "creation_date",
            $orderDirection,
            $offset,
            $maxPosts
        );

        return $selectResult;

    }

    /**
     * Get list of all posts.
     * @return array Returns array with posts data or empty array.
     */
    static public function getPostAll () {

        $selectResult = static::selectAll (
            self::$tableName
        );

        return $selectResult;

    }
    
    /**
     * Get list of all posts.
     * @return array Returns array with posts data or empty array.
     */
    static public function getPostAllByAuthorId (int $id) {
        
        $selectResult = static::selectByField(self::$tableName,"user_id", $id);
        
        return $selectResult;
        
    }

    /**
     * Creates small content for page.
     * @param string $content Content of the page to be truncated.
     * @return string Returns small content from provided content.
     */
    static public function getSmallContent (string $content) {

        if ( strlen($content) < 3 ) return "...";

        $content = mb_substr($content, 0, self::$smallContentSize-3);

        $content .= "...";

        return $content;

    }

    /**
     * Get total amount of the posts.
     * @return int Returns number of posts available.
     */
    static public function getAllPostsAmount () {

        $amount = static::getPostAll();
        return count($amount);

    }

}

