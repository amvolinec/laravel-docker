FROM php:7.2-fpm

# Install libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \ 
    zip unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    && docker-php-ext-install -j$(nproc) iconv zip mysqli pdo pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Create the project directory
WORKDIR /var/www/solofesteja/api

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the whole project to your workdir
COPY . .
#RUN composer install



EXPOSE 9000

### OPTIONAL
# Install xdebug
# RUN pecl install xdebug && \
#   docker-php-ext-enable xdebug 

# Install bashit
RUN git clone --depth=1 https://github.com/Bash-it/bash-it.git ~/.bash_it && ~/.bash_it/install.sh \
    && mkdir -p ~/.bash_it/plugins/enabled/ \
    && ln -s ~/.bash_it/plugins/available/history.plugin.bash ~/.bash_it/plugins/enabled/250---history.plugin.bash \
    && sed -i 's/bobby/sexy/' ~/.bashrc
