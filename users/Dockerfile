FROM ubuntu:latest

WORKDIR /root

RUN apt-get clean && apt-get update && apt-get install -y locales && \
    locale-gen en_US.UTF-8
ENV LANG=en_US.UTF-8 
ENV LC_ALL=en_US.UTF-8

RUN echo deb http://ppa.launchpad.net/ondrej/php/ubuntu $(grep UBUNTU_CODENAME /etc/os-release | cut -d '=' -f2) main >> /etc/apt/sources.list && \ 	
    echo deb-src http://ppa.launchpad.net/ondrej/php/ubuntu $(grep UBUNTU_CODENAME /etc/os-release | cut -d '=' -f2) main >> /etc/apt/sources.list && \ 	
    apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 14AA40EC0831756756D7F66C4F4EA0AAE5267A6C
    
RUN apt-get update ;\echo "y";
RUN apt-get -y -q install curl git

RUN apt-get install -y php7.0 php7.0-mbstring php7.0-mcrypt php7.0-zip php7.0-json php7.0-bz2 php7.0-bcmath php7.0-curl php7.0-opcache \
    php7.0-mysql php7.0-pgsql php7.0-soap php7.0-xml && \
    php-redis ;\echo "y";
    
RUN curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash && \
    apt-get install php7.0-phalcon
    
ADD apache2.conf /etc/apache2/apache2.conf 
ADD default.conf /etc/apache2/sites-available/000-default.conf 
ADD php.ini /etc/php/7.0/apache2/php.ini 
ADD php.ini /etc/php/7.0/cli/php.ini

ADD redis.so /usr/lib/php/20151012/redis.so 
ADD redis.ini /etc/php/7.0/mods-available/redis.ini 
RUN phpenmod redis

RUN a2enmod rewrite && a2dissite 000-default

RUN ln -snf /usr/share/zoneinfo/Europe/Moscow /etc/localtime && echo Europe/Moscow > /etc/timezone
ADD users.conf /etc/apache2/sites-available/
RUN a2ensite users

COPY dist/ /var/www/users

ADD init_docker.sh init_docker.sh
CMD chmod a+x init_docker.sh && ./init_docker.sh

EXPOSE 80