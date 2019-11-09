<?php
class Book
{
    #Begin properties
    var $id;
    var $price;
    var $title;
    var $author;
    var $year;
    #end properties

    #Construct function
    function __construct($id, $title, $price, $author, $year)
    {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    #Member function
    function display()
    {
        echo "Price: " . $this->price . "<br>";
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }

    #Mock data
    /**
     * Lấy toàn bộ các cuốn sách có trong CSDL
     */
    static function getList()
    {
        $listBook = array();
        array_push($listBook, new Book(1, "OOP in PHP", 5, "ndung", 2015));
        array_push($listBook, new Book(2, "OOP in C#", 8, "nha", 2017));
        array_push($listBook, new Book(3, "OOP in Java", 10, "ntrung", 2018));
        array_push($listBook, new Book(4, "OOP in Python", 20, "nlan", 2019));
        array_push($listBook, new Book(5, "OOP in Ruby on Rails", 30, "thomas", 2019));
        //dfdfdf
        return $listBook;
    }
    /**
     * Lấy dữ liệu từ file
     */
    static function getListFromFile()
    {
        $arrData = file("data/book.txt", FILE_SKIP_EMPTY_LINES);
        $lsBook = array();
        foreach ($arrData as $key => $value) {
            $arrItem = explode("#", $value);
            
                $book = new Book($arrItem[0], $arrItem[1], $arrItem[2], $arrItem[3], $arrItem[4]);
                array_push($lsBook, $book);
            
        };
        return $lsBook;
    }
    static function getListCuaQuy($search = null)
    {
        $data = file("data/book.txt");
        $arrBook = [];
        foreach ($data as $key => $value) {
            $row = explode("#", $value);
            if (
                strlen(strstr($row[0], $search)) || strlen(strstr($row[3], $search)) ||
                strlen(strstr($row[1], $search)) || strlen(strstr($row[4], $search)) ||
                strlen(strstr($row[2], $search)) || $search == null
            )
                $arrBook[] = new Book($row[0], $row[2], $row[1], $row[3], $row[4]);
        }
        return $arrBook;
    }
    static function addToFile($content)
    {
        $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "\n" . $content);
        fclose($myfile);
    }
    static function delete($id)
    {
        $data = Book::getList();
        $data_res = [];
        foreach ($data as $key => $value) {
            if ($value->id != $id) {
                $data_res[] = $value;
            }
        }
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach ($data_res as $key => $value) {
            $text_write .= $value->id . "#" . $value->title . "#" . $value->price . "#" . $value->author . "#" . $value->year . "\n";
        }
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    // my func
        //Tim kiem
    static function myFunGetList($search = null)
    {
        $data = file("data/book.txt");
        $arrBook = [];
        foreach ($data as $key => $value) {
            $row = explode("#", $value);
            if (
                // strlen(strstr($row[0], $search)) || strlen(strstr($row[3], $search)) ||
                // strlen(strstr($row[1], $search)) || strlen(strstr($row[4], $search)) ||
                // strlen(strstr($row[2], $search)) || $search == null
                strlen(strstr(strtolower($row[0]),strtolower($search))) || 
                strlen(strstr(strtolower($row[1]),strtolower($search))) || 
                strlen(strstr(strtolower($row[2]),strtolower($search))) || 
                strlen(strstr(strtolower($row[3]),strtolower($search))) || 
                strlen(strstr(strtolower($row[4]),strtolower($search))) || 
                $search==null
            )
                $arrBook[] = new Book($row[0], $row[2], $row[1], $row[3], $row[4]);
        }
        return $arrBook;
    }
        //Xoa
        static function myFunListAfterDelete($id)
    {
        $data = Book::getListFromFile();
        $newList = [];
        foreach ($data as $key => $value) {
            if ($value->id != $id) {
                $newList[] = $value;
            }
        }
       return $newList;
    }

    static function myFunDelete($id)
    {
        $data = Book::myFunListAfterDelete($id);
        $text=null;
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach ($data as $key => $value) {
            $text= $value->id .'#' . $value->title . '#' . $value->price . '#' 
            .$value->author . '#' . $value->year;
            fwrite($myfile, $text);
        }
        
        fclose($myfile);
    }

    //
}
