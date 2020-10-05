FROM lavoweb/php-7.4:composer

# Install Node.js (& npm)
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs

RUN useradd user --uid 1000
