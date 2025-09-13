############################################
# Base Image
############################################

# Learn more about the Server Side Up PHP Docker Images at:
# https://serversideup.net/open-source/docker-php/
FROM serversideup/php:8.4-fpm-nginx-alpine AS base

## Uncomment if you need to install additional PHP extensions
# USER root
# RUN install-php-extensions ctype curl dom fileinfo filter hash mbstring mysqli opcache openssl pcntl pcre pdo_mysql redis session tokenizer xml zip json exif bcmath intl gd imagick

############################################
# Development Image
############################################
FROM base AS development

# We can pass USER_ID and GROUP_ID as build arguments
# to ensure the www-data user has the same UID and GID
# as the user running Docker.
ARG USER_ID
ARG GROUP_ID

# Switch to root so we can set the user ID and group ID
USER root

# Set the user ID and group ID for www-data
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID  && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

# Drop privileges back to www-data
USER www-data

############################################
# CI image
############################################
FROM base AS ci

# Sometimes CI images need to run as root
# so we set the ROOT user and configure
# the PHP-FPM pool to run as www-data
USER root
RUN echo "user = www-data" >> /usr/local/etc/php-fpm.d/docker-php-serversideup-pool.conf && \
    echo "group = www-data" >> /usr/local/etc/php-fpm.d/docker-php-serversideup-pool.conf


############################################
# CLI image
############################################
FROM serversideup/php:8.4-cli AS development-cli

# Sometimes CI images need to run as root
# so we set the ROOT user and configure
# the PHP-FPM pool to run as www-data
# USER root
# RUN install-php-extensions ctype curl dom fileinfo filter hash mbstring mysqli opcache openssl pcntl pcre pdo_mysql redis session tokenizer xml zip json exif bcmath intl gd imagick
