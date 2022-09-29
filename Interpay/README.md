Main page Link : 
  -- http://localhost/Interpay/frontpage/

Page to Load XML Books : 
  -- http://localhost/Interpay/api/

To SCHEDULE the process to load the books automated with a cronjob:

  -- C:\wamp64\bin\php\php7.4.26\php.exe -f "C:\wamp64\www\Interpay\api\index.php"

Attached Images with the proyect working at route:
  -- Interpay\frontpage\images
    -- Image 1 : Shows the posibility to load the books via cronjob or automated task
    -- Image 2 : Shows the posibility to load the books from browser
    -- Image 3 : Shows the tree folders and resources files/folders

XML Sintax : 

    <?xml version="1.0" encoding="UTF-8"?>
    <bookstore>
        <book>
            <author>Author Name</author>
            <name>Book Name</name>
        </book>
        <book>
            <author>Author Name 2</author>
            <name>Book Name 2</name>
        </book>
    </bookstore>

Prerequisites :
  -- First go to :
   |_ ..\Interpay\api\src\resources\db.sql

  -- Then execute the sql script to be able to store xml data and search data.
  -- Next : If you want, you could add more xml data following the provided XML Sintax and Execute the Page to load XML data.

Basic Flow Process: 
  -- You need load the xml data into resources folder as you want in terms like files name and folders tree
  -- Execute Page to Load XML Books
    |_If the coded algorithm found the same author name with different book, It will be added only the new book
    |_If is an new author will be added woth their book only if the book property is not empty.
    |_IF the book is repeated into the same or another xml file with same name both, only will be added once, in given case this exists yet on DB will not be added
    
  -- You can start to search from Main page

  Notes:
  - This little system can scale or grow progressively depending on neddeds
  - Frontpage or frontend can be Improved on the design
  - This system can be used yet with/like restfull service 
