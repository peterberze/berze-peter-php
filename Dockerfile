FROM php:8.2.0-cli-bullseye

WORKDIR /var/www

COPY . .

RUN apt-get update --fix-missing && \
    apt-get install --yes nmap curl iputils-ping psutils net-tools bind9-host bind9utils telnet && \
    apt-get install --yes libssl-dev libcurl4-openssl-dev libc-ares-dev libssl-dev libcurl4-openssl-dev && \
    apt-get clean && \
    apt-get autoremove --yes && \
    rm -rf /var/lib/{apt,dpkg,cache,log}/

RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl;

RUN docker-php-ext-configure sockets && docker-php-ext-install sockets

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN printf "yes\nyes\nyes\nyes\nno\nno\n" | pecl install -f swoole-5.0.3
RUN docker-php-ext-enable swoole
