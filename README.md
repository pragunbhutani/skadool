Skadool
=======

Flexible scheduling powered by Plivo.

Skadool API
----------------

Methods:

1. CREATE (name, number)
2. UPDATE (number, status)
3. GET (number)
4. DELETE (id)

Formats Available : JSON, XML, PHP Serialized

_________________


EXAMPLES:

http://skadool.ap01.aws.af.cm/create.json?name=TEST&number=0123456789

http://skadool.ap01.aws.af.cm/update.xml?number=0123456789&status=Pending

http://skadool.ap01.aws.af.cm/get.php?number=0123456789

http://skadool.ap01.aws.af.cm/delete.json?id=5
