Make your url shorter. Get statistic
===========

Meet unusual url shortener. 

###Key Features:

* Short any length url to url with length 5-7 symbols 
* Short your urls with expire date (if necessary)
* Get statistic for urls: ip, country, user agent data. Please be careful to use in EU (visit [eu gdpr information](https://www.eugdpr.org/) for details)

###Requirements:

* [Symfony 3.4 requirements](https://symfony.com/doc/3.4/reference/requirements.html)
* PHP 7.+
* Webpack
* Yarn

###TODO:

* add tests
* add FOSUserBundle and implement private statistic

Url shortener uses [ipinfo](http://ipinfo.io) to obtain country by ip, so it has requests limits.