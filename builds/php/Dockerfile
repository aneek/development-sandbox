FROM php:7.1-fpm
MAINTAINER Aneek Mukhopadhyay <dream.aneek@gmail.com>

# Add the sources
RUN echo 'deb http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
RUN echo 'deb-src http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list

# Update once.
RUN apt-get update

# Install wget for getting other sources.
RUN apt-get install -y wget && wget https://www.dotdeb.org/dotdeb.gpg && apt-key add dotdeb.gpg

# Update the whole resources and the system.
RUN apt-get update

# Install general utilities
RUN apt-get install -y \
		vim \
		net-tools \
		procps \
		telnet \
		netcat \
    zip \
    unzip \
    git-core \
    imagemagick \
		graphicsmagick \
    moreutils \
		dnsutils \
    zlib1g-dev \
    cron \
    libcurl4-openssl-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    msmtp \
    ca-certificates \
	&& rm -r /var/lib/apt/lists/*
  
  
# Some basic extensions
RUN docker-php-ext-install -j$(nproc) json mbstring opcache pdo pdo_mysql mysqli zip

# Curl
RUN docker-php-ext-install -j$(nproc) curl

# GD
RUN docker-php-ext-install -j$(nproc) gd

# Intl
RUN docker-php-ext-install -j$(nproc) intl

#Apcu
RUN pecl install apcu-5.1.5 && docker-php-ext-enable apcu
  
# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Allow composer superuser and set environment to use composer executables path
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PATH "$PATH:/root/.composer/vendor/bin"

# Install PHPCS and Drupal Coding Standards
RUN composer global require "squizlabs/php_codesniffer=^2.9"
RUN composer global require phpmd/phpmd:"@stable"
RUN composer global require sebastian/phpcpd
RUN composer global require drupal/coder
RUN composer global require friendsofphp/php-cs-fixer
RUN composer global require drush/drush:8.*

# Install Drupal Console and make it available in the PATH
RUN curl -sS http://drupalconsole.com/installer | php -- --install-dir=/usr/bin/ --filename=drupal-console

# msmtp Configurations
RUN touch /etc/msmtprc


# Clean
RUN apt-get clean && apt-get autoremove -y
RUN rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    /var/tmp/* \
    /var/cache/*