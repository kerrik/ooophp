tango-base
==========

A biolerplate for small websites and webaplications using PHP.
----------------------------------------------------------------------

tango is developed as a part of the class OOOPHP on BTH. Inspiration from Mikael Roos
Anax-base.

Differencis from Anax, so far, is that i use a class insted af an array. Reason
for this is that i can let the class take care of most of the logic needed,
all I have to do is feed in the data. It makes the structure of both the 
sidecontroller and the template cleaner.

###Version 0.5

It is working as desired, pages show as they should.
To do ... 

    *Menus are based on $-GET. Will change that, but no time right now.
    *When menus ar positioned vertical it has no possibility to use the <ul>-listtag. Will be fixed.
    *I have not implemented the possibility to add more than one styleshhet. 
And some more ...

Version 0.6

    *New methot that makes it possible to insert the main content piece by piece insted of doing that with ä variable in the sidecontroller before uppdating  the class.
    *It is now possible to embed style in the haed. 
