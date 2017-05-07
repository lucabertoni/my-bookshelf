# my-bookshelf

## Error codes
### Error code #0 - No error occurred
No error occurred.

### Error code #1 - Assuming that an error occurred
I'm assuming that an error occurred but no errors really occurred yet.  
That is a safe check meaned to be a remind that there is always an error in the code and to avoid security falls or malfunctions we need to prevent to execute undesired parts of code.

### Error code #2 - Empty book title
During the loading of books a book with an empty title was found.

### Error code #3 - Invalid book format
The software found a book download url which links to an undefined book format. Supported book formats are the following:  
PDF, EPUB, ZIP/RAR/TGZ, PostScript, RTF  
You can find an updated list at src/lib/defs.php

### Error code #4 - Book cover does not exist on disk
The book cover defined does not exists on disk (in future it will be possibile to retrive images from the internet and this error message will be fixed


### Error code #5 - Maximum number of authors for a book reached
Too much authors for the book were specified so an error is raised. A book can have a max number of authors of 20. That is made to avoid eating all memory when we have a lot of books with a lot of authors. This is treated as a warning and not an error. A number of 20 authors is loaded, all the others are rejected

### Error code #6 - Incorrect parameter type
That's a code level error. A parameter with a wrong type was passed to a method or a function. See the error you get in log for more details

### Error code #7 - Maximum number of contributors for a book reached
Too much contributors for the book were specified so an error is raised.  
A book can have a max number of contributors of 1000.  
That is made to avoid eating all memory when we have a lot of books with a lot of contributors.  
This is treated as a warning and not an error. A number of 1000 contributors is loaded, all the others are rejected.

### Error code #8 - The test error number is different from what the test was expecting
The test returned an error code different from what the test was expecting.

### Error code #9 - Maximum number of additional info for a book reached
Too much additional info for the book were specified so an error is raised.  
A book can have a max number of additional info of 50.  
That is made to avoid eating all memory when we have a lot of books with a lot of additional info.  
This is treated as a warning and not an error. A number of 1000 additional info is loaded, all the others are rejected.

### Error code #10 - Invalid book length
An invalid book length was specified.  
Check your BOOK_INFO.txt file.

## TODO
- Give the possibility to retrive book cover images from the internet