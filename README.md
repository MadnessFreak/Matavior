Matavior
========

Matavior is a little free web-framework.

Components
-------

#####The Request
To access request data Matavoir provides two arrays. The first array provides all parts of the URL and the other one provides all GET parameters if they're set. Below you can see an example how the two arrays might be look like.

```
GET /members/profile/MadnessFreak?category=settings&tab=privacy HTTP/1.1
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
    [category] => settings
    [tab] => privacy
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
