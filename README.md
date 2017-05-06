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
You can find an updated list at src/lib/defs.php ()

### Error code #4 - Book cover does not exist on disk
The book cover defined does not exists on disk (in future it will be possibile to retrive images from the internet and this error message will be fixed

## TODO
- Give the possibility to retrive book cover images from the internet