Movie Search Test Project using Elasticsearch:

Elasticsearch version: 
{
  "name" : "xXofb95",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "Y9WpIY2tSbu1sHbjGePzRg",
  "version" : {
    "number" : "6.3.0",
    "build_flavor" : "oss",
    "build_type" : "zip",
    "build_hash" : "424e937",
    "build_date" : "2018-06-11T23:38:03.357887Z",
    "build_snapshot" : false,
    "lucene_version" : "7.3.1",
    "minimum_wire_compatibility_version" : "5.6.0",
    "minimum_index_compatibility_version" : "5.0.0"
  },
  "tagline" : "You Know, for Search"
}

PHP version:
PHP 5.6.40 (cli) (built: Jan  9 2019 15:10:36)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies


File descriptions:
------------------

/public/index.php
The GUI as shown on image /files/cloud.jpeg or /files/local.png

/excel-entries.php
Indexing script that iterates the text /files/TheMovieExcelList2.txt and index into elasticsearch.

/public/search-movie.php
Searches elasticsearch based on the input keywords on the GUI.

Setup:
1) Download, install & run Elasticsearch.
2) Add local domain name 'elastictest.local'.
3) Add to apache config:

<VirtualHost elastictest.local:80>
ServerName elastictest.local
ServerAlias elastictest.local
DocumentRoot "/path/to/xampp/5.6.40-1x64/htdocs/rod/elastictest/public"
<Directory "/path/to/xampp/5.6.40-1x64/htdocs/rod/elastictest/public">
Options Indexes MultiViews FollowSymLinks
Order allow,deny
Allow from All
</Directory>
CustomLog "/path/to/xampp/5.6.40-1x64/htdocs/access.elastictest.log" "combined"
ErrorLog "/path/to/xampp/5.6.40-1x64/htdocs/error.elastictest.log"
LogLevel alert
</VirtualHost>

4) Run apache web server.
5) Create index name 'movies' on Elasticsearch.
6) Download composer and run $ 'php composer.phar install' on the project base folder.
7) Run console script /excel-entries.php.
8) Load http://elastictest.local/ on browser & enter keywords e.g 'batman' and should return something like on /files/cloud.jpeg or /files/local.png.

Notes:
The cloud link does not work anymore due to expiry of the trial period however you may setup your own account to test it.

