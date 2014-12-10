Matavior
========

Matavior is a little free web-framework.


Features
-------
* Blog
* Community
* Dashboard
* Multilingualism
* Notifications
* Private messaging
* Search


Community Features
-------

* TBA


Components
-------

#####Request
To access request data Matavoir provides two arrays. The first array provides all parts of the URL and the other one provides all GET parameters if they're set. Below you can see an example how the two arrays might look like. You can easily access the variables using `Request::getUriParts()` and `Request::getParams()`. For an overview of all the features, look [here](https://github.com/MadnessFreak/Matavior/blob/master/mata/Request.php#L130-L199).

```
GET /members/profile/MadnessFreak?tab=wall&entry=14 HTTP/1.1
Host: www.example.net
```

```php
Array
(
    [1] => members
    [2] => profile
    [3] => MadnessFreak
)
```

```php
Array
(
    [tab] => wall
    [entry] => 14
)
```


License
-------

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
