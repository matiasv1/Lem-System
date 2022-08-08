FROM php:7.4-apache-buster

ENV RUNTIME_PACKAGES libpq-dev libpng-dev openssl git zip unzip cron vim nano wget curl htop iputils-ping openssh-server supervisor
ENV minimal_apt_get_args '-y --no-install-recommends'

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

RUN apt-get update && \
    apt-get install $minimal_apt_get_args $RUNTIME_PACKAGE && \
    docker-php-ext-install pdo && \
    docker-php-ext-install pdo pdo_mysql && \
    #docker-php-ext-install bcmath && \
    #zip && \
    #unzip && \
    apt-get install vim -y && \
    apt-get clean

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN echo "root:Docker!" | chpasswd
RUN mkdir -p /var/run/sshd

COPY apache2.conf /etc/apache2/sites-available/apache2.conf
#COPY config/.bashrc /root/.bashrc
#COPY config/.vimrc /root/.vimrc
#COPY scripts/start.sh /
#COPY config/supervisord.conf /etc/supervisord.conf
#COPY config/cron /var/spool/cron/crontabs/root
COPY sshd_config /etc/ssh

RUN a2dissite 000-default.conf && a2ensite apache2.conf && a2enmod rewrite

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . ./
COPY composer.json ./
COPY composer.lock ./


RUN COMPOSER_MEMORY_LIMIT=-1 composer install --ignore-platform-reqs && \
    #chmod +x /start.sh && \
    chown -R www-data:www-data vendor && \
    chown -R www-data:www-data storage && \
    rm /etc/localtime  && \
    ln -s /usr/share/zoneinfo/America/Santiago /etc/localtime

RUN apt-get update && apt-get install -y gnupg2

#CMD ["/start.sh"]