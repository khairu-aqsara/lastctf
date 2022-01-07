FROM httpd:2.4.49
COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf
COPY ./blog.pl /usr/local/apache2/cgi-bin/blog.pl
COPY ./index.html /usr/local/apache2/htdocs/index.html
COPY ./error.html /usr/local/apache2/htdocs/error.html
COPY ./flag /usr/local/apache2/this_is_real_flag