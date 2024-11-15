FROM php:8.3-fpm
WORKDIR /app
# Set timezone
RUN ln -snf /usr/share/zoneinfo/Europe/Moscow /etc/localtime && echo Europe/Moscow > /etc/timezone

RUN apt-get update -y

RUN apt-get update && apt-get upgrade -y && apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libssl-dev libcurl4-openssl-dev libonig-dev libxml2-dev libpng-dev libzip-dev libmcrypt-dev\
    libreadline-dev libfreetype6-dev libxslt1-dev \
    && rm -rf /var/lib/apt/lists/* 
    RUN docker-php-ext-install -j$(nproc) \
        ftp calendar ctype curl dom exif fileinfo 
    RUN docker-php-ext-install -j$(nproc) \    
        gd \
        gettext \
        iconv \
        #json \
        mbstring \
        mysqli \
        posix \
        shmop 
    RUN docker-php-ext-install -j$(nproc) \ 
        simplexml soap sockets sysvmsg sysvsem sysvshm 
    RUN docker-php-ext-install -j$(nproc) \     
        #openssl\
         xml\
          xmlwriter\
           xsl\
            zip\
             opcache \
             pdo \
             pdo_mysql 

COPY /app .

#RUN a2enmod rewrite env

#EXPOSE 80