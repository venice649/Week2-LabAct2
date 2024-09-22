<?php

class Book {
    public $title;
    protected $author;
    private $price;
    
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }
    
    public function getDetails() {
        return "Title: $this->title, Author: $this->author, Price: \$$this->price";
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function __call($method, $arguments) {
        if ($method === 'updateStock') {
            // Simulate stock update functionality
            echo "Stock updated for '{$this->title}' with arguments: " . implode(", ", $arguments) . "\n";
        } else {
            echo "Method $method does not exist.\n";
        }
    }
}

class Library {
    private $books = [];
    public $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function addBook(Book $book) {
        $this->books[] = $book;
    }
    
    public function removeBook($title) {
        foreach ($this->books as $index => $book) {
            if ($book->title === $title) {
                unset($this->books[$index]);
                echo "Book $title removed from the Library.\n";
                return;
            }
        }
        echo "Book $title not found in the Library.\n";
    }
    
    public function listBooks() {
        echo "Books in the Library:\n";
        foreach ($this->books as $book) {
            echo $book->getDetails() . "\n";
        }
    }
    
    public function __destruct() {
        echo "The Library '{$this->name}' is now closed.\n";
    }
}

// Testing the classes
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 12.99);
$book2 = new Book("1984", "George Orwell", 8.99);

$library = new Library("City Library");

$library->addBook($book1);
$library->addBook($book2);

// Update the price of a book
$book1->setPrice(12.99);

// Simulate a non-existent method call
$book1->updateStock(50);

// List all books
$library->listBooks();

// Remove a book from the library
$library->removeBook("1984");

// List all books after removal
echo "Books in the Library after removal:\n";
$library->listBooks();

// Destroy the Library object
unset($library);

?>