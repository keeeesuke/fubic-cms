<!-- 
    加藤さんによるオブジェクト指向の説明
 -->



<?php
$bookList = [
    "基本情報参考書",
    "英和辞典",
    "one piece"
];

function getAllBookTitle($books){
    foreach($books as $book){
        echo $book;
        echo "<br />";
    }
}



getAllBookTitle($bookList);


Class BookList implements Countable {
    private $bookList ;

    function __construct($bookList){
        $this->bookList = $bookList;
    }
    function getAllBookTitle(){
        foreach($this->bookList as $book){
            echo $book;
            echo "<br />";
        }
    }
    function count(){
        return count($this->bookList);
    }
}

echo "----------こっからobject志向-------";
echo "<br />";
$objectBookList = new BookList($bookList);
$objectBookList->getAllBookTitle();
echo "本の数は" . count($objectBookList);