FROM php:8.2-apache

# Install dependencies

RUN apt-get update

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    g++ \
    libonig-dev \
    libpcre3-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libxml2-dev \
    re2c \
    libtool \
    make \
    autoconf \
    pkg-config \
    zlib1g-dev

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install curl
RUN docker-php-ext-install intl
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install xml
RUN docker-php-ext-install simplexml

# Enable Apache mod_rewrite
RUN a2enmod rewrite
# Install Phalcon
# Clone and build Phalcon extension from source
RUN git clone --depth=1 https://github.com/phalcon/cphalcon.git /opt/cphalcon && \
    cd /opt/cphalcon/build && \
    ./install
# Enable the extension
RUN echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/40-phalcon.ini
# Copy custom virtual host config (optional)
COPY  vhost.conf /etc/apache2/sites-available/000-default.conf
